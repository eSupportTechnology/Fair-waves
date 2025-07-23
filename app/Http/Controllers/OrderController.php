<?php

namespace App\Http\Controllers;

use App\Mail\OrderStatusUpdatedMail;
use App\Models\Commission;
use App\Models\User;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use App\Models\DealerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = CustomerOrder::query();
        if ($request->filled('order_code')) {
            $query->where('order_code', 'like', '%' . $request->order_code . '%');
        }
        if ($request->filled('status') && $request->status != 'All') {
            $query->where('status', $request->status);
        }
        $orders = $query->latest()->paginate(10);

        return view('AdminDashboard.orders', compact('orders'));
    }

    public function destroy($id)
    {
        $order = CustomerOrder::findOrFail($id);
        $order->delete();

        return redirect()->route('orders')->with('success', 'Order deleted successfully.');
    }

    public function showOrderDetails($orderCode)
    {
        $order = CustomerOrder::with('items.product')->where('order_code', $orderCode)->first();
        $order = CustomerOrder::with('items.product.images')->where('order_code', $orderCode)->first();
        return view('AdminDashboard.order-details', compact('order'));
    }


    public function updateStatus(Request $request, $orderCode)
    {
        // Fetch the order
        $order = CustomerOrder::where('order_code', $orderCode)->firstOrFail();
        $oldStatus = $order->status; // 👈 Track old status

        // Define valid transitions for the admin
        $validTransitions = [
            'Pending' => ['Accepted'], // ✅ Allow first transition
            'Accepted' => ['Packed'],
            'Packed' => ['Pickup Done'],
            'Pickup Done' => ['Ready to Ship'],
            'Ready to Ship' => ['Shipped'],
            'Shipped' => ['In Transit'],
            'In Transit' => ['Delivered', 'Customer Unavailable', 'Rescheduled'],
            'Customer Unavailable' => ['Rescheduled', 'In Transit'],
            'Rescheduled' => ['In Transit'],
            'Delivered' => [],
            'Cancelled' => [],
            'Returned' => [],
        ];


        // Define activity log messages
        $statusMessages = [
            'Accepted' => 'Order has been accepted.',
            'Packed' => 'Order has been packed.',
            'Pickup Done' => 'Order picked up by the delivery partner.',
            'Ready to Ship' => 'Order is ready to ship.',
            'Shipped' => 'Order shipped to the customer.',
            'In Transit' => 'Order is in transit.',
            'Customer Unavailable' => 'Customer was unavailable at delivery.',
            'Rescheduled' => 'Delivery has been rescheduled.',
            'Delivered' => 'Order delivered to the customer.',
            'Cancelled' => 'Order has been cancelled.',
            'Returned' => 'Order has been returned.',
        ];

        // Validate the input status
        $request->validate([
            'status' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($order, $validTransitions) {
                    // Check if the current status allows a transition
                    if (!isset($validTransitions[$order->status])) {
                        $fail("The current status '{$order->status}' cannot be updated.");
                    }

                    // Check if the new status is a valid transition
                    if (!in_array($value, $validTransitions[$order->status]) && !in_array($value, ['Cancelled', 'Returned'])) {
                        $fail("The status transition from '{$order->status}' to '{$value}' is not allowed.");
                    }
                },
            ],
            'tracking_number'=> 'nullable|string|max:255',
            'tracking_link' => 'nullable|url|max:255',
        ]);

        // Add an activity log for the status change
        if (isset($statusMessages[$request->status])) {
            $order->addActivityLog($statusMessages[$request->status]);
        }

        // Update the order status
        $updateData = [
            'status' => $request->status,
        ];

        if ($request->status == 'Shipped') {
            $updateData['tracking_number'] = $request->tracking_number;
            $updateData['tracking_link'] = $request->tracking_link;
        }

        $order->update($updateData);

        // Send email to customer
        if ($order->email) {
            Mail::to($order->email)->send(new OrderStatusUpdatedMail($order, $request->status));
        }

        if($request->status == 'Delivered' && $order->order_type == 'annonymous'){
            $this->dealerPointAdd($order);
        }

        // 🟥 If status changed *from* Delivered to Returned/Cancelled → reverse commissions
        if (in_array($request->status, ['Returned', 'Cancelled']) && $oldStatus == 'Delivered') {
            $this->reverseDealerPointsAndCommissions($order);
        }

        // Return success message
        return redirect()->back()->with('success', "Order status updated to '{$request->status}' successfully.");
    }

    protected function dealerPointAdd($customerOrder){
        // 1. Get dealer and product IV
        // Assuming items() returns a relationship and dealerProductLink() returns a related model with dealer_id
        $firstItem = $customerOrder->items()->first();
        $dealerProductLink = $firstItem ? $firstItem->dealerProductLink : null;
        $dealerId = $dealerProductLink ? $dealerProductLink->dealer_id : null;
        $dealer = $dealerId ? User::find($dealerId) : null;

        if (!$dealer || !$dealer->dealerProfile) return;

        $dealerProfile = $dealer->dealerProfile;

        // IV = Distributor Profit / 100
        $iv = $customerOrder->items()->sum('bv');
        $rankPercent = $this->getRankPercentage($dealerProfile->rank);

        // 1. Direct Commission
        $directBVCommission = $iv * ($rankPercent / 100);

        // 2. Direct Commission (self)
        $directCommission = $iv * $rankPercent;

        Commission::create([
            'dealer_id' => $dealer->id,
            'from_user_id' => $dealer->id,
            'bv' => $directBVCommission, // ✅ only the real value used for commission
            'amount' => $directCommission,
            'level' => 'direct',
            'customer_order_id' => $customerOrder->id,
        ]);

        // Insert dealer point to profile
        $this->insertDealerPointToProfile($dealer->id, $directBVCommission);

        // 3. Traverse uplines
        $currentDealer = $dealer;
        $currentPercent = $rankPercent;

        while ($uplineRef = $currentDealer->referredByDealer) {
            $upline = $uplineRef->dealer;

            if (!$upline || !$upline->dealerProfile) break;

            $uplinePercent = $this->getRankPercentage($upline->dealerProfile->rank);
            $gap = $uplinePercent - $currentPercent;

            if ($gap > 0) {
                $gapCommission = $iv * $gap;
                $gapBVCommission = $iv * ($gap / 100);

                Commission::create([
                    'dealer_id' => $upline->id,
                    'from_user_id' => $dealer->id,
                    'bv' => $gapBVCommission,
                    'amount' => $gapCommission,
                    'level' => 'rank',
                    'customer_order_id' => $customerOrder->id,
                ]);
                // Insert dealer point to profile
                $this->insertDealerPointToProfile($upline->id, $gapBVCommission);
            }

            $currentDealer = $upline;
            $currentPercent = $uplinePercent;

            // optional: break if upline is top (Diamond)
            if ($uplinePercent == 100) break;
        }
    }

    protected function getRankPercentage($rank)
    {
        return match ($rank) {
            'Loyalty Member' => 50,
            'Bronze Member' => 60,
            'Silver Member' => 70,
            'Gold Member' => 80,
            'Platinum Member' => 90,
            'Diamond Member' => 100,
            default => 0,
        };
    }

    protected function insertDealerPointToProfile($dealerId, $point){
        $dealer = User::where("role", "dealer")->where("id", $dealerId)->first();
        if (!$dealer || !$dealer->dealerProfile) return;

        $dealerProfile = DealerProfile::find($dealer->dealerProfile->id);
        if (!$dealerProfile) return;
        $dealerProfile->bv += $point;
        $dealerProfile->cbv += $point; // Assuming cbv is the same as bv
        $dealerProfile->save();

        $newRank = $this->checkDealerCanGoToNextRank($dealerProfile);

        if ($newRank) {
            $newTier = $this->getTierFromRank($newRank);
            $dealer->dealerProfile->update([
                'rank' => $newRank,
                'tier' => $newTier,
            ]);
        }
    }

    protected function checkDealerCanGoToNextRank($dealerProfile)
    {
        $dealer = $dealerProfile->user;

        if (!$dealer || !$dealerProfile) return null;

        $currentRank = $dealerProfile->rank;

        $rankMap = [
            'Loyalty Member' => [
                'name' => 'Bronze Member',
                'target_cbv' => 700,
                'methods' => [
                    ['cbv' => 700, 'links' => 0, 'bronze' => 0],
                ],
            ],
            'Bronze Member' => [
                'name' => 'Silver Member',
                'target_cbv' => 10000,
                'methods' => [
                    ['cbv' => 5000, 'links' => 0, 'bronze' => 0],
                    ['cbv' => 10000, 'links' => 2, 'bronze' => 2],
                    ['cbv' => 6000, 'links' => 3, 'bronze' => 3],
                ],
            ],
            'Silver Member' => [
                'name' => 'Gold Member',
                'target_cbv' => 15000,
                'methods' => [
                    ['cbv' => 15000, 'links' => 0, 'bronze' => 0],
                    ['cbv' => 40000, 'links' => 2, 'bronze' => 2],
                    ['cbv' => 26000, 'links' => 3, 'bronze' => 3],
                ],
            ],
            'Gold Member' => [
                'name' => 'Platinum Member',
                'target_cbv' => 45000,
                'methods' => [
                    ['cbv' => 45000, 'links' => 0, 'bronze' => 0],
                    ['cbv' => 120000, 'links' => 2, 'bronze' => 2],
                    ['cbv' => 85000, 'links' => 3, 'bronze' => 3],
                ],
            ],
            'Platinum Member' => [
                'name' => 'Diamond Member',
                'target_cbv' => 135000,
                'methods' => [
                    ['cbv' => 135000, 'links' => 0, 'bronze' => 0],
                    ['cbv' => 300000, 'links' => 2, 'bronze' => 2],
                    ['cbv' => 270000, 'links' => 3, 'bronze' => 3],
                ],
            ],
        ];

        // If current rank is top or not mapped
        if (!isset($rankMap[$currentRank])) {
            return null;
        }

        $nextRank = $rankMap[$currentRank];
        $cbv = $dealerProfile->cbv;

        // Load direct referrals and their profiles
        $referrals = $dealer->directReferrals()->with('dealerProfile')->get();

        $qualifiedLinks = $referrals->filter(function ($ref) {
            return $ref->dealerProfile !== null;
        });

        $bronzeCount = $qualifiedLinks->filter(function ($ref) {
            return $ref->dealerProfile->rank === 'Bronze Member';
        })->count();

        $linkCount = $qualifiedLinks->count();

        // Check if any method qualifies
        foreach ($nextRank['methods'] as $method) {
            if (
                $cbv >= $method['cbv'] &&
                $linkCount >= $method['links'] &&
                $bronzeCount >= $method['bronze']
            ) {
                return $nextRank['name'];
            }
        }

        return null;
    }

    protected function getTierFromRank($rank)
    {
        return match ($rank) {
            'Loyalty Member' => 'Loyalty',
            'Bronze Member' => 'Bronze',
            'Silver Member' => 'Silver',
            'Gold Member' => 'Gold',
            'Platinum Member' => 'Platinum',
            'Diamond Member' => 'Diamond',
            'Executive Diamond' => 'Executive Diamond',
            'Royal Diamond' => 'Royal Diamond',
            default => 'Loyalty', // fallback
        };
    }

    protected function reverseDealerPointsAndCommissions(CustomerOrder $order)
    {
        // Find all related commissions
        $commissions = Commission::where('customer_order_id', $order->id)->get();

        foreach ($commissions as $commission) {
            $dealerProfile = DealerProfile::where('user_id', $commission->dealer_id)->first();
            if (!$dealerProfile) continue;

            // Revert points (BV & CBV) if previously added
            $dealerProfile->bv = max(0, $dealerProfile->bv - $commission->bv);
            $dealerProfile->cbv = max(0, $dealerProfile->cbv - $commission->bv);
            $dealerProfile->save();

            // Delete the commission entry
            $commission->delete();
        }

        // Optional: Log this reversal
        $order->addActivityLog('Dealer commissions and BV reversed due to cancellation/return.');
    }
}
