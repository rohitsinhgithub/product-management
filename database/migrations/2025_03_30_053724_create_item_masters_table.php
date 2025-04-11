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
        Schema::create('item_masters', function (Blueprint $table) {
            $table->string('id', 8)->primary(); // Change to string and set length to 8
            $table->string('name');
            $table->string('item_type');
            $table->string('hsn_sac_code')->nullable();
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->decimal('mrp', 10, 2)->nullable();
            $table->string('barcode');
            $table->decimal('purchase_price', 10, 2)->nullable();
            $table->string('unit_of_measure');
            $table->string('sku')->nullable();
            $table->decimal('sales_cost', 10, 2)->nullable();
            $table->boolean('is_tax_included')->default(false);
            $table->decimal('cgst', 5, 2)->nullable();
            $table->decimal('sgst', 5, 2)->nullable();
            $table->decimal('igst', 5, 2)->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('sub_category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_masters');
    }
};
