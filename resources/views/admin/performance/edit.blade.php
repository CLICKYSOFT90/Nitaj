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
                        <li class="tags-list-item"><a href="javascriptvoid:(0)" class="tags-list-text"><i
                                    class="fa fa-angle-left tag-icon" aria-hidden="true"></i> Back</a></li>
                        <li class="tags-list-item"><a href="javascriptvoid:(0)"
                                class="tags-list-text for-color">Performance</a></li>
                        <li class="tags-list-item"><a href="javascriptvoid:(0)" class="tags-list-text for-color"><i
                                    class="fa fa-angle-double-right tag-icon" aria-hidden="true"></i></a></li>
                        <li class="tags-list-item"><a href="javascriptvoid:(0)" class="tags-list-text for-color">View Progress Report</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="performance-report-sec">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <form action="" id="create-report-form" method="post"
                                enctype="multipart/form-data">
                                <input type="hidden" name="report_id" value="{{ $report->id }}">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="input-options">
                                            <label>Project Name </label>
                                            <select name="project_id" id="project_id">
                                                <option value="">Select</option>
                                                @foreach ($projects as $project)
                                                    <option value="{{ $project->id }}"
                                                        {{ old('project_id') == $project->id ? 'selected=""' : '' }}
                                                        {{ $project->id == $report->project->id ? 'selected' : '' }}>
                                                        {{ $project->project_name_en }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="input-options">
                                            <label>Report Type</label>
                                            <select id="report_type" name="report_type">
                                                <option value="">Select</option>
                                                <option value="monthly"
                                                    {{ $report->performance_report_type == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                                    {{ $report->performance_report_type == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                                <option value="quarterly"
                                                    {{ $report->performance_report_type == 'quarterly' ? 'selected' : '' }}>Quarterly
                                                    {{ $report->performance_report_type == 'quarterly' ? 'selected' : '' }}>Quarterly
                                                </option>
                                                <option value="semi_annually"
                                                    {{ $report->performance_report_type == 'semi_annually' ? 'selected' : '' }}>Semi Annually</option>
                                                    {{ $report->performance_report_type == 'semi_annually' ? 'selected' : '' }}>Semi Annually</option>
                                                <option value="annually"
                                                    {{ $report->performance_report_type == 'annually' ? 'selected' : '' }}>Annually</option>
                                                    {{ $report->performance_report_type == 'annually' ? 'selected' : '' }}>Annually</option>
                                                <option value="other"
                                                    {{ $report->performance_report_type == 'other' ? 'selected' : '' }}>Other</option>
                                                    {{ $report->performance_report_type == 'other' ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="input-options">
                                            <label>From</label>
                                            <input type="text" placeholder="DD-MM-YY" value="{{ $report->from }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="input-options">
                                            <label>To</label>
                                            <input type="text" placeholder="DD-MM-YY" value="{{ $report->to }}">
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
                                        <span id="status">{{ $data['status'] }}</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-12 mb-4">
                                    <div class="account-field-boxes">
                                        <p>No. of Investors</p>
                                        <span id="no_of_investors">{{ $data['no_of_investors'] }}</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-12 mb-4">
                                    <div class="account-field-boxes">
                                        <p>Report Cycle</p>
                                        <span id="report_cycle">{{ ucfirst($report->performance_report_type) }}</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-12 mb-4">
                                    <div class="account-field-boxes">
                                        <p>Funds Value</p>
                                        <span id="fund_value">{{ number_format($data['project_info']->projectFunding->funding_required)}} <small>SAR</small></span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-12 mb-4">
                                    <div class="account-field-boxes">
                                        <p>Funds Raised</p>
                                        <span id="fund_raised">{{ number_format($data['funds_raised']) }} <small>SAR</small></span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-12 mb-4">
                                    <div class="account-field-boxes">
                                        <p>Unit Price</p>
                                        <span id="unit_price">{{ $data['project_info']->projectFunding->price_per_share }} <small>SAR</small></span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-12 mb-4">
                                    <div class="account-field-boxes">
                                        <p>Total Units</p>
                                        <span id="total_units">{{ number_format($data['project_info']->projectFunding->no_of_shares) }}</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3 col-12 mb-4">
                                    <div class="account-field-boxes">
                                        <p>Ownership Percentage</p>
                                        <span id="ownership">{{ $data['ownership'] }}%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="div-hidden">
            <div class="funding-campaign-table developement-progress-table for-bdr hide-bd">
                <div class="d-flex flex-column-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-12">
                                <h4 class="campaign-dev-text">Development Progress </h4>
                            </div>
                        </div>
                        <form action="" id="development-progress-form" enctype="multipart/form-data">
                            <div class="row development-progress-text develop-prog-text for-td-alignment">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody id="parent-row">
                                                @foreach ($report->reportProgress as $key => $progress)
                                                    <tr>
                                                        <input type="hidden" name="progress_id[]"
                                                            value="{{ $progress->id }}">
                                                        <td width="20%">
                                                            <div class="input-options">
                                                                <label>Progress Type</label>
                                                                <select name="progress_type_old[{{ $key }}]"
                                                                    class="progress_type">
                                                                    <option value="">Select</option>
                                                                    <option value="planning"
                                                                        {{ $progress->progress_type == 'planning' ? 'selected' : '' }}>
                                                                        Planning</option>
                                                                    <option value="construction"
                                                                        {{ $progress->progress_type == 'construction' ? 'selected' : '' }}>
                                                                        Construction</option>
                                                                    <option value="operation"
                                                                        {{ $progress->progress_type == 'operation' ? 'selected' : '' }}>
                                                                        Operation</option>
                                                                </select>
                                                            </div>
                                                        </td>
                                                        <td width="20%">
                                                            <div class="input-options">
                                                                <label>Progress Percentage
                                                                    %</label>
                                                                <input type="text" class="progress_percentage"
                                                                    name="progress_percentage_old[{{ $key }}]"
                                                                    value="{{ $progress->progress_percentage }}">
                                                            </div>
                                                        </td>
                                                        <td width="10%">
                                                            <div class="input-options">
                                                                <label>Date</label>
                                                                <input type="text" name="date_old[{{ $key }}]"
                                                                    class="date_picker select_date"
                                                                    value="{{ $progress->date }}">
                                                            </div>
                                                        </td>
                                                        <td width="20%">
                                                            <div class="input-options">
                                                                <label>Documents (Optional)</label>
                                                                <input type="text" placeholder="Attach a document"
                                                                    id="name-{{ $key }}"
                                                                    name="file_name_old[{{ $key }}]"
                                                                    value="{{ $progress->image_name }}">
                                                            </div>
                                                        </td>
                                                        <td class="tb-button">
                                                            <div class="group-buttons categories-progress-view">
                                                                <a href="{{ asset('project-reports/'.$progress->image_path) }}" target="_blank" class="new-campaign-button-view">View Attachments</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="progress-summary-report-sec hide-bd">
                <div class="d-flex flex-column-fluid">
                    <div class="container">
                        <h4 class="progress-summary-text">Progress Report Summary</h4>
                        <form action="" id="progress-report-summary" method="post">
                            <div class="row investment-main-border">
                                {{--Equity Start--}}
                                @if(@$report->reportProgressSummary->report_type == 'equity')
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
                                                                                             value="{{ $report->reportProgressSummary->subscription_fees }}"
                                                                                             readonly></span>
                                        </li>
                                        <li><strong>Investment Info</strong> <span></span></li>
                                        <li>Capital Invested <span class="pull-right"><input type="text"
                                                                                             class="report-display"
                                                                                             placeholder="0.00"
                                                                                             name="capital_invested"
                                                                                             value="{{ number_format($report->reportProgressSummary->capital_invested) }}"
                                                                                             readonly
                                                                                             id="capital_invested"></span>
                                        </li>
                                        <li>Units owned <span class="pull-right"><input type="text"
                                                                                        name="unit_owned"
                                                                                        class="report-display"
                                                                                        placeholder="0.00" readonly
                                                                                        value="{{ $report->reportProgressSummary->unit_owned }}"
                                                                                        id="unit_owned"></span>
                                        </li>
                                        <li>Appreciation/Depreciation<span class="pull-right"><input type="text"
                                                                                                     name="app_dep"
                                                                                                     class="report-display"
                                                                                                     placeholder="0.00"
                                                                                                     value="{{ $report->reportProgressSummary->app_dep }}"%
                                                                                                     id="app-dep"></span>
                                        </li>
                                        <li>Investment Value<span class="pull-right"><input type="text"
                                                                                            name="investment_value"
                                                                                            class="report-display"
                                                                                            placeholder="0.00" readonly
                                                                                            value="{{ number_format($report->reportProgressSummary->investment_value) }}"
                                                                                            id="investment_value"></span>
                                        </li>
                                        <li>Unit Value<span class="pull-right"><input type="text"
                                                                                      name="unit_value"
                                                                                      class="report-display"
                                                                                      placeholder="0.00" readonly
                                                                                      value="{{ $report->reportProgressSummary->unit_value }}"
                                                                                      id="unit_value"></span>
                                        </li>
                                        <li><strong>Returns</strong> <span></span></li>
                                        <li>Total Dividends <span class="pull-right"><input type="text"
                                                                                            name="total_dividends"
                                                                                            class="report-display"
                                                                                            placeholder="0.00"
                                                                                            value="{{ number_format($report->reportProgressSummary->total_dividends) }}"
                                                                                            id="total_dividends"></span>
                                        </li>
                                        <li>Dividend return % (Holding period) <span class="pull-right"><input
                                                    type="text"
                                                    name="dividends_return"
                                                    class="report-display"
                                                    value="{{ $report->reportProgressSummary->dividends_return }}"%
                                                    placeholder="0.00" readonly id="dividends_return"></span>
                                        </li>
                                        <li><strong>Sales</strong> <span></span></li>
                                        <li>Sale Value <span class="pull-right"><input type="text"
                                                                                       name="sale_value"
                                                                                       class="report-display"
                                                                                       placeholder="0.00"
                                                                                       readonly
                                                                                       value="{{ number_format($report->reportProgressSummary->sale_value) }}"
                                                                                       id="sale_value"></span>
                                        </li>
                                        <li>Realized gain on sale % <span class="pull-right"><input type="text"
                                                                                                    class="report-display"
                                                                                                    placeholder="0.00"
                                                                                                    name="realized_gain"
                                                                                                    value="{{ $report->reportProgressSummary->realized_gain }}"%
                                                                                                    id="realized_gain"></span>
                                        </li>
                                        <li>Profit/(Loss) <span class="pull-right"><input type="text"
                                                                                          class="report-display"
                                                                                          placeholder="0.00"
                                                                                          name="profit_loss"
                                                                                          readonly
                                                                                          value="{{ number_format($report->reportProgressSummary->profit_loss) }}"
                                                                                          id="profit-loss"></span>
                                        </li>
                                        <li>Realized <span class="pull-right"><input type="text"
                                                                                     class="report-display"
                                                                                     placeholder="0.00"
                                                                                     name="realized"
                                                                                     value="{{ number_format($report->reportProgressSummary->realized) }}"
                                                                                     id="realized"></span>
                                        </li>
                                        <li>Unrealized <span class="pull-right"><input type="text"
                                                                                       class="report-display"
                                                                                       placeholder="0.00"
                                                                                       value="{{ number_format($report->reportProgressSummary->unrealized) }}"
                                                                                       name="unrealized" readonly
                                                                                       id="unrealized"></span>
                                        </li>
                                    </ul>
                                </div>
                                {{--Equity End--}}
                                @endif

                                @if(@$report->reportProgressSummary->report_type == 'debt')
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
                                                                                       value="{{ number_format($report->reportProgressSummary->fund_value_debt) }}"
                                                                                       placeholder="0.00"></span>
                                        </li>
                                        <li>Amount Raised <span class="pull-right"><input type="text"
                                                                                          name="amount_raised_debt"
                                                                                          id="amount_raised_debt"
                                                                                          class="report-display"
                                                                                          readonly
                                                                                          value="{{ number_format($report->reportProgressSummary->amount_raised_debt) }}"
                                                                                          placeholder="0.00"></span>
                                        </li>
                                        <li>Unit Price <span class="pull-right"><input type="text"
                                                                                       name="unit_price_debt"
                                                                                       id="unit_price_debt"
                                                                                       class="report-display"
                                                                                       readonly
                                                                                       value="{{ $report->reportProgressSummary->unit_price_debt }}"
                                                                                       placeholder="0.00"></span>
                                        </li>
                                        <li>Total units<span class="pull-right"><input type="text"
                                                                                       name="total_units_debt"
                                                                                       id="total_units_debt"
                                                                                       class="report-display"
                                                                                       readonly
                                                                                       value="{{ $report->reportProgressSummary->total_units_debt }}"
                                                                                       placeholder="0.00"></span>
                                        </li>
                                        <li>Lending Amount<span class="pull-right"><input type="text"
                                                                                          name="lending_amount_debt"
                                                                                          id="lending_amount_debt"
                                                                                          class="report-display"
                                                                                          readonly
                                                                                          value="{{ number_format($report->reportProgressSummary->lending_amount_debt) }}"
                                                                                          placeholder="0.00"></span>
                                        </li>
                                        <li>Murabha Rate<span class="pull-right"><input type="text"
                                                                                        name="murabha_rate_debt"
                                                                                        id="murabha_rate_debt"
                                                                                        class="report-display"
                                                                                        value="{{ $report->reportProgressSummary->murabha_rate_debt }}"
                                                                                        placeholder="0.00"></span>
                                        </li>
                                        <li>Total Period (always in months)<span class="pull-right"><input type="text"
                                                                                                           name="total_period_debt"
                                                                                                           id="total_period_debt"
                                                                                                           class="report-display"
                                                                                                           value="{{ $report->reportProgressSummary->total_period_debt }}"
                                                                                                           placeholder="0.00"></span>
                                        </li>
                                        <li>Payment Frequency (in months)<span class="pull-right"><input type="text"
                                                                                                         name="payment_requency_debt"
                                                                                                         id="payment_requency_debt"
                                                                                                         class="report-display"
                                                                                                         value="{{ $report->reportProgressSummary->payment_requency_debt }}"
                                                                                                         placeholder="Month"></span>
                                        </li>
                                        <li>Total Installments<span class="pull-right"><input type="text"
                                                                                              name="total_installments_debt"
                                                                                              id="total_installments_debt"
                                                                                              class="report-display"
                                                                                              value="{{ $report->reportProgressSummary->total_installments_debt }}"
                                                                                              placeholder="00"></span>
                                        </li>
                                        <li>Installment Amount Received (Total)<span class="pull-right"><input
                                                    type="text"
                                                    name="installment_recieved_debt"
                                                    id="installment_recieved_debt"
                                                    class="report-display"
                                                    value="{{ number_format($report->reportProgressSummary->installment_recieved_debt) }}"
                                                    placeholder="0.00"></span>
                                        </li>
                                        <li>Principle Amount Received<span class="pull-right"><input type="text"
                                                                                                     name="principle_amount_received_debt"
                                                                                                     id="principle_amount_received_debt"
                                                                                                     class="report-display"
                                                                                                     value="{{ number_format($report->reportProgressSummary->principle_amount_received_debt) }}"
                                                                                                     placeholder="0.00"></span>
                                        </li>
                                        <li>Profit Amount Received<span class="pull-right"><input type="text"
                                                                                                  name="profit_amount_received_debt"
                                                                                                  id="profit_amount_received_debt"
                                                                                                  class="report-display"
                                                                                                  value="{{ number_format($report->reportProgressSummary->profit_amount_received_debt) }}"
                                                                                                  placeholder="0.00"></span>
                                        </li>
                                        <li>No of Installments received<span class="pull-right"><input type="text"
                                                                                                       name="no_of_installments_received_debt"
                                                                                                       id="no_of_installments_received_debt"
                                                                                                       class="report-display"
                                                                                                       value="{{ $report->reportProgressSummary->no_of_installments_received_debt }}"
                                                                                                       placeholder="0.00"></span>
                                        </li>
                                        <li>Next Installment Expected (Date)<span class="pull-right"><input type="date"
                                                                                                            name="next_installment_debt"
                                                                                                            id="next_installment_debt"
                                                                                                            class="report-display"
                                                                                                            value="{{ $report->reportProgressSummary->next_installment_debt }}"
                                                                                                            placeholder="d-m-y"></span>
                                        </li>
                                        <li>Remaining Balance<span class="pull-right"><input type="text"
                                                                                             name="remaining_balance_debt"
                                                                                             id="remaining_balance_debt"
                                                                                             class="report-display"
                                                                                             readonly
                                                                                             value="{{ number_format($report->reportProgressSummary->remaining_balance_debt) }}"
                                                                                             placeholder="0.00"></span>
                                        </li>
                                        <li>Remaining Period (Maturity)<span class="pull-right"><input type="text"
                                                                                                       name="remaining_period_debt"
                                                                                                       id="remaining_period_debt"
                                                                                                       class="report-display"
                                                                                                       value="{{ $report->reportProgressSummary->remaining_period_debt }}"
                                                                                                       placeholder="Month"></span>
                                        </li>
                                        <li>ROI% (Holding Period)<span class="pull-right"><input type="text"
                                                                                                 name="roi_debt"
                                                                                                 id="roi_debt"
                                                                                                 class="report-display"
                                                                                                 readonly
                                                                                                 value="{{ $report->reportProgressSummary->roi_debt }}"
                                                                                                 placeholder="0.00"></span>
                                        </li>
                                        <li>Subscription Fees<span class="pull-right"><input type="text"
                                                                                             name="subscription_fees_debt"
                                                                                             id="subscription_fees_debt"
                                                                                             class="report-display"
                                                                                             readonly
                                                                                             value="{{ $report->reportProgressSummary->subscription_fees_debt }}"
                                                                                             placeholder="0.00"></span>
                                        </li>
                                        <li><strong>Investor Info</strong> <span></span></li>
                                        <li>Capital Invested<span class="pull-right"><input type="text"
                                                                                            name="capital_invested_debt"
                                                                                            id="capital_invested_debt"
                                                                                            class="report-display"
                                                                                            readonly
                                                                                            value="{{ number_format($report->reportProgressSummary->capital_invested_debt) }}"
                                                                                            placeholder="0.00"></span>
                                        </li>
                                        <li>Ownership % From Fund<span class="pull-right"><input type="text"
                                                                                                 name="ownership_from_fund_debt"
                                                                                                 id="ownership_from_fund_debt"
                                                                                                 class="report-display"
                                                                                                 value="{{ $report->reportProgressSummary->ownership_from_fund_debt }}"%
                                                                                                 placeholder="0.00"></span>
                                        </li>
                                        <li>Installment Received<span class="pull-right"><input type="text"
                                                                                                id="installment_received_debt_refered"
                                                                                                class="report-display"
                                                                                                readonly
                                                                                                value="{{ number_format($report->reportProgressSummary->installment_received_debt) }}"
                                                                                                placeholder="0.00"></span>
                                        </li>
                                        <li>Principle Amount Received<span class="pull-right"><input type="text"
                                                                                                     id="principle_amount_received_debt_refered"
                                                                                                     class="report-display"
                                                                                                     readonly
                                                                                                     value="{{ number_format($report->reportProgressSummary->principle_amount_received_debt) }}"
                                                                                                     placeholder="0.00"></span>
                                        </li>
                                        <li>Profit Amount Received<span class="pull-right"><input type="text"
                                                                                                  id="profit_amount_received_debt_refered"
                                                                                                  class="report-display"
                                                                                                  readonly
                                                                                                  value="{{ number_format($report->reportProgressSummary->profit_amount_received_debt) }}"
                                                                                                  placeholder="0.00"></span>
                                        </li>
                                        <li>Remaining Balance<span class="pull-right"><input type="text"
                                                                                             id="remaining_balance_debt_refered"
                                                                                             class="report-display"
                                                                                             readonly
                                                                                             value="{{ number_format($report->reportProgressSummary->remaining_balance_debt) }}"
                                                                                             placeholder="0.00"></span>
                                        </li>
                                        <li><strong>Returns</strong> <span></span></li>
                                        <li>ROI % (Holding Period) <span class="pull-right"><input type="text"
                                                                                                   name="roi_returns_debt"
                                                                                                   id="roi_returns_debt"
                                                                                                   class="report-display"
                                                                                                   readonly
                                                                                                   value="{{ $report->reportProgressSummary->roi_returns_debt }}"%
                                                                                                   placeholder="0.00"></span>
                                        </li>
                                        <li>ROI Amount (Interest Received) <span class="pull-right"><input type="text"
                                                                                                           name="roi_amount_debt"
                                                                                                           id="roi_amount_debt"
                                                                                                           class="report-display"
                                                                                                           readonly
                                                                                                           value="{{ $report->reportProgressSummary->roi_amount_debt }}"
                                                                                                           placeholder="0.00"></span>
                                        </li>
                                        <li>Loss of Principle <span class="pull-right"><input type="text"
                                                                                              name="loss_of_principle"
                                                                                              id="loss_of_principle"
                                                                                              class="report-display"
                                                                                              value="{{ $report->reportProgressSummary->loss_of_principle }}"
                                                                                              placeholder="0.00"></span>

                                    </ul>
                                </div>
                                {{--Debt End--}}
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="pro-document-attach hide-bd">
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
                                                @foreach ($report->reportDocuments as $key => $document)
                                                    <tr>
                                                        <input type="hidden" value="{{ $document->id }}"
                                                            name="document_id[]" class="report_id">
                                                        <td width="" class="visual-type-text">
                                                            <div class="input-options">
                                                                <label>Name</label>
                                                                <input type="text" placeholder="Project Prospectus"
                                                                    name="prospectus_old[{{ $key }}]"
                                                                    class="prospectus"
                                                                    value="{{ $document->prospectus }}">
                                                            </div>
                                                        </td>
                                                        <td width="35%" class="visual-type-text">
                                                            <label>File Attached</label>
                                                            <input type="text" placeholder="No File Choosen"
                                                                id="first-doc-{{ $key }}"
                                                                name="doc_name_old[{{ $key }}]"
                                                                class="document"
                                                                value="{{ $document->file_name }}">
                                                        </td>
                                                        <td class="file-ext" width="36%">
                                                            <label>File Type</label>
                                                            <img src="https://via.placeholder.com/30"
                                                                id="first-image-{{ $key }}" width="30px">
                                                        </td>
                                                        <td class="tick-1 tb-button">
                                                            <div class="group-buttons categories-progress-view">
                                                                <a href="{{ asset('project-documents/'.$document->file_path) }}" target="_blank" class="new-campaign-button-view">View Attachments</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // initialize datepicker
            $(".date_picker").datepicker({
                format: 'yy-mm-dd',
            });

            //append rows
            $(document).on('click', '.add-new-dev-prog', function(e) {
                e.preventDefault();
                var number = 1 + Math.floor(Math.random() * 6);
                var file_doc = number + '-doc';
                var file_file = number + '-file';
                var file_image = number + '-image';
                $('#development-progress-form #parent-row').append(
                    '<tr>' +
                    '<td width="">' +
                    '<div class="input-options">' +
                    '<label>Progress Type </label>' +
                    '<select name="progress_type[' + number + ']"' +
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
                    '<input type="text" name="progress_percentage[' + number + ']" ' +
                    'class = "progress_percentage" > ' +
                    '</div>' +
                    '</td>' +
                    '<td>' +
                    '<div class="input-options">' +
                    '<label>Date</label>' +
                    '<input type="text" name = "date[' + number + ']"' +
                    'class="date_picker select_date">' +
                    '</div>' +
                    '</td>' +
                    '<td>' +
                    '<div class="input-options">' +
                    '<label>Documents (Optional)</label>' +
                    '<input type="text" id="name-' + number + '" ' +
                    'placeholder="Attach a document" name="file_name[' + number + ']">' +
                    '</div>' +
                    '</td>' +
                    '<td class="tb-button">' +
                    '<div class="browse br-btn">' +
                    '<label class="dashboard-reset">' +
                    'Browse' +
                    '<input type="file" name="document_image[]" id="file-' + number + '"' +
                    'onchange="uploadImage(this, \'name-' + number + '\',\'file-' + number + ' \')"' +
                    'class="input-upload" >' +
                    '</label>' +
                    '</div>' +
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
            $(document).on('click', '#development-progress-form .class-img-hide', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                if (id) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).closest('tr').remove();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                }
                            });
                            $.ajax({
                                url: "{{ route('admin.remove-development-progress') }}",
                                method: 'post',
                                data: {
                                    id: id
                                },
                                success: function(result) {
                                    if (result.status == true) {
                                        Swal.fire(
                                            'Deleted!',
                                            'Your document has been deleted.',
                                            'success'
                                        )
                                    } else {
                                        $.each(result.error, function(k, v) {
                                            console.log(k, v);
                                        });
                                    }
                                }
                            });
                        }
                    })

                } else {
                    $(this).closest('tr').remove();
                }
            });
        });

        // create report form
        $('#create-report-form').on('submit', function(e) {
            e.preventDefault();
            var formValues = $(this).serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                method: "put",
                url: "{{ route('admin.update-report') }}",
                data: formValues,
                success: function(result) {
                    if (result.status == true) {
                        $('.report_id').val(result.report_id);
                        $('#div-hidden').show();
                        $('#create-report-form .dashboard-save').prop('disabled', 'disabled');
                    } else {
                        $.each(result.error, function(k, v) {
                            console.log(k, v);
                        });
                    }
                }
            })

        });

        $('#create-report-form').validate({
            rules: {
                project_id: {
                    required: true,
                },
                report_type: {
                    required: true,
                },
            },
            messages: {
                project_id: {
                    required: 'Project field is requierd.',
                },
                report_type: {
                    required: 'Report type field is requierd.',
                },
            },
        });

        // upload file function
        function uploadImage(form, namediv, file) {
            var i = $(this).prev('label').clone();
            console.log(file)
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
        $('#development-progress-form').on('submit', function(e) {
            e.preventDefault();
            $('.progress_percentage').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Progress Percentage is required",
                    }
                });
            });
            $('.select_date').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Date is required",
                    }
                });
            });
            $('.progress_type').each(function() {
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
                url: "{{ route('admin.update-development-progress') }}",
                processData: false,
                cache: false,
                contentType: false,
                data: formValues,
                success: function(result) {
                    if (result.status == true) {
                        $('#development-progress-form .dashboard-save').prop('disabled',
                            'disabled');
                    } else {
                        $.each(result.error, function(k, v) {
                            console.log(k, v);
                        });
                    }
                }
            })

        });

        $("#development-progress-form").validate();

        // progress report summary form
        $('#progress-report-summary').on('submit', function(e) {
            e.preventDefault();
            var formValues = $(this).serialize();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                method: "put",
                url: "{{ route('admin.update-progress-report-summary') }}",
                data: formValues,
                success: function(result) {
                    if (result.status == true) {
                        $('#progress-report-summary .dashboard-save').prop('disabled',
                            'disabled');
                    } else {
                        $.each(result.error, function(k, v) {
                            console.log(k, v);
                        });
                    }
                }
            })
        });

        // validate progress report summary
        $.validator.addMethod('minStrict', function(value, el, param) {
            return value > param;
        });
        $('#progress-report-summary').validate({
            rules: {
                amount_invested_equity: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                transactional_cost_equity: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                capital_allocated_equity: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                appreciation: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                share_value: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                advisory_fee: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                property_management_fee: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                maintenance_fee: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                construction: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                other_expenses: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                rent_amount: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                gross_yield: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                net_yield: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                net_return_equity: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                expected_roi: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                actual_roi: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                sales_proceed: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                amount_invested_debt: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                transactional_cost_debt: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                capital_allocated_debt: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                lending_type: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                murabaha_rate: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                amount_borrowed: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                installements_received: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                next_installement_expected: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                remaining_balance: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                amount_expected: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                roi: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
                net_return_debit: {
                    required: true,
                    number: true,
                    minStrict: 1,
                },
            },
            messages: {
                amount_invested_equity: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                transactional_cost_equity_: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                capital_allocated_equity: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                appreciation: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                share_value: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                advisory_fee: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                property_management_fee: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                maintenance_fee: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                construction: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                other_expenses: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                rent_amount: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                gross_yield: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                net_yield: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                net_return_equity: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                expected_roi: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                actual_roi: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                sales_proceed: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                amount_invested_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                transactional_cost_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                capital_allocated_debt: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                lending_type: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                murabaha_rate: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                amount_borrowed: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                installements_received: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                next_installement_expected: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                remaining_balance: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                amount_expected: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                roi: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
                net_return_debit: {
                    required: '{{ __('auth.required') }}',
                    number: 'This field can only contain numbers.',
                    minStrict: "This amount should be greater than one."
                },
            },
        });

        function readNameAndType(input, divName, file, image) {
            var i = $(this).prev('label').clone();
            console.log("file_id", file)
            var file = $('#' + file)[0].files[0].name;
            console.log(file)
            console.log(divName)
            var fileExt = file.split('.').pop();
            console.log(fileExt);
            if (fileExt == "pdf" || fileExt == "docx" || fileExt == "doc") {
                $('#' + divName).val(file);
                var imageExt = "{{ url('images/investor/') }}" + '/' + fileExt[1] + '.png';
                $('#' + image).attr('src', imageExt);
            } else {
                // input.val('');
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: 'Only pdf,docx and doc are allowed!',
                    timer: 2000,
                    showCancelButton: false,
                    showConfirmButton: false
                });
                return false;
            }

        }
        //documents attached form
        $('#documents-attached-form .add-new').click(function(e) {
            e.preventDefault();
            var number = 1 + Math.floor(Math.random() * 6);
            var file_doc = number + '-doc';
            var file_file = number + '-file';
            var file_image = number + '-image';
            $('#documents-attached-form #parent-row').append(
                '<tr>' +
                '<td width="" class="visual-type-text">' +
                '<div class="input-options">' +
                '<label>Name</label>' +
                '<input name="prospectus[' + number +
                ']" type="text" class="prospectus" placeholder="Project Prospectus">' +
                '</div>' +
                '</td>' +
                '<td width="35%" class="visual-type-text">' +
                '<label>File Attached</label>' +
                '<input type="text" class="document" placeholder="No File Choosen" id="' + number +
                '-doc" name="doc_name[' + number + ']">' +
                '</td>' +
                '<td class="file-ext" width="36%">' +
                '<label>File Type</label>' +
                '<img src="https://via.placeholder.com/30" width="30px" id="' + number + '-image">' +
                '</td>' +
                '<td class="tick-1 tb-button">' +
                '<div class="jack-profile-buttons text-center">' +
                '<div class="browse">' +
                '<label class="dashboard-reset d-flex mx-auto"> Browse' +
                '<input type="file" name="doc_upload[' + number + ']" id="' + number +
                '-file" class="input-upload" onchange="readNameAndType(this, \'' + file_doc + '\', \'' +
                file_file + '\', \'' + file_image + '\')">' +
                '</label>' +
                '</div>' +
                '</div>' +
                '<a href="javascriptvoid:(0)"><img src="{{ asset('images/close-icon.png') }}" ' +
                'class="class-img-hide"></a>' +
                '</td>' +
                '</tr>'
            )
            $("#documents-attached-form").validate();

        });

        $('#documents-attached-form').on('submit', function(e) {
            e.preventDefault();
            var formValues = new FormData(this);
            $('.prospectus').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Project prospectus is required",
                    }
                });
            });
            $('.document').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Project document is required",
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
                url: "{{ route('admin.update-attached-documents') }}",
                processData: false,
                cache: false,
                contentType: false,
                data: formValues,
                success: function(result) {
                    if (result.status == true) {
                        $('#documents-attached-form .dashboard-save').prop('disabled',
                            'disabled');
                        $('#documents-attached-form .add-new').prop('disabled',
                            'disabled');
                    } else {
                        $.each(result.error, function(k, v) {
                            console.log(k, v);
                        });
                    }
                }
            })
        });
        $("#documents-attached-form").validate();

        $(document).on('click', '#documents-attached-form .class-img-hide', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            if (id) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).closest('tr').remove();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{ route('admin.remove-attached-document') }}",
                            method: 'post',
                            data: {
                                id: id
                            },
                            success: function(result) {
                                if (result.status == true) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your document has been deleted.',
                                        'success'
                                    )
                                } else {
                                    $.each(result.error, function(k, v) {
                                        console.log(k, v);
                                    });
                                }
                            }
                        });
                    }
                })

            } else {
                $(this).closest('tr').remove();
            }
        });
    </script>
@endsection
