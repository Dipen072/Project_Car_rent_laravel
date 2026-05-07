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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('car_name');
            $table->string('brand');
            $table->decimal('price_per_day', 10, 2);
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->integer('doors')->default(4);
            $table->integer('seats')->default(5);
            $table->string('transmission')->default('Automatic');
            $table->integer('min_age')->default(18);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
