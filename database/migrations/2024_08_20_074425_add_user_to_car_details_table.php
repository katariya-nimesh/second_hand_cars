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
            $table->unsignedBigInteger('user_id')->nullable(); // Add the column back (as nullable)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
            $table->dropForeign(['user_id']);

            // Drop the user_id column
            $table->dropColumn('user_id');
        });
    }
};
