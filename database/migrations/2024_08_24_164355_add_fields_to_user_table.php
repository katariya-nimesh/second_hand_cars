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
        Schema::table('users', function (Blueprint $table) {
            $table->year('year_of_establishment')->nullable();
            $table->string('gst_number')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode')->nullable();
            $table->string('business_email')->nullable();
            $table->string('type_of_business')->nullable();
            $table->string('name_of_partner_1')->nullable();
            $table->string('name_of_partner_2')->nullable();
            $table->string('phoneno_2')->nullable();
            $table->string('vendor_live_photo')->nullable();
            $table->string('business_live_photo')->nullable();
            $table->string('gst_certificate')->nullable();
            $table->string('partnersheep_deed')->nullable();
            $table->string('adharcard_one')->nullable();
            $table->string('adharcard_two')->nullable();
            $table->string('cancel_cheque')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn([
                'year_of_establishment',
                'gst_number',
                'address',
                'city',
                'state',
                'pincode',
                'business_email',
                'type_of_business',
                'name_of_partner_1',
                'name_of_partner_2',
                'phoneno_2',
                'vendor_live_photo',
                'business_live_photo',
                'gst_certificate',
                'partnersheep_deed',
                'adharcard_one',
                'adharcard_two',
                'cancel_cheque'
            ]);
        });
    }
};
