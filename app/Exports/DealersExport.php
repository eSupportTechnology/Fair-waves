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
            'No.',
            'Name',
            'Shop Name',
            'Email',
            'Phone Number',
            'Dealer Code',
            'Rank',
            'Tier'
        ];
    }

    public function map($dealer): array
    {
        static $counter = 1;
        
        return [
            $counter++,
            $dealer->name ?? 'N/A',
            $dealer->dealerProfile->dealer_shop_name ?? 'N/A',
            $dealer->email ?? 'N/A',
            $dealer->phone ?? 'N/A',
            $dealer->dealerProfile->dealer_code ?? 'N/A',
            $dealer->dealerProfile->rank ?? 'N/A',
            $dealer->dealerProfile->tier ?? 'N/A'
        ];
    }
}
