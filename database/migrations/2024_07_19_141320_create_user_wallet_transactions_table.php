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
        Schema::create('user_wallet_transactions', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // Foreign key
            $table->unsignedBigInteger('car_details_id'); // Foreign key
            $table->string('car_image')->nullable(); // Path to the car image
            $table->string('car_name')->nullable(); // Name of the car
            $table->date('date'); // Transaction date
            $table->decimal('amount', 10, 2); // Amount with 2 decimal places
            $table->string('transaction_type'); // Transaction type (e.g., credit, debit)
            $table->timestamps(); // created_at and updated_at

            // Define foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('user_wallet_transactions');
    }
};
