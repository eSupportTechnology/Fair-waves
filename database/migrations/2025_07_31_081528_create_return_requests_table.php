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
        Schema::create('return_requests', function (Blueprint $table) {
            $table->id();
            $table->string('order_code');
            $table->string('customer_name');
            $table->string('phone');
            $table->string('email');
            $table->date('order_date');
            $table->text('cancel_reason');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('admin_response')->nullable();
            $table->string('processed_by')->nullable(); // Admin who processed the request
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
            
            // Add foreign key constraint to customer_orders table
            $table->foreign('order_code')->references('order_code')->on('customer_orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_requests');
    }
};
