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
        Schema::table('car_registration_years', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['car_brand_id']);

            // Drop the car_brand_id column
            $table->dropColumn('car_brand_id');
        });

        Schema::table('car_varient', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['car_registration_year_id']);

            // Drop the car_registration_year_id column
            $table->dropColumn('car_registration_year_id');
        });

        Schema::table('car_fuel_type', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['car_varient_id']);

            // Drop the car_varient_id column
            $table->dropColumn('car_varient_id');
            $table->dropColumn('transmission');
        });

        Schema::table('car_fuel_varient', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['car_fuel_type_id']);

            // Drop the car_fuel_type_id column
            $table->dropColumn('car_fuel_type_id');
        });

        Schema::table('car_varient_type', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['car_fuel_varient_id']);

            // Drop the car_fuel_varient_id column
            $table->dropColumn('car_fuel_varient_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('car_registration_years', function (Blueprint $table) {
            // Add the car_brand_id column back
            $table->unsignedBigInteger('car_brand_id');

            // Re-add the foreign key constraint
            $table->foreign('car_brand_id')->references('id')->on('car_brand');
        });

        Schema::table('car_varient', function (Blueprint $table) {
            // Add the car_registration_year_id column back
            $table->unsignedBigInteger('car_registration_year_id');

            // Re-add the foreign key constraint
            $table->foreign('car_registration_year_id')->references('id')->on('car_registration_years');
        });

        Schema::table('car_fuel_type', function (Blueprint $table) {
            // Add the car_varient_id column back
            $table->unsignedBigInteger('car_varient_id');
            $table->string('transmission');

            // Re-add the foreign key constraint
            $table->foreign('car_varient_id')->references('id')->on('car_varient');
        });

        Schema::table('car_fuel_varient', function (Blueprint $table) {
            // Add the car_fuel_type_id column back
            $table->unsignedBigInteger('car_fuel_type_id');

            // Re-add the foreign key constraint
            $table->foreign('car_fuel_type_id')->references('id')->on('car_fuel_type');
        });

        Schema::table('car_varient_type', function (Blueprint $table) {
            // Add the car_fuel_varient_id column back
            $table->unsignedBigInteger('car_fuel_varient_id');

            // Re-add the foreign key constraint
            $table->foreign('car_fuel_varient_id')->references('id')->on('car_fuel_varient');
        });
    }
};
