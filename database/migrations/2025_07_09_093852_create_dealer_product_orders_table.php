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
        Schema::create('dealer_product_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dealer_product_link_id')->constrained()->onDelete('cascade');
            $table->string('customer_name');
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['Pending', 'Accepted', 'Shipped', 'Delivered', 'Cancelled', 'Returned'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dealer_product_orders');
    }
};
