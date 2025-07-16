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
        Schema::table('customer_order_items', function (Blueprint $table) {
            // Step 1: Add the column as nullable
            $table->foreignId('dealer_product_link_id')->nullable()->after('product_id');
        });

        // Step 2: (Manual) Update existing rows to set dealer_product_link_id to a valid value or NULL as needed

        // Step 3: Add the foreign key constraint
        Schema::table('customer_order_items', function (Blueprint $table) {
            $table->foreign('dealer_product_link_id')->references('id')->on('dealer_product_links')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_order_items', function (Blueprint $table) {
            $table->dropColumn('dealer_product_link_id');
        });
    }
};
