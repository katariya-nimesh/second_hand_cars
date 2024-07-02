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
        Schema::create('car_varient', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('car_registration_year_id');
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('car_registration_year_id')->references('id')->on('car_registration_years')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_varient');
    }
};
