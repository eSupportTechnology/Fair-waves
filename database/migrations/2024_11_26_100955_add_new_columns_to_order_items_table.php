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
            $table->unsignedBigInteger('customer_order_id')->nullable()->after('order_code'); // referral tracking
            $table->foreign('customer_order_id')->references('id')->on('customer_orders')->onDelete('set null');
            $table->integer('bv')->nullable()->after('reviewed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_order_items', function (Blueprint $table) {
            $table->dropColumn('customer_order_id');
            $table->dropColumn('bv');
        });
    }
};
