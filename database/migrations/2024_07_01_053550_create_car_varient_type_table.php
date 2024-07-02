<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_varient_type', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('car_fuel_varient_id');
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('car_fuel_varient_id')->references('id')->on('car_fuel_varient')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_varient_type');
    }
};
