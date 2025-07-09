<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class DealersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::where('role', 'dealer')
            ->when($this->search, function($query) {
                return $query->where(function($q) {
                    $q->where('name', 'LIKE', '%' . $this->search . '%')
                      ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                      ->orWhere('phone', 'LIKE', '%' . $this->search . '%');
                });
            })
            // TODO: Uncomment for future development - Total Orders functionality
            // ->withCount('customerOrders')
            ->with('dealerProfile')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Address',
            'Date of Birth',
            'Gender',
            'Registration Date',
            'Dealer Code',
            'Total Orders',
            'Status'
        ];
    }

    public function map($dealer): array
    {
        return [
            $dealer->id,
            $dealer->name,
            $dealer->email,
            $dealer->phone ?? 'N/A',
            $dealer->address ?? 'N/A',
            $dealer->dob ? Carbon::parse($dealer->dob)->format('Y-m-d') : 'N/A',
            $dealer->gender ?? 'N/A',
            $dealer->created_at->format('Y-m-d'),
            $dealer->dealerProfile->dealer_code ?? 'N/A',
            // TODO: Uncomment for future development - Total Orders functionality
            // $dealer->customer_orders_count,
            '', // Empty placeholder for Total Orders column
            $dealer->dealer_status == 1 ? 'Active' : 'Inactive'
        ];
    }
}
