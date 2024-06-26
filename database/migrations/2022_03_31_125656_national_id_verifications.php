<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NationalIdVerifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('national_id_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('lang_type');
            $table->integer('user_id');
            $table->string('national_id');
            $table->dateTime('dob');
            $table->string('first_name');
            $table->string('second_name');
            $table->string('third_name');
            $table->string('last_name');
            $table->date('id_expire');
            $table->string('gender');
            $table->string('unit_address');
            $table->string('building_number');
            $table->string('street_name');
            $table->string('district');
            $table->string('city');
            $table->integer('postal_code');
            $table->integer('additional_code');
            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
