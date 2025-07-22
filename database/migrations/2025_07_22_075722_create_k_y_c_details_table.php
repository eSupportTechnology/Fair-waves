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
        Schema::create('k_y_c_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('kyc_doc_type', ['NIC', 'DL', 'Passport'])->nullable();
            $table->string('kyc_doc_number')->nullable();
            $table->string('kyc_doc_front')->nullable(); // front image of NIC/passport
            $table->string('kyc_doc_back')->nullable();  // back image
            $table->string('selfie')->nullable();         // selfie with ID
            $table->enum('kyc_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->string('kyc_reject_reason')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('k_y_c_details');
    }
};
