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
        Schema::create('dealer_referrals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dealer_id');      // the one who refers
            $table->unsignedBigInteger('referred_id');    // the one who is referred
            $table->boolean('approved')->default(false);  // referrer approval
            $table->timestamps();

            $table->foreign('dealer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('referred_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['dealer_id', 'referred_id']); // avoid duplicate referrals
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dealer_referrals');
    }
};
