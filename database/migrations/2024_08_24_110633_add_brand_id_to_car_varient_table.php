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
        Schema::table('car_varient', function (Blueprint $table) {
            $table->unsignedBigInteger('car_brand_id')->nullable();
            $table->foreign('car_brand_id')->references('id')->on('car_brand')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('car_varient', function (Blueprint $table) {
            $table->dropForeign(['car_brand_id']);
            $table->dropColumn('car_brand_id');
        });
    }
};
