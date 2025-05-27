<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('customer_orders', function (Blueprint $table) {
            $table->enum('status', [
                'Pending', 
                'Accepted', 
                'Packed', 
                'Pickup Done', 
                'Ready to Ship', 
                'Shipped', 
                'In Transit', 
                'Customer Unavailable', 
                'Rescheduled', 
                'Delivered', 
                'Cancelled', 
                'Returned'
            ])->default('Pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_orders', function (Blueprint $table) {
            $table->enum('status', ['Pending', 'Accepted', 'Shipped', 'Delivered', 'Cancelled', 'Returned'])
                ->default('Pending')->change();
        });
    }
};
