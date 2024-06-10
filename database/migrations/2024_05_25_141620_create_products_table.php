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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2)->default(0);
            $table->string('img');
            $table->json('gallery')->nullable();
            $table->integer('status');
            $table->json('option')->nullable();
            $table->string('quantity');
            $table->unsignedBigInteger('brand_id')->default(0);
            $table->unsignedBigInteger('sold')->default(0);
            $table->unsignedBigInteger('view')->default(0);
            $table->unsignedBigInteger('categories_id')->default(0); // Uncomment this line
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
