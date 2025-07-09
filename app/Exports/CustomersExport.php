<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class CustomersExport implements FromCollection, WithHeadings, WithMapping
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
        return User::where('role', 'customer')
            ->when($this->search, function($query) {
                return $query->where(function($q) {
                    $q->where('name', 'LIKE', '%' . $this->search . '%')
                      ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                      ->orWhere('phone', 'LIKE', '%' . $this->search . '%');
                });
            })
            // TODO: Uncomment for future development - Total Orders functionality
            // ->withCount('customerOrders')
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
            'Total Orders',
            'Status'
        ];
    }

    public function map($customer): array
    {
        return [
            $customer->id,
            $customer->name,
            $customer->email,
            $customer->phone ?? 'N/A',
            $customer->address ?? 'N/A',
            $customer->dob ? Carbon::parse($customer->dob)->format('Y-m-d') : 'N/A',
            $customer->gender ?? 'N/A',
            $customer->created_at->format('Y-m-d'),
            // TODO: Uncomment for future development - Total Orders functionality
            // $customer->customer_orders_count,
            '-', // Placeholder for future Total Orders column
            $customer->customer_status == 1 ? 'Active' : 'Inactive'
        ];
    }
}
