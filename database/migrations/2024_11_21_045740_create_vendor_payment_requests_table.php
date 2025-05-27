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
        Schema::create('vendor_payment_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id'); 
            $table->decimal('request_amount', 10, 2); 
            $table->string('bank_name');
            $table->string('branch');
            $table->string('account_name');
            $table->string('account_number');
            $table->decimal('processing_fee', 10, 2)->default(0.00); 
            $table->decimal('paid_amount', 10, 2)->default(0.00); 
            $table->string('status')->default('Pending'); 
            $table->timestamp('requested_at')->useCurrent(); 
            $table->timestamps();

             // Foreign key to vendors table
             $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_payment_requests');
    }
};
