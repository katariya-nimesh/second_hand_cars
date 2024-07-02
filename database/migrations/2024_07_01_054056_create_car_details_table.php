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
        Schema::create('car_details', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->unsignedBigInteger('car_varient_type_id');
            $table->unsignedBigInteger('car_owner_id');
            $table->unsignedBigInteger('car_kilometer_id');
            $table->string('price');
            $table->string('status');
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('car_varient_type_id')->references('id')->on('car_varient_type')->onDelete('cascade');
            $table->foreign('car_owner_id')->references('id')->on('car_owner')->onDelete('cascade');
            $table->foreign('car_kilometer_id')->references('id')->on('car_kilometer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_details');
    }
};
