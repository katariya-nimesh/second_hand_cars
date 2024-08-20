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
        Schema::table('car_images', function (Blueprint $table) {
            $table->dropForeign(['car_varient_type_id']);

            // Drop the car_varient_type_id column
            $table->dropColumn('car_varient_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('car_images', function (Blueprint $table) {
            $table->unsignedBigInteger('car_varient_type_id');

            // Re-add the foreign key constraint
            $table->foreign('car_varient_type_id')->references('id')->on('car_varient_type');
        });
    }
};
