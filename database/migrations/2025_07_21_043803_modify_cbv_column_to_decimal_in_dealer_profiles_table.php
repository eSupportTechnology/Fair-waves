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
        Schema::table('dealer_profiles', function (Blueprint $table) {
            $table->decimal('cbv', 8, 2)->default(0)->change();
            $table->enum('tier', ['Loyalty', 'Bronze', 'Silver', 'Gold', 'Platinum', 'Diamond', 'Executive Diamond', 'Royal Diamond'])->default('Loyalty')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dealer_profiles', function (Blueprint $table) {
            $table->integer('cbv')->default(0)->change();
            $table->enum('tier', ['Loyalty', 'Bronze', 'Silver', 'Gold', 'Platinum', 'Diamond'])->default('Loyalty')->change();
        });
    }
};
