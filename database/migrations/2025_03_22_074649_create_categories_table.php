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
        Schema::create('categories', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('category_type')->nullable();
            $table->string('category_name')->nullable();
            $table->string('sub_category')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('is_main')->nullable();
            $table->string('image_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
