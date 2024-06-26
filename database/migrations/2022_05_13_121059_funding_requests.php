<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FundingRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funding_requests', function (Blueprint $table) {
            $table->id();
            $table->string('investor_type');
            $table->string('occupation');
            $table->string('company_name');
            $table->string('unit_no');
            $table->string('street');
            $table->string('district');
            $table->string('city');
            $table->string('country');
            $table->string('zip_code');
            $table->string('company_cr')->nullable();
            $table->string('project_type');
            $table->string('asset_type');
            $table->string('land_status');
            $table->string('location');
            $table->string('project_details');
            $table->string('profile_attachment');
            $table->string('project_doc_attachment');
            $table->Integer('amount');
            $table->string('email');
            $table->tinyInteger('status');
            $table->string('funding_structure');
            $table->string('proj_value');
            $table->string('cap_contribute');
            $table->string('loan_liability');
            $table->string('fundraising_required');
            $table->string('need_capital');
            $table->string('expected_roi');
            $table->string('expected_dividends');
            $table->string('valuations');
            $table->string('cr');
            $table->string('feasibility_status');
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
