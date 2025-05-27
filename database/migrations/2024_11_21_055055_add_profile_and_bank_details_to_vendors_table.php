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
        Schema::table('vendors', function (Blueprint $table) {
            // Add new columns with nullable property
            $table->string('profile_image')->nullable()->after('status');
            $table->string('bank_name')->nullable()->after('profile_image');
            $table->string('branch')->nullable()->after('bank_name');
            $table->string('account_name')->nullable()->after('branch');
            $table->string('account_number')->nullable()->after('account_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vendors', function (Blueprint $table) {
            // Drop the columns if rollback is performed
            $table->dropColumn([
                'profile_image',
                'bank_name',
                'branch',
                'account_name',
                'account_number'
            ]);
        });
    }
};
