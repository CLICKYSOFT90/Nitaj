<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProjectFunding extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_fundings', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->integer('funding_required');
            $table->integer('min_investment');
            $table->integer('no_of_shares');
            $table->integer('price_per_share');
            $table->integer('project_roi');
            $table->integer('investment_period');
            $table->string('structure');
            $table->integer('dividend_yield');
            $table->string('dividend_frequency');
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
