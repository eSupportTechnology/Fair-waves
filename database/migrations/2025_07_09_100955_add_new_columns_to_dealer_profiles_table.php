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
            $table->string('dealer_shop_name')->nullable()->unique()->after('dealer_code');
            // Adding a unique constraint to ensure no two dealers can have the same shop name
            // This is optional based on your requirements, but it helps maintain uniqueness
            $table->unique('dealer_shop_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dealer_profiles', function (Blueprint $table) {
            $table->dropColumn('dealer_shop_name');
        });
    }
};
