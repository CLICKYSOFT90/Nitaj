@extends('layouts.investor.investor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Create Report</title>
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="help_sec vote-sec-text">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <ul class="tags-listing">
                        <li class="tags-list-item"><a href="{{ route('admin.performance') }}" class="tags-list-text"><i
                                    class="fa fa-angle-left tag-icon" aria-hidden="true"></i> Back</a></li>
                        <li class="tags-list-item"><a href="javascriptvoid:(0)"
                                                      class="tags-list-text for-color">Performance</a></li>
                        <li class="tags-list-item"><a href="javascriptvoid:(0)" class="tags-list-text for-color"><i
                                    class="fa fa-angle-double-right tag-icon" aria-hidden="true"></i></a></li>
                        <li class="tags-list-item"><a href="javascriptvoid:(0)" class="tags-list-text for-color">Create
                                a new report</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="performance-report-sec">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <form action="{{ route('admin.store-report') }}" id="create-report-form" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="input-options">
                                            <label>Project Name </label>
                                            <select name="project_id" id="project_id">
                                                <option value="">Select</option>
                                                @foreach ($projects as $project)
                                                    <option value="{{ $project->id }}">
                                                        {{ old('project_id', $project->project_name_en) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{--                                    <div class="col-md-3 col-sm-6 col-12">--}}
                                    {{--                                        <div class="input-options">--}}
                                    {{--                                            <label>Report Type</label>--}}
                                    {{--                                            <select id="report_type" name="report_type">--}}
                                    {{--                                                <option value="">Select</option>--}}
                                    {{--                                                <option value="asset_report">Asset Report</option>--}}
                                    {{--                                                <option value="roi_report">ROI Report</option>--}}
                                    {{--                                                <option value="vav_report">NAV Report</option>--}}
                                    {{--                                                <option value="net_return_report">Net Return Report</option>--}}
                                    {{--                                            </select>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="input-options">
                                            <label>Report Duration</label>
                                            <select id="performance_report_type" name="performance_report_type">
                                                <option value="">Select</option>
                                                <option value="monthly">Monthly</option>
                                                <option value="quarterly">Quarterly</option>
                                                <option value="semi_annually">Semi Annually</option>
                                                <option value="annually">Annually</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{--                                    <div class="col-md-3 col-sm-6 col-12">--}}
                                    {{--                                        <div class="input-options">--}}
                                    {{--                                            <label>Report Type</label>--}}
                                    {{--                                            <select id="report_type" name="report_type">--}}
                                    {{--                                                <option value="">Select</option>--}}
                                    {{--                                                <option value="dividend_report">Dividends Report</option>--}}
                                    {{--                                                <option value="sale_report">Sale Report</option>--}}
                                    {{--                                                <option value="development_report">Development Report</option>--}}
                                    {{--                                            </select>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="input-options">
                                            <label>From</label>
                                            <input type="text" name="perf_from" id="perf_from"
                                                   placeholder="DD-MM-YY">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="input-options">
                                            <label>To</label>
                                            <input type="text" name="perf_to" id="perf_to"
                                                   placeholder="DD-MM-YY">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-12 mt-10">
                                        <div class="location-buttons">
                                            <button type="button" class="dashboard-reset" onclick="this.form.reset();">
                                                Reset
                                            </button>
                                            <button type="submit" class="dashboard-save">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row report-row-divider">
                        <div class="col-md-12 col-sm-12 col-12 p-0">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-12 mb-4">
                                    <div class="account-field-boxes">
                                        <p>Project Status </p>
                                        <span id="status">N/A</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-12 mb-4">
                                    <div class="account-field-boxes">
                                        <p>No. of Investors</p>
                                        <span id="no_of_investors">N/A</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-12 mb-4">
                                    <div class="account-field-boxes">
                                        <p>Report Cycle</p>
                                        <span id="report_cycle">N/A</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-12 mb-4">
                                    <div class="account-field-boxes">
                                        <p>Funds Value</p>
                                        <span id="fund_value">N/A</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-12 mb-4">
                                    <div class="account-field-boxes">
                                        <p>Funds Raised</p>
                                        <span id="fund_raised">N/A</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-12 mb-4">
                                    <div class="account-field-boxes">
                                        <p>Unit Price</p>
                                        <span id="unit_price">N/A</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-12 mb-4">
                                    <div class="account-field-boxes">
                                        <p>Total Units</p>
                                        <span id="total_units">N/A</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-12 mb-4">
                                    <div class="account-field-boxes">
                                        <p>Ownership Percentage</p>
                                        <span id="ownership">N/A</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="div-hidden" style="display: none;">
            <div class="funding-campaign-table developement-progress-table for-bdr">
                <div class="d-flex flex-column-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-12">
                                <h4 class="campaign-dev-text">Development Progress </h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="campaign-buttons-1 align-new">
                                    {{--                                    <button type="button" class="dashboard-save">Edit</button>--}}
                                    <button type="button" class="dashboard-reset add-new-dev-prog">Add New</button>
                                </div>
                            </div>
                        </div>
                        <form action="" id="development-progress-form" enctype="multipart/form-data">
                            <div class="row development-progress-text develop-prog-text for-td-alignment">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody id="parent-row">
                                            <tr>
                                                <td width="20%">
                                                    <div class="input-options">
                                                        <label>Progress Type </label>
                                                        <select name="progress_type[0]" class="progress_type">
                                                            <option value="">Select</option>
                                                            <option value="planning">Planning</option>
                                                            <option value="construction">Construction</option>
                                                            <option value="operation">Operation</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td width="20%">
                                                    <div class="input-options">
                                                        <label>Progress Percentage
                                                            %</label>
                                                        <input type="text" class="progress_percentage"
                                                               name="progress_percentage[0]">
                                                    </div>
                                                </td>
                                                <td width="10%">
                                                    <div class="input-options">
                                                        <label>Date</label>
                                                        <input type="text" name="date[0]"
                                                               class="date_picker select_date">
                                                    </div>
                                                {{--                                                </td>--}}
                                                {{--                                                <td width="20%">--}}
                                                {{--                                                    <div class="input-options">--}}
                                                {{--                                                        <label>Documents (Optional)</label>--}}
                                                {{--                                                        <input type="text" placeholder="Attach a document" id="name-0"--}}
                                                {{--                                                               name="file_name[0]">--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                </td>--}}
                                                <td class="center-div">
                                                    {{--                                                    <div class="browse br-btn">--}}
                                                    {{--                                                        <label class="dashboard-reset"> Browse--}}
                                                    {{--                                                            <input type="file" name="document_image[]" id="file-0"--}}
                                                    {{--                                                                   class="input-upload"--}}
                                                    {{--                                                                   onchange="uploadImage(this,'name-0','file-0')">--}}
                                                    {{--                                                        </label>--}}

                                                    {{--                                                    </div>--}}
                                                    <a href="javascriptvoid:(0)">
                                                        <img src="{{ asset('images/close-icon.png') }}"
                                                             class="class-img-hide"></a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="dashboard-buttons">
                                        <button type="button" class="dashboard-reset"
                                                onclick="this.form.reset();">Reset
                                        </button>
                                        <button type="submit" class="dashboard-save add-new">Save</button>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="report_id" class="report_id" value="">
                        </form>
                    </div>
                </div>
            </div>
            <div class="progress-summary-report-sec">
                <div class="d-flex flex-column-fluid">
                    <div class="container">
                        <h4 class="progress-summary-text">Progress Report Summary</h4>

                        <form action="{{ route('admin.store-progress-report-summary') }}" id="progress-report-summary"
                              method="post">
                            @csrf
                            <input type="hidden" value="is_sold" id="is_sold">
                            <input type="hidden" class="project_id" name="project_id">
                            <div class="row investment-main-border">
                                {{--Equity Start--}}
                                <div class="col-md-6 col-sm-6 col-12 investment-border-spacing equity">
                                    <input type="hidden" value="equity" name="report_type">
                                    <h4 class="table-items-heading">Equity <span class="pull-right">Amount (SAR)</span>
                                    </h4>
                                    <ul class="for-strong-color">
                                        <li><strong>Fee</strong> <span></span></li>
                                        <li>Subscription Fees<span class="pull-right"><input type="text"
                                                                                             class="report-display"
                                                                                             placeholder="0.00"
                                                                                             name="subscription_fees"
                                                                                             id="subscription_fees"
                                                                                             readonly></span>
                                        </li>
                                        <li><strong>Investment Info</strong> <span></span></li>
                                        <li>Capital Invested <span class="pull-right"><input type="text"
                                                                                             class="report-display"
                                                                                             placeholder="0.00"
                                                                                             name="capital_invested"
                                                                                             readonly
                                                                                             id="capital_invested"></span>
                                        </li>
                                        <li>Units owned <span class="pull-right"><input type="text"
                                                                                        name="unit_owned"
                                                                                        class="report-display"
                                                                                        placeholder="0.00" readonly
                                                                                        id="unit_owned"></span>
                                        </li>
                                        <li>Appreciation/Depreciation<span class="pull-right"><input type="text"
                                                                                                     name="app_dep"
                                                                                                     class="report-display"
                                                                                                     placeholder="0.00"
                                                                                                     id="app-dep"></span>
                                        </li>
                                        <li>Investment Value<span class="pull-right"><input type="text"
                                                                                            name="investment_value"
                                                                                            class="report-display"
                                                                                            placeholder="0.00" readonly
                                                                                            id="investment_value"></span>
                                        </li>
                                        <li>Unit Value<span class="pull-right"><input type="text"
                                                                                      name="unit_value"
                                                                                      class="report-display"
                                                                                      placeholder="0.00" readonly
                                                                                      id="unit_value"></span>
                                        </li>
                                        <li><strong>Returns</strong> <span></span></li>
                                        <li>Total Dividends <span class="pull-right"><input type="text"
                                                                                            name="total_dividends"
                                                                                            class="report-display"
                                                                                            placeholder="0.00"
                                                                                            id="total_dividends"></span>
                                        </li>
                                        <li>Dividend return % (Holding period) <span class="pull-right"><input
                                                    type="text"
                                                    name="dividends_return"
                                                    class="report-display"
                                                    placeholder="0.00" readonly id="dividends_return"></span>
                                        </li>
                                        <li><strong>Sales</strong> <span></span></li>
                                        <li>Sale Value <span class="pull-right"><input type="text"
                                                                                       name="sale_value"
                                                                                       class="report-display"
                                                                                       placeholder="0.00"
                                                                                       readonly
                                                                                       id="sale_value"></span>
                                        </li>
                                        <li>Realized gain on sale % <span class="pull-right"><input type="text"
                                                                                                    class="report-display"
                                                                                                    placeholder="0.00"
                                                                                                    name="realized_gain"
                                                                                                    id="realized_gain"></span>
                                        </li>
                                        <li>Profit/(Loss) <span class="pull-right"><input type="text"
                                                                                          class="report-display"
                                                                                          placeholder="0.00"
                                                                                          name="profit_loss"
                                                                                          readonly
                                                                                          id="profit-loss"></span>
                                        </li>
                                        <li>Realized <span class="pull-right"><input type="text"
                                                                                     class="report-display"
                                                                                     placeholder="0.00"
                                                                                     name="realized"
                                                                                     id="realized"></span>
                                        </li>
                                        <li>Unrealized <span class="pull-right"><input type="text"
                                                                                       class="report-display"
                                                                                       placeholder="0.00"
                                                                                       name="unrealized" readonly
                                                                                       id="unrealized"></span>
                                        </li>
                                    </ul>
                                </div>
                                {{--Equity End--}}

                                {{--Debt Start--}}
                                <div class="col-md-6 col-sm-6 col-12 investment-border-spacing debt">
                                    <h4 class="table-items-heading">DEBT <span class="pull-right">Amount (SAR)</span>
                                    </h4>
                                    <ul class="for-strong-color">
                                        <input type="hidden" value="debt" name="report_type">
                                        <li><strong>Project Info</strong> <span></span></li>
                                        <li>Fund value <span class="pull-right"><input type="text"
                                                                                       name="fund_value_debt"
                                                                                       id="fund_value_debt"
                                                                                       class="report-display"
                                                                                       readonly
                                                                                       placeholder="0.00"></span>
                                        </li>
                                        <li>Amount Raised <span class="pull-right"><input type="text"
                                                                                          name="amount_raised_debt"
                                                                                          id="amount_raised_debt"
                                                                                          class="report-display"
                                                                                          readonly
                                                                                          placeholder="0.00"></span>
                                        </li>
                                        <li>Unit Price <span class="pull-right"><input type="text"
                                                                                       name="unit_price_debt"
                                                                                       id="unit_price_debt"
                                                                                       class="report-display"
                                                                                       readonly
                                                                                       placeholder="0.00"></span>
                                        </li>
                                        <li>Total units<span class="pull-right"><input type="text"
                                                                                       name="total_units_debt"
                                                                                       id="total_units_debt"
                                                                                       class="report-display"
                                                                                       readonly
                                                                                       placeholder="0.00"></span>
                                        </li>
                                        <li>Lending Amount<span class="pull-right"><input type="text"
                                                                                          name="lending_amount_debt"
                                                                                          id="lending_amount_debt"
                                                                                          class="report-display"
                                                                                          readonly
                                                                                          placeholder="0.00"></span>
                                        </li>
                                        <li>Murabha Rate<span class="pull-right"><input type="text"
                                                                                        name="murabha_rate_debt"
                                                                                        id="murabha_rate_debt"
                                                                                        class="report-display"
                                                                                        placeholder="0.00"></span>
                                        </li>
                                        <li>Total Period (always in months)<span class="pull-right"><input type="text"
                                                                                                           name="total_period_debt"
                                                                                                           id="total_period_debt"
                                                                                                           class="report-display"
                                                                                                           placeholder="0.00"></span>
                                        </li>
                                        <li>Payment Frequency (in months)<span class="pull-right"><input type="text"
                                                                                                         name="payment_requency_debt"
                                                                                                         id="payment_requency_debt"
                                                                                                         class="report-display"
                                                                                                         placeholder="Month"></span>
                                        </li>
                                        <li>Total Installments<span class="pull-right"><input type="text"
                                                                                              name="total_installments_debt"
                                                                                              id="total_installments_debt"
                                                                                              class="report-display"
                                                                                              placeholder="00"></span>
                                        </li>
                                        <li>Installment Amount Received (Total)<span class="pull-right"><input
                                                    type="text"
                                                    name="installment_recieved_debt"
                                                    id="installment_recieved_debt"
                                                    class="report-display"
                                                    placeholder="0.00"></span>
                                        </li>
                                        <li>Principle Amount Received<span class="pull-right"><input type="text"
                                                                                                     name="principle_amount_received_debt"
                                                                                                     id="principle_amount_received_debt"
                                                                                                     class="report-display"
                                                                                                     placeholder="0.00"></span>
                                        </li>
                                        <li>Profit Amount Received<span class="pull-right"><input type="text"
                                                                                                  name="profit_amount_received_debt"
                                                                                                  id="profit_amount_received_debt"
                                                                                                  class="report-display"
                                                                                                  placeholder="0.00"></span>
                                        </li>
                                        <li>No of Installments received<span class="pull-right"><input type="text"
                                                                                                       name="no_of_installments_received_debt"
                                                                                                       id="no_of_installments_received_debt"
                                                                                                       class="report-display"
                                                                                                       placeholder="0.00"></span>
                                        </li>
                                        <li>Next Installment Expected (Date)<span class="pull-right"><input type="date"
                                                                                                            name="next_installment_debt"
                                                                                                            id="next_installment_debt"
                                                                                                            class="report-display"
                                                                                                            placeholder="d-m-y"></span>
                                        </li>
                                        <li>Remaining Balance<span class="pull-right"><input type="text"
                                                                                             name="remaining_balance_debt"
                                                                                             id="remaining_balance_debt"
                                                                                             class="report-display"
                                                                                             readonly
                                                                                             placeholder="0.00"></span>
                                        </li>
                                        <li>Remaining Period (Maturity)<span class="pull-right"><input type="text"
                                                                                                       name="remaining_period_debt"
                                                                                                       id="remaining_period_debt"
                                                                                                       class="report-display"
                                                                                                       placeholder="Month"></span>
                                        </li>
                                        <li>ROI% (Holding Period)<span class="pull-right"><input type="text"
                                                                                                 name="roi_debt"
                                                                                                 id="roi_debt"
                                                                                                 class="report-display"
                                                                                                 readonly
                                                                                                 placeholder="0.00"></span>
                                        </li>
                                        <li>Subscription Fees<span class="pull-right"><input type="text"
                                                                                             name="subscription_fees_debt"
                                                                                             id="subscription_fees_debt"
                                                                                             class="report-display"
                                                                                             readonly
                                                                                             placeholder="0.00"></span>
                                        </li>
                                        <li><strong>Investor Info</strong> <span></span></li>
                                        <li>Capital Invested<span class="pull-right"><input type="text"
                                                                                            name="capital_invested_debt"
                                                                                            id="capital_invested_debt"
                                                                                            class="report-display"
                                                                                            readonly
                                                                                            placeholder="0.00"></span>
                                        </li>
                                        <li>Ownership % From Fund<span class="pull-right"><input type="text"
                                                                                                 name="ownership_from_fund_debt"
                                                                                                 id="ownership_from_fund_debt"
                                                                                                 class="report-display"
                                                                                                 placeholder="0.00"></span>
                                        </li>
                                        <li>Installment Received<span class="pull-right"><input type="text"
                                                                                                id="installment_received_debt_refered"
                                                                                                class="report-display"
                                                                                                readonly
                                                                                                placeholder="0.00"></span>
                                        </li>
                                        <li>Principle Amount Received<span class="pull-right"><input type="text"
                                                                                                     id="principle_amount_received_debt_refered"
                                                                                                     class="report-display"
                                                                                                     readonly
                                                                                                     placeholder="0.00"></span>
                                        </li>
                                        <li>Profit Amount Received<span class="pull-right"><input type="text"
                                                                                                  id="profit_amount_received_debt_refered"
                                                                                                  class="report-display"
                                                                                                  readonly
                                                                                                  placeholder="0.00"></span>
                                        </li>
                                        <li>Remaining Balance<span class="pull-right"><input type="text"
                                                                                             id="remaining_balance_debt_refered"
                                                                                             class="report-display"
                                                                                             readonly
                                                                                             placeholder="0.00"></span>
                                        </li>
                                        <li><strong>Returns</strong> <span></span></li>
                                        <li>ROI % (Holding Period) <span class="pull-right"><input type="text"
                                                                                                   name="roi_returns_debt"
                                                                                                   id="roi_returns_debt"
                                                                                                   class="report-display"
                                                                                                   readonly
                                                                                                   placeholder="0.00"></span>
                                        </li>
                                        <li>ROI Amount (Interest Received) <span class="pull-right"><input type="text"
                                                                                                           name="roi_amount_debt"
                                                                                                           id="roi_amount_debt"
                                                                                                           class="report-display"
                                                                                                           readonly
                                                                                                           placeholder="0.00"></span>
                                        </li>
                                        <li>Loss of Principle <span class="pull-right"><input type="text"
                                                                                              name="loss_of_principle"
                                                                                              id="loss_of_principle"
                                                                                              class="report-display"
                                                                                              placeholder="0.00"></span>

                                            <input type="hidden" name="unrealized_profit_debt"
                                                   id="unrealized_profit_debt" class="report-display"
                                                   placeholder="0.00">
                                    </ul>
                                </div>
                                {{--Debt End--}}
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="dashboard-buttons">
                                        {{--                                        <button type="button"--}}
                                        {{--                                                class="dashboard-reset" onclick="resetForm()">--}}
                                        {{--                                            Reset--}}
                                        {{--                                        </button>--}}
                                        <button type="submit" class="dashboard-save">Save</button>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="report_id" class="report_id" value="">
                        </form>
                    </div>
                </div>
            </div>
            <div class="pro-document-attach">
                <div class="d-flex flex-column-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="pro-document">Documents Attached</h2>
                            </div>
                        </div>
                        <form action="" id="documents-attached-form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody id="parent-row">
                                            <tr>
                                                <td width="" class="visual-type-text">
                                                    <div class="input-options">
                                                        <label>Name</label>
                                                        <input type="text" placeholder="Project Prospectus"
                                                               name="prospectus[0]" class="prospectus">
                                                    </div>
                                                </td>
                                                <td width="35%" class="visual-type-text">
                                                    <label>File Attached</label>
                                                    <input type="text" placeholder="No File Choosen" id="first-doc"
                                                           name="doc_name[0]" class="document">
                                                </td>
                                                <td class="file-ext" width="36%">
                                                    <label>File Type</label>
                                                    <img src="https://via.placeholder.com/30" id="first-image"
                                                         width="30px">
                                                </td>
                                                <td class="tick-1 tb-button">
                                                    <div class="jack-profile-buttons text-center center-div">
                                                        <div class="browse mr-2">
                                                            <label class="dashboard-reset d-flex mx-auto"> Browse
                                                                <input type="file" name="doc_upload[]"
                                                                       id="first-file-doc"
                                                                       onchange="readNameAndType(this, 'first-doc', 'first-file-doc','first-image')"
                                                                       class="input-upload">
                                                            </label>
                                                        </div>
                                                        {{--                                                        <a href="javascriptvoid:(0)">--}}
                                                        {{--                                                            <img src="{{ asset('images/close-icon.png') }}"--}}
                                                        {{--                                                                 class="class-img-hide"></a>--}}
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="add-button-main for-button-save-main">
                                        <a href="#" class="dashboard-save add-new">ADD NEW</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="dashboard-buttons">
                                        <button type="button" class="dashboard-reset"
                                                onclick="this.form.reset();">Reset
                                        </button>
                                        <button type="submit" class="dashboard-save">Save</button>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="report_id" class="report_id" value="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        //Resetting Summary Form Fields except readonly
        function resetForm() {
            $('input').not('[readonly]').val('');
        }
            let formSubmitted;

        $(document).ready(function () {

                // initialize datepicker
                $(function () {
                    $("#perf_from, #perf_to").datepicker({
                        format: 'dd-mm-yyyy',
                    });
                });

                // Fetch Project Information
                {{--$("#project_id").on("change", function (event) {--}}
                {{--    event.preventDefault();--}}
                {{--    var formValues = $(this).serialize();--}}
                {{--    $.ajaxSetup({--}}
                {{--        headers: {--}}
                {{--            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')--}}
                {{--        }--}}
                {{--    });--}}
                {{--    $.ajax({--}}
                {{--        url: "{{ route('admin.project.info') }}",--}}
                {{--        method: 'post',--}}
                {{--        data: formValues,--}}
                {{--        success: function (result) {--}}
                {{--            if (result.status == true) {--}}
                {{--                $('#status').append();--}}
                {{--                $('#no_of_investors').append();--}}
                {{--                $('#report_cycle').append();--}}
                {{--                $('#fund_value').append();--}}
                {{--                $('#fund_raised').append();--}}
                {{--                $('#unit_price').append();--}}
                {{--                $('#total_units').append();--}}
                {{--            }--}}
                {{--        }--}}
                {{--    });--}}
                {{--});--}}

                var count = 0;
                //append rows
                $(document).on('click', '.add-new-dev-prog', function (e) {
                    e.preventDefault();
                    count++;
                    $('#development-progress-form #parent-row').append(
                        '<tr>' +
                        '<td width="">' +
                        '<div class="input-options">' +
                        '<label>Progress Type </label>' +
                        '<select name="progress_type[' + count + ']"' +
                        'class="progress_type">' +
                        '<option value="">Select</option>' +
                        '<option value="planning">Planning</option>' +
                        '<option value="construction">Construction</option>' +
                        '<option value="operation">Operation</option>' +
                        '</select>' +
                        '</div>' +
                        '</td>' +
                        '<td>' +
                        '<div class="input-options">' +
                        '<label>Progress Percentage %</label>' +
                        '<input type="text" name="progress_percentage[' + count + ']" ' +
                        'class = "progress_percentage" > ' +
                        '</div>' +
                        '</td>' +
                        '<td>' +
                        '<div class="input-options">' +
                        '<label>Date</label>' +
                        '<input type="text" name = "date[' + count + ']"' +
                        'class="date_picker select_date">' +
                        '</div>' +
                        '</td>' +
                        '<td class="center-div">' +
                        '<a href="javascriptvoid:(0)"><img src="{{ asset('images/close-icon.png') }}" ' +
                        'class="class-img-hide"></a>' +
                        '</td>' +
                        '</tr>'
                    )

                    $(".date_picker").datepicker("destroy");
                    $('.date_picker').datepicker({
                        format: "yy-mm-dd"
                    });

                });

                // remove row
                $(document).on('click', '#development-progress-form .class-img-hide', function () {
                    $(this).closest('tr').remove();
                });
            }
        )
        ;

        // $.validator.addMethod("greaterThan", function(value, element){
        //     var startdatevalue = $('#perf_to').val();
        //     console.log(Date.parse(startdatevalue) , Date.parse(value) , startdatevalue, value);
        //     return Date.parse(startdatevalue) < Date.parse(value);
        // }, 'From Date should be greater than equal to To Date.');

        jQuery.validator.addMethod("greaterThan",
            function (value, element, params) {
                var from = $('#perf_from').val();
                console.log(from > value);
                return value > from
            }, 'should be greater than from date.');

        // create report form
        $('#create-report-form').validate({
            rules: {
                project_id: {
                    required: true,
                },
                report_type: {
                    required: true,
                },
                performance_report_type: {
                    required: true,
                },
                perf_to: {
                    required: true,
                    greaterThan: true
                },
                perf_from: {
                    required: true,
                },
            },
            messages: {
                project_id: {
                    required: 'Project field is required.',
                },
                report_type: {
                    required: 'Report type field is required.',
                },
                performance_report_type: {
                    required: 'Performance report type field is required.',
                },
                perf_to: {
                    required: 'Start date field is required.',
                },
                perf_from: {
                    required: 'End date field is required.',
                },
            },
            submitHandler: function (form) {
                var formValues = $(form).serialize();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    method: "post",
                    url: "{{ route('admin.store-report') }}",
                    data: formValues,
                    beforeSend: function () {
                        $('#create-report-form .dashboard-save').html('Please Wait...');
                    },
                    success: function (result) {
                        if (result.status == true) {
                            $('#create-report-form .dashboard-save').html('Saved');
                            console.log(result.data);
                            $('.report_id').val(result.report_info.id);
                            $('#div-hidden').show();
                            $('#create-report-form .dashboard-save').prop('disabled', 'disabled');
                            console.log(result.data.project_info.project_funding.structure);
                            if (result.data.project_info.project_funding.structure == 'equity' || result.data.project_info.project_funding.structure == 'Equity') {
                                $('.equity').show();
                                $('.debt').remove();
                            } else {
                                $('.debt').show();
                                $('.equity').remove();
                            }
                            $('#is_sold').val(result.data.project_info.is_sold);
                            $('#status').empty().append(result.data.status);
                            $('#no_of_investors').empty().append(result.data.no_of_investors);
                            $('#report_cycle').empty().append($('#performance_report_type option:selected').text());
                            $('#fund_raised').empty().append(result.data.funds_raised.toLocaleString() + '<small>SAR</small>');
                            $('#fund_value').empty().append(result.data.project_info.project_funding.funding_required.toLocaleString() + '<small>SAR</small>');
                            $('#unit_price').empty().append(result.data.project_info.project_funding.price_per_share.toLocaleString() + '<small>SAR</small>');
                            $('#total_units').empty().append(result.data.project_info.project_funding.no_of_shares.toLocaleString());
                            $('#ownership').empty().append(result.data.ownership + '%');
                            $('.project_id').val(result.data.project_id);

                            $('#subscription_fees').empty().val(result.data.subscription_fees);
                            $('#unit_owned').empty().val(result.data.units_owned);
                            $('#capital_invested').empty().val(result.data.capital_invested.toLocaleString());

                            // For Debt
                            $('#fund_value_debt').empty().val(result.data.project_info.project_funding.funding_required.toLocaleString());
                            $('#amount_raised_debt').empty().val(result.data.funds_raised.toLocaleString());
                            $('#unit_price_debt').empty().val(result.data.project_info.project_funding.price_per_share.toLocaleString());
                            $('#total_units_debt').empty().val(result.data.project_info.project_funding.no_of_shares.toLocaleString());
                            $('#lending_amount_debt').empty().val(result.data.funds_raised.toLocaleString());
                            $('#subscription_fees_debt').empty().val(result.data.subscription_fees);
                            $('#capital_invested_debt').empty().val(result.data.funds_raised.toLocaleString());

                            // If project is not sold disable all sale value
                            // if(result.data.project_info.is_sold == 0){
                            //     $('#sale_value').attr('readonly', true);
                            //     $('#realized_gain').attr('readonly', true);
                            //     $('#profit-loss').attr('readonly', true);
                            //     $('#realized').attr('readonly', true);
                            // }
                        } else {
                            console.log(result.error)
                            Swal.fire({
                                icon: 'error',
                                title: result.error,
                                showCancelButton: true,
                                showConfirmButton: false
                            })
                        }
                    }
                })
            },
        });


        //All the internal manipulation for Equity Starts
        // Calculating Appreciation/Depreciation
        $('#app-dep').on('keyup', function (event) {
            var is_sold = $('#is_sold').val();
            if (event.which !== 8) {
                $(this).val(function (index, old) {
                    return old.replace(/[^0-9,-]/g, '') + '%';
                });
            }
            var value = parseInt($(this).val());
            if (value !== 0) {
                // Investment Value after Appreciation/Depreciation
                var capital_invested = $('#capital_invested').val().split(",").join("");
                var investment_value = capital_invested * (1 + parseInt(value) / 100);
                $('#investment_value').val(investment_value.toLocaleString());
                // Unit Value after Appreciation/Depreciation
                var total_unit = parseInt($('#total_units').text().split(",").join(""));
                var unit_value = investment_value / total_unit;
                $('#unit_value').val(unit_value.toFixed(2).toLocaleString());

                // Calculating UnRealized Value
                if (is_sold == 0) {
                    var unrealized = investment_value - capital_invested
                    $('#unrealized').val(unrealized.toLocaleString());
                } else {
                    $('#unrealized').val(0);
                }
                // Calculating Profit/Loss
                if (is_sold == 1) {
                    var profit_loss = investment_value - capital_invested;
                    $('#profit-loss').val(profit_loss.toLocaleString());

                    //Calculating Sale Value
                    var sale_value = capital_invested * (1 + (value / 100))
                    $('#sale_value').val(sale_value.toLocaleString());

                    //Duplicating in realized gain on sale
                    $('#realized_gain').val(value);
                }
            } else {
                $('#investment_value').val('');
                $('#unit_value').val('');
            }
        })
        // Calculating Dividends return
        $('#total_dividends').on('keyup', function (event) {
            var value = this.value;
            var capital_invested = parseInt($('#capital_invested').val().split(",").join(""));
            var total_dividends = parseInt($('#total_dividends').val().split(",").join(""));
            var dividends_return = (total_dividends / capital_invested) * 100;
            $('#dividends_return').val(dividends_return.toFixed(2) + '%');

            // skip for arrow keys
            if (event.which >= 37 && event.which <= 40) return;
            // format number to comma seperated
            $(this).val(function (index, value) {
                return value
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            });
        });

        // Putting % sign in realized gain
        // $('#realized_gain').on('keyup', function (event) {
        //     if (event.which !== 8) {
        //         $(this).val(function (index, old) {
        //             return old.replace(/[^0-9]/g, '') + '%';
        //         });
        //     }
        // });
        //Calculating Realized
        $('#total_dividends').on('keyup', function () {
            var total_dividends = parseInt($('#total_dividends').val().split(",").join(""));
            var profit_loss = parseInt($('#profit-loss').val().split(",").join("")) || 0;
            console.log($('#profit-loss').val());
            console.log(total_dividends, profit_loss);
            var realized = (total_dividends) + (profit_loss);
            $('#realized').val(realized.toLocaleString());
        })
        // Putting , in sale value
        $('#sale_value').on('keyup', function () {
            // skip for arrow keys
            if (event.which >= 37 && event.which <= 40) return;
            // format number to comma seperated
            $(this).val(function (index, value) {
                return value
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                    ;
            });
        })
        //All the internal manipulation for Equity Ends

        // Debt internal manipulation starts

        // Adding % in murabha rate
        $('#murabha_rate_debt, #ownership_from_fund_debt').on('keyup', function () {
            if (event.which !== 8) {
                $(this).val(function (index, old) {
                    return old.replace(/[^0-9,-]/g, '') + '%';
                });
            }
        });

        // Adding , in respective text box
        $('#installment_recieved_debt, #principle_amount_received_debt, #profit_amount_received_debt ').on('keyup', function () {
            // skip for arrow keys
            if (event.which >= 37 && event.which <= 40) return;
            // format number to comma seperated
            $(this).val(function (index, value) {
                return value
                    .replace(/\D/g, "")
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                    ;
            });
        });


        // Calculating Remaining Balance
        $('#installment_recieved_debt').on('keyup', function () {
            var amount_raised = $('#amount_raised_debt').val().split(",").join("");
            var muraba_rate = $('#murabha_rate_debt').val().replace('%', '');
            var installment_recieved = $('#installment_recieved_debt').val().split(",").join("");
            var remaining_balance = parseInt(amount_raised) * (1 + (parseInt(muraba_rate) / 100)) - parseInt(installment_recieved);
            $('#remaining_balance_debt').val(remaining_balance.toLocaleString());
            $('#remaining_balance_debt_refered').val(remaining_balance.toLocaleString());
            $('#installment_received_debt_refered').val(installment_recieved.toLocaleString());

        })

        // Calculating ROI
        $('#profit_amount_received_debt').on('keyup', function () {
            var is_sold = $('#is_sold').val();
            var profit_recieved = $(this).val().split(",").join("");
            var amount_raised = $('#amount_raised_debt').val().split(",").join("");
            var roi = (parseInt(profit_recieved) / parseInt(amount_raised)) * 100;
            console.log(profit_recieved, amount_raised, roi);
            $('#roi_debt').val(roi.toFixed(2) + '%');
            $('#roi_returns_debt').val(roi.toFixed(2));
            // ROI Amount (Interest Received)
            var lending_amount = $('#amount_raised_debt').val().split(",").join("");
            var roi_amount = parseInt(lending_amount) * (roi / 100);
            $('#roi_amount_debt').val(roi_amount.toFixed(2));

            $('#profit_amount_received_debt_refered').val(profit_recieved.toLocaleString());

            //Calculating Unrealized profit debt
            if (is_sold == 0) {
                var muraba_rate = $('#murabha_rate_debt').val().replace('%', '');
                var unrealized_profit_debt = (amount_raised * (muraba_rate / 100)) - profit_recieved;
                $('#unrealized_profit_debt').val(unrealized_profit_debt);
            }
        })

        // Calculating Principal Amount Recieved
        $('#principle_amount_received_debt').on('keyup', function () {
            $('#principle_amount_received_debt_refered').val($(this).val());
        })

        // Debt internal manipulation ends

        // upload file function
        function uploadImage(form, namediv, file) {
            var i = $(this).prev('label').clone();
            var file = $('#' + file)[0].files[0].name;
            var fileName = file.split('.');
            $('#' + namediv).val(fileName[0]);
            if (form.files && form.files[0]) {
                var reader = new FileReader();
                // reader.onload = function(e) {
                //     $('#' + imgdiv)
                //         .attr('src', e.target.result);
                // };

                reader.readAsDataURL(form.files[0]);
            }
        }

        // development progress form
        $('#development-progress-form').on('submit', function (e) {
            e.preventDefault();
            $('.progress_percentage').each(function () {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Progress Percentage is required",
                    }
                });
            });
            $('.select_date').each(function () {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Date is required",
                    }
                });
            });
            $('.progress_type').each(function () {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Progress type is required",
                    }
                });
            });
            var formValues = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                method: "post",
                url: "{{ route('admin.store-progress') }}",
                processData: false,
                cache: false,
                contentType: false,
                data: formValues,
                beforeSend: function () {
                    $('#development-progress-form .dashboard-save').html('Please Wait...');
                },
                success: function (result) {
                    if (result.status == true) {
                        $('#development-progress-form .dashboard-save').html('Saved');
                        $('#development-progress-form .dashboard-save').prop('disabled',
                            'disabled');
                    } else {
                        $.each(result.error, function (k, v) {
                            console.log(k, v);
                        });
                    }
                }
            })

        });

        $("#development-progress-form").validate();

        // progress report summary form
        $('#progress-report-summary').on('submit', function (e) {
            e.preventDefault();
            var formValues = $(this).serialize();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                method: "post",
                url: "{{ route('admin.store-progress-report-summary') }}",
                data: formValues,
                beforeSend: function () {
                    $('#progress-report-summary .dashboard-save').html('Please Wait...');
                },
                success: function (result) {
                    if (result.status == true) {
                        $('#progress-report-summary .dashboard-save').html('Saved');
                        $('#progress-report-summary .dashboard-save').prop('disabled', 'disabled');
                        $('#pro-document-attach_error').append(
                            '<div class="alert c_alert" role="alert">' + result
                                .error + '</div>');
                        setTimeout(function () {
                            $('#pro-document-attach_error .alert').remove();
                        }, 5000);
                        formSubmitted = true;
                    } else {
                        $.each(result.error, function (k, v) {
                            console.log(k, v);
                        });
                    }
                }
            })
        });

        // validate progress report summary
        $.validator.addMethod('minStrict', function (value, el, param) {
            return value > param;
        });
        $('#progress-report-summary').validate({
            rules: {
                // Equity Starts
                subscription_fees: {
                    // required: true,
                    number: true,
                },
                capital_invested: {
                    // required: true,
                    number: false,
                },
                unit_owned: {
                    // required: true,
                    number: false,
                },
                app_dep: {
                    // required: true,
                    number: false,
                },
                investment_value: {
                    // required: true,
                    number: false,
                },
                unit_value: {
                    // required: true,
                    number: false,
                },
                total_dividends: {
                    // required: true,
                    number: true,
                },
                dividends_return: {
                    // required: true,
                    number: false,
                },
                sale_value: {
                    // required: true,
                    number: true,
                },
                realized_gain: {
                    // required: true,
                    number: false,
                },
                profit_loss: {
                    // required: true,
                    number: false,
                },
                realized: {
                    // required: true,
                    number: true,
                },
                unrealized: {
                    // required: true,
                    number: false,
                },
                // Equity Ends

                // Debt Starts
                fund_value_debt: {
                    // required: true,
                    number: true,
                },
                amount_raised_debt: {
                    // required: true,
                    number: true,
                },
                unit_price_debt: {
                    // required: true,
                    number: true,
                },
                total_units_debt: {
                    // required: true,
                    number: true,
                },
                lending_amount_debt: {
                    // required: true,
                    number: true,
                },
                murabha_rate_debt: {
                    // required: true,
                    // number: true,
                },
                total_period_debt: {
                    // required: true,
                    number: true,
                },
                payment_requency_debt: {
                    // required: true,
                    number: true,
                },
                total_installments_debt: {
                    // required: true,
                    number: true,
                },
                installment_recieved_debt: {
                    // required: true,
                    number: true,
                },
                principle_amount_received_debt: {
                    // required: true,
                    number: true,
                },
                profit_amount_received_debt: {
                    // required: true,
                    number: true,
                },
                no_of_installments_received_debt: {
                    // required: true,
                    number: true,
                },
                next_installment_debt: {
                    // required: true,
                    // date: true,
                },
                remaining_balance_debt: {
                    // required: true,
                    number: true,
                },
                remaining_period_debt: {
                    // required: true,
                    number: true,
                },
                roi_debt: {
                    // required: true,
                    // number: true,
                },
                subscription_fees_debt: {
                    // required: true,
                    number: true,
                },
                capital_invested_debt: {
                    // required: true,
                    number: true,
                },
                ownership_from_fund_debt: {
                    // required: true,
                    // number: true,
                },
                installment_received_debt: {
                    // required: true,
                    number: true,
                },
                roi_amount_debt: {
                    // required: true,
                    number: true,
                },
                loss_of_principle: {
                    // required: true,
                    number: true,
                }
                // Debt Ends
            },
            messages: {
                // Equity Starts
                subscription_fees: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                capital_invested: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                unit_owned: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                app_dep: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                investment_value: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                unit_value: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                total_dividends: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                dividends_return: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                sale_value: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                realized_gain: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                profit_loss: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                realized: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                unrealized: {
                    required: '{{ __('auth.required') }}',
                    number: true,
                },
                // Equity Ends

                // Debt Starts
                fund_value_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                amount_raised_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                unit_price_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                total_units_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                lending_amount_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                murabha_rate_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                total_period_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                payment_requency_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                total_installments_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                installment_recieved_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                principle_amount_received_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                profit_amount_received_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                no_of_installments_received_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                next_installment_debt: {
                    required: '{{ __('auth.required') }}',
                    date: 'Please enter the valid date',
                },
                remaining_balance_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                remaining_period_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                roi_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                subscription_fees_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                capital_invested_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                ownership_from_fund_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                installment_received_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                roi_amount_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                },
                loss_of_principle: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                }
                // Debt Ends

            },
        });

        function readNameAndType(input, divName, file, image) {
            var i = $(this).prev('label').clone();
            var file = $('#' + file)[0].files[0].name;
            var fileExt = file.split('.').pop();
            if (fileExt == "pdf" || fileExt == "docx" || fileExt == "doc" || fileExt == "xlsx" || fileExt == "xls") {
                $('#' + divName).val(file);
                var imageExt = "{{ url('images/investor/') }}" + '/' + fileExt + '.png';
                $('#' + image).attr('src', imageExt);
            } else {
                input.value = null;
                $('#' + divName).val('');
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Only pdf,docx, doc, xls and xlsx are allowed!',
                    timer: 2000,
                    showCancelButton: false,
                    showConfirmButton: false
                });
                return false;
            }

        }

        var row_count = 0;
        //documents attached form
        $('#documents-attached-form .add-new').click(function (e) {
            e.preventDefault();
            row_count++;
            var number = 1 + Math.floor(Math.random() * 6);
            var file_doc = number + '-doc';
            var file_file = number + '-file';
            var file_image = number + '-image';
            $('#documents-attached-form #parent-row').append(
                '<tr>' +
                '<td width="" class="visual-type-text">' +
                '<div class="input-options">' +
                '<label>Name</label>' +
                '<input name="prospectus[' + row_count +
                ']" type="text" class="prospectus" placeholder="Project Prospectus">' +
                '</div>' +
                '</td>' +
                '<td width="35%" class="visual-type-text">' +
                '<label>File Attached</label>' +
                '<input type="text" class="document" placeholder="No File Choosen" id="' + number +
                '-doc" name="doc_name[' + row_count + ']">' +
                '</td>' +
                '<td class="file-ext" width="36%">' +
                '<label>File Type</label>' +
                '<img src="https://via.placeholder.com/30" width="30px" id="' + number + '-image">' +
                '</td>' +
                '<td class="tick-1 tb-button">' +
                '<div class="jack-profile-buttons text-center center-div">' +
                '<div class="browse mr-2">' +
                '<label class="dashboard-reset d-flex mx-auto"> Browse' +
                '<input type="file" name="doc_upload[' + row_count + ']" id="' + number +
                '-file" class="input-upload" onchange="readNameAndType(this, \'' + file_doc + '\', \'' +
                file_file + '\', \'' + file_image + '\')">' +
                '</label>' +
                '</div>' +
                '<a href="javascriptvoid:(0)"><img src="{{ asset('images/close-icon.png') }}" ' +
                'class="class-img-hide"></a>' +
                '</div>' +
                '</td>' +
                '</tr>'
            )

        });

        $('#documents-attached-form').on('submit', function (e) {
            e.preventDefault();
            var formValues = new FormData(this);
            $('.prospectus').each(function () {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Project Prospectus is required",
                    }
                });
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                method: "post",
                url: "{{ route('admin.store-attached-documents') }}",
                processData: false,
                cache: false,
                contentType: false,
                data: formValues,
                beforeSend: function () {
                    $('#documents-attached-form .dashboard-save').html('Please Wait...');
                },
                success: function (result) {
                    if (result.status == true) {
                        $('#documents-attached-form .dashboard-save').html('Saved');
                        $('#documents-attached-form .dashboard-save').prop('disabled',
                            'disabled');
                        $('#documents-attached-form .add-new').prop('disabled',
                            'disabled');
                        $('#documents-attached-form .add-new').html('ADD NEW');
                    } else {
                        $.each(result.error, function (k, v) {
                            console.log(k, v);
                        });
                    }
                }
            })
        });
        $("#documents-attached-form").validate();
        $(document).on('click', '#documents-attached-form .class-img-hide', function () {
            $(this).closest('tr').remove();
        });
        // window.onbeforeunload = function (e) {
        //     e = e || window.event;
        //
        //     // For IE and Firefox prior to version 4
        //     if (e) {
        //         e.returnValue = 'Sure?';
        //     }
        //
        //     // For Safari
        //     return 'Sure?';
        // };
        window.addEventListener('beforeunload', function (e) {
            if (!formSubmitted) {
                e.preventDefault();
                e.returnValue = '';
            }
        });
    </script>
@endsection
