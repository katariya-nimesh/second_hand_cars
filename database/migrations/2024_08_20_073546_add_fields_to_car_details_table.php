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
        Schema::table('car_details', function (Blueprint $table) {
            // Add car_brand_id to car_details
            $table->unsignedBigInteger('car_brand_id');

            // Add car_registration_year_id to car_details
            $table->unsignedBigInteger('car_registration_year_id');

            // Add car_varient_id and transmission to car_details
            $table->unsignedBigInteger('car_varient_id');
            $table->string('transmission');

            // Add car_fuel_type_id to car_details
            $table->unsignedBigInteger('car_fuel_type_id');

            // Add car_fuel_varient_id to car_details
            $table->unsignedBigInteger('car_fuel_varient_id');

            // Add foreign key constraints (if applicable)
            $table->foreign('car_brand_id')->references('id')->on('car_brands')->onDelete('cascade');
            $table->foreign('car_registration_year_id')->references('id')->on('car_registration_years')->onDelete('cascade');
            $table->foreign('car_varient_id')->references('id')->on('car_varients')->onDelete('cascade');
            $table->foreign('car_fuel_type_id')->references('id')->on('car_fuel_types')->onDelete('cascade');
            $table->foreign('car_fuel_varient_id')->references('id')->on('car_fuel_varients')->onDelete('cascade');

            $table->dropForeign(['user_id']);

            // Drop the user_id column
            $table->dropColumn('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('car_details', function (Blueprint $table) {
            // Drop foreign key constraints first
            $table->dropForeign(['car_brand_id']);
            $table->dropForeign(['car_registration_year_id']);
            $table->dropForeign(['car_varient_id']);
            $table->dropForeign(['car_fuel_type_id']);
            $table->dropForeign(['car_fuel_varient_id']);

            // Drop the columns
            $table->dropColumn([
                'car_brand_id',
                'car_registration_year_id',
                'car_varient_id',
                'transmission',
                'car_fuel_type_id',
                'car_fuel_varient_id'
            ]);

            $table->unsignedBigInteger('user_id'); // Add the column back (as nullable)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};