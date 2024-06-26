<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FinancialStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_statuses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('net_worth');
            $table->string('net_worth');
            $table->string('curr_invested');
            $table->string('annual_income');
            $table->string('expected_invest_oppornity');
            $table->string('expected_amount_annually');
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
