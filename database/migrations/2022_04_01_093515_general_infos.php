<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GeneralInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('social_status');
            $table->string('current_occupation');
            $table->string('education_level');
            $table->tinyInteger('worked_in_financial_sector');
            $table->tinyInteger('practical_experience');
            $table->string('real_estate_investing_exp');
            $table->tinyInteger('board_director_audit_commitee');
            $table->tinyInteger('relationship');
            $table->string('beneficial_owner_business');
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
