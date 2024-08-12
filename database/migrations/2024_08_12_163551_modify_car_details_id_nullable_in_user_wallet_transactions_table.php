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
        Schema::table('user_wallet_transactions', function (Blueprint $table) {
            $table->dropForeign(['car_details_id']); // Drop the foreign key constraint
            $table->dropColumn('car_details_id'); // Drop the column

            $table->unsignedBigInteger('car_details_id')->nullable(); // Add the column back (as nullable)
            $table->foreign('car_details_id')->references('id')->on('car_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_wallet_transactions', function (Blueprint $table) {
            // 
        });
    }
};
