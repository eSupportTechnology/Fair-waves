<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('reviews', function (Blueprint $table) {
        $table->unsignedBigInteger('reviewer_id')->nullable();
        $table->foreign('reviewer_id')->references('id')->on('users')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('reviews', function (Blueprint $table) {
        $table->dropForeign(['reviewer_id']);
        $table->dropColumn('reviewer_id');
    });
}

};
