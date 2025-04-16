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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('contact_person')->nullable();
            $table->text('address')->nullable();
            $table->string('state');
            $table->string('city')->nullable();
            $table->string('phone_number');
            $table->string('email')->nullable();
            $table->string('gstin')->nullable();
            $table->string('pan_card_no')->nullable();
            $table->string('aadhar_card_no')->nullable();
            $table->string('cin')->nullable();
            $table->string('tan')->nullable();
            $table->string('tin')->nullable();
            $table->boolean('status');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
