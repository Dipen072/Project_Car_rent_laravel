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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');//1
            $table->string('email')->unique();//2
            $table->string('password');//3
            $table->string('gender');//4
            $table->string('hobbies');//5
            $table->string('mobile');//6
            $table->text('address')->nullable();//7
            $table->string('city')->nullable();//8
            $table->string('state')->nullable();//9
            $table->string('pincode')->nullable();//10
            $table->string('profile_image')->nullable();//11
            $table->string('license_number')->nullable();//12
            $table->enum('status',['Blocked','Unblocked'])->default('Unblocked');//13
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
