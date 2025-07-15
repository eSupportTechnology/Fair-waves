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
        Schema::table('users', function (Blueprint $table) {
            // Add columns that are in the fillable array but might not exist in the table
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['user', 'dealer', 'admin'])->default('user');
            }
            if (!Schema::hasColumn('users', 'referred_by')) {
                $table->unsignedBigInteger('referred_by')->nullable();
            }
            if (!Schema::hasColumn('users', 'fname')) {
                $table->string('fname')->nullable();
            }
            if (!Schema::hasColumn('users', 'lname')) {
                $table->string('lname')->nullable();
            }
            if (!Schema::hasColumn('users', 'customer_status')) {
                $table->boolean('customer_status')->default(true);
            }
            if (!Schema::hasColumn('users', 'dealer_status')) {
                $table->boolean('dealer_status')->default(false);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'referred_by', 'fname', 'lname', 'customer_status', 'dealer_status']);
        });
    }
};
