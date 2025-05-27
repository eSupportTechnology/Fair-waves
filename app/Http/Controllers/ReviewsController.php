<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrder;
use App\Models\CustomerOrderItems;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReviewsController extends Controller
{
    public function myReviews()
    {
        $userId = Auth::id();

        $orders = CustomerOrder::where('user_id', $userId)->pluck('order_code');

        $toBeReviewedItems = CustomerOrderItems::whereIn('order_code', $orders)
            ->where('reviewed', 'no')
            ->with(['product.images'])
            ->get();

        $historyItems = CustomerOrderItems::whereIn('order_code', $orders)
            ->where('reviewed', 'yes')
            ->with([
                'product.images', // Eager load product images
                'review'          // Eager load the associated review
            ])
            ->get();

        return view('user_dashboard.My-Reviews', compact('toBeReviewedItems', 'historyItems'));
    }


    public function writeReviews($id)
    {
        //Log::info($id);
        
        $orderItem = CustomerOrderItems::findOrFail($id);
        $product = Product::findOr($orderItem->product_id);
        return view('user_dashboard.Write-Reviews', compact('product', 'orderItem'));
    }

    public function store(Request $request, $id)
    {
        //Log::info('Store request data: ', $request->all());
        //Log::info($id);

        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'nullable|integer|min:0|max:5',
            'review' => 'nullable|string|max:500',
            'is_anonymous' => 'boolean',
            'media' => 'nullable|array',
            'media.*' => 'mimes:jpg,jpeg,png,mp4,mov,avi|max:5120', // 5MB limit
        ]);

        // Handle media upload
        $mediaPaths = [];
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $media) {
                $mediaPaths[] = $media->store('reviews/media', 'public');
            }
        }


        if ($validatedData['rating'] == null) {
            $validatedData['rating'] = 0;
        }
        $validatedData['media'] = $mediaPaths;
        $validatedData['status'] = 'Pending'; // Default status
        $validatedData['reviewer_id'] = Auth::id();
        $validatedData['order_item_id'] = $id;

        Review::create($validatedData);

        $orderItem = CustomerOrderItems::find($id);

        if ($orderItem) {
            $orderItem->reviewed = 'yes';
            $orderItem->save();
        }

        return redirect()->route('My-Reviews')->with('success', 'Review submitted successfully.');
    }


    public function customerDestroy(Review $review)
    {
        $orderItemId = $review->order_item_id;

        if ($orderItemId) {
            CustomerOrderItems::where('id', $orderItemId)->update(['reviewed' => 'no']);
        }

        $review->delete();

        return redirect()->route('My-Reviews')->with('success', 'Review deleted successfully.');
    }











    //Admin

    public function adminView()
    {
        $publishedReviews = Review::with(['product', 'reviewer'])
            ->where('status', 'Published')
            ->latest()
            ->paginate(10, ['*'], 'published_page'); // Separate pagination for published

        $pendingReviews = Review::with(['product', 'reviewer'])
            ->where('status', 'Pending')
            ->latest()
            ->paginate(10, ['*'], 'pending_page'); // Separate pagination for pending

        $rejectedReviews = Review::with(['product', 'reviewer'])
            ->where('status', 'Rejected')
            ->latest()
            ->paginate(10, ['*'], 'rejected_page');

        return view('AdminDashboard.reviews', compact('publishedReviews', 'pendingReviews', 'rejectedReviews'));
    }

    public function adminViewDetails($id)
    {
        $review = Review::findOrFail($id);
        return view('AdminDashboard.review_details', compact('review'));
    }


    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:Pending,Published,Rejected',
        ]);

        $review = Review::findOrFail($id);
        $review->update(['status' => $validated['status']]);

        return redirect()->route('adminReviews')->with('success', 'Review status updated successfully.');
    }


    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->back()->with('success', 'Review deleted successfully.');
    }
}
