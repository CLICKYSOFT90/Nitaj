<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FundingCampaigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funding_campaigns', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->string('campaign_type');
            $table->date('starting_period');
            $table->date('ending_period');
            $table->double('amount_required');
            $table->integer('funding_phases');
            $table->integer('status');
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
