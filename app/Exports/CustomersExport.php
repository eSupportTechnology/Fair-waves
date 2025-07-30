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
            'No.',
            'Name',
            'DOB',
            'Email',
            'Phone Number',
            'Address'
        ];
    }

    public function map($customer): array
    {
        static $counter = 1;
        
        return [
            $counter++,
            $customer->name,
            $customer->dob ? Carbon::parse($customer->dob)->format('Y-m-d') : 'N/A',
            $customer->email,
            $customer->phone ?? 'N/A',
            $customer->address ?? 'N/A'
        ];
    }
}
