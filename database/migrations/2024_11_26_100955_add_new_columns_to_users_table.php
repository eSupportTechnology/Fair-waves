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
            $table->enum('role', ['customer', 'dealer', 'supplier'])->after('password');
            $table->unsignedBigInteger('referred_by')->nullable()->after('role'); // referral tracking
            $table->foreign('referred_by')->references('id')->on('users')->onDelete('set null');
            $table->string('fname')->nullable()->after('name');
            $table->string('lname')->nullable()->after('fname');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->dropColumn('referred_by');
            $table->dropColumn('fname');
            $table->dropColumn('lname');
        });
    }
};
