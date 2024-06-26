@extends('layouts.investor.investor')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | {{ __('performance.performance') }}</title>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="perfom_2">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <div class="prog_report">
                        <h2>Progress Reports</h2>
                    </div>
                    <div class="dbx_fcr">
                        <div class="row for_shaw_shine position-relative">
                            <div class="col-md-12 col-sm-12 col-12 un_str">
                                <div id="accordion">
                                    @foreach($reports as $key => $report)
                                        @foreach($report->projects->reports as $report1)
                                            <div class="card">
                                                <div class="card-header" id="heading{{ $report1->id }}">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn collapsed get_report_details"
                                                                data-toggle="collapse"
                                                                data-target="#collapse{{ $report1->id }}"
                                                                aria-expanded="false"
                                                                data-report-id="{{ $report1->id }}"
                                                                aria-controls="collapse{{ $report1->id }}">
                                                            <div class="for_cnt_trxt lon_alit">
                                                                <p class="conflict_kit">
                                                                        <span
                                                                            class="thm_cot">PR {{ $report1->id }}</span>Progress
                                                                    Report</p>
                                                                <h4>{{ App::getLocale() == 'en' ? $report->projects->project_name_en : $report->projects->project_name_ar }}</h4>
                                                                <strong
                                                                    class="date_for1">{{ date('d/m/Y', strtotime($report1->from)) }}
                                                                    To {{ date('d/m/Y', strtotime($report1->to)) }}</strong>

                                                            </div>
                                                        </button>
                                                        <span
                                                            class="view-detail-btn pull-right dyno-1 get_report_details"
                                                            data-toggle="collapse"
                                                            data-target="#collapse{{ $report1->id }}"
                                                            aria-expanded="false"
                                                            aria-controls="collapse{{ $report1->id }}"
                                                            data-report-id="{{ $report1->id }}">View Detail</span>
                                                    </h5>
                                                </div>
                                                <div id="collapse{{ $report1->id }}" class="collapse"
                                                     aria-labelledby="heading{{ $report1->id }}"
                                                     data-parent="#accordion">
                                                    <div id="the_canvas_element_id">
                                                        <div class="assets-1">
                                                            <div class="row for_removing_pdr_mr">
                                                                <div class="col-md-2 col-sm-2 col-12">
                                                                    <div class="content_trt1">
                                                                        <h6>Type</h6>
                                                                        <p>{{ ucfirst($report1->performance_report_type) }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2 col-sm-2 col-12">
                                                                    <div class="content_trt1">
                                                                        <h6>Investment</h6>
                                                                        <p>{{ getUserInvestmentsByProject(auth()->user()->id, $report->project_id) }}
                                                                            SAR</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2 col-sm-2 col-12">
                                                                    <div class="content_trt1">
                                                                        <h6>Share</h6>
                                                                        <p>{{ getUserProjectShares(auth()->user()->id, $report->project_id) }}
                                                                            %</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2 col-sm-2 col-12">
                                                                    <div class="content_trt1">
                                                                        <h6>Structure</h6>
                                                                        <p>{{ $report->projects->projectFunding->structure }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2 col-sm-2 col-12">
                                                                    <div class="content_trt1">
                                                                        <h6>Type</h6>
                                                                        <p>{{ App::getLocale() == 'en' ? $report->projects->project_type_en : $report->projects->project_type_ar }}</p>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-md-2 col-sm-2 col-12 for_flexing_set">
                                                                    <div class="content_trt1">
                                                                        <h6>Project Status</h6>
                                                                        <p class="csft_clor">{{ $report->ending_period > date('Y-m-d') ? 'In Progress' : 'Closed' }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="cc_circle1">
                                                                <div class="d-flex flex-column-fluid">
                                                                    <div class="container">
                                                                        <div class="circle_progress">
                                                                            <div class="development_hadfr">
                                                                                <h2>Development Progress</h2>
                                                                                <p>Sponsor Progress</p>
                                                                            </div>
                                                                            <div class="row">
                                                                                @foreach($report1->reportProgress as $progress)
                                                                                    <div
                                                                                        class="col-md-4 col-sm-4 col-12 progress-loader {{ $progress->progress_type }}">
                                                                                        <div class="card">
                                                                                            <div
                                                                                                class="percent">
                                                                                                <svg>
                                                                                                    <circle
                                                                                                        cx="105"
                                                                                                        cy="105"
                                                                                                        r="100"></circle>
                                                                                                    <circle
                                                                                                        cx="105"
                                                                                                        cy="105"
                                                                                                        r="100"
                                                                                                        style="--percent: {{ $progress->progress_percentage }}"></circle>
                                                                                                </svg>
                                                                                                <div
                                                                                                    class="number">
                                                                                                    <h3>{{ $progress->progress_percentage }}
                                                                                                        <span>%</span>
                                                                                                    </h3>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                            <div class="row">
                                                                                <div
                                                                                    class="col-md-12 col-sm-12 col-12">
                                                                                    <div class="chart-areas">
                                                                                        <ul>
                                                                                            @foreach($report1->reportProgress as $progress)
                                                                                                <li>
                                                                                                    <i class="fa fa-circle icon-{{ $progress->progress_type }}"
                                                                                                       aria-hidden="true"></i>{{ ucfirst($progress->progress_type) }}
                                                                                                </li>
                                                                                            @endforeach
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="inline_columns">
                                                                <div class="container">
                                                                    <div class="porgress_summar_hd">
                                                                        <h2>Progress Report Summary</h2>
                                                                    </div>
                                                                    <div class="row">
                                                                        @if($report->projects->projectFunding->structure == 'Equity' || $report->projects->projectFunding->structure == 'equity')
                                                                            <div
                                                                                class="col-md-5 col-sm-5 col-12 equity_section position-relative"
                                                                                id="equity-{{ $report1->id }}">
                                                                                <div class="custom-loader">
                                                                                            <span>
                                                                                                Please Wait while we are calculating the values.
                                                                                            </span>
                                                                                </div>
                                                                                <div
                                                                                    class="equit-amount-heading text-center">
                                                                                    <h4>Equity</h4>
                                                                                </div>
                                                                                <div class="for-property-info">
                                                                                    <ul>
                                                                                        <h4>Project Info</h4>
                                                                                        <li>Funds Raised<span
                                                                                                class="pull-right"
                                                                                                id="fund_raised">0.00</span>
                                                                                        </li>
                                                                                        <li>Unit Price <span
                                                                                                class="pull-right"
                                                                                                id="unit_price">0.00</span>
                                                                                        </li>
                                                                                        <li>Total Units<span
                                                                                                class="pull-right"
                                                                                                id="total_units">0.00</span>
                                                                                        </li>
                                                                                        <li>Ownership
                                                                                            Percentage<span
                                                                                                class="pull-right"
                                                                                                id="ownership_percentage">0.00</span>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="for-report-type">

                                                                                    <ul>
                                                                                        <li>Report Type <span
                                                                                                class="pull-right"
                                                                                                id="report_type">0.00</span>
                                                                                        </li>
                                                                                        <li>Period<span
                                                                                                class="pull-right"
                                                                                                id="period">0.00</span>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>

                                                                                <div class="for-property-info">
                                                                                    <ul>
                                                                                        <h4>Fee</h4>
                                                                                        <li>Subscription
                                                                                            Fees<span
                                                                                                class="pull-right"
                                                                                                id="subscription_fee">0.00</span>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>

                                                                                <div class="for-property-info">
                                                                                    <ul>
                                                                                        <h4>Investment Info</h4>
                                                                                        <li>Capital Invested
                                                                                            <span
                                                                                                class="pull-right"
                                                                                                id="capital_invested">0.00</span>
                                                                                        </li>
                                                                                        <li>Units owned <span
                                                                                                class="pull-right"
                                                                                                id="units_owned">0.00</span>
                                                                                        </li>
                                                                                        <li>
                                                                                            Appreciation/Depreciation
                                                                                            <span
                                                                                                class="pull-right"
                                                                                                id="app_depp">0.00</span>
                                                                                        </li>
                                                                                        <li>Investment Value
                                                                                            <span
                                                                                                class="pull-right"
                                                                                                id="investment_value">0.00</span>
                                                                                        </li>
                                                                                        <li>Unit Value <span
                                                                                                class="pull-right"
                                                                                                id="unit_value">0.00</span>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>

                                                                                <div class="for-property-info">
                                                                                    <ul>
                                                                                        <h4>Returns</h4>
                                                                                        <li>Total Dividends
                                                                                            <span
                                                                                                class="pull-right"
                                                                                                id="returns">0.00</span>
                                                                                        </li>
                                                                                        <li>Dividend return %
                                                                                            (Holding
                                                                                            period) <span
                                                                                                class="pull-right"
                                                                                                id="dividends_return">0.00</span>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="for-property-info">
                                                                                    <ul>
                                                                                        <h4>Sales</h4>
                                                                                        <li>Sale Value <span
                                                                                                class="pull-right"
                                                                                                id="sale_value">0.00</span>
                                                                                        </li>
                                                                                        <li>Realized gain on
                                                                                            sale %
                                                                                            <span
                                                                                                class="pull-right"
                                                                                                id="realized_gain">0.00</span>
                                                                                        </li>
                                                                                        <li>Profit/(Loss) <span
                                                                                                class="pull-right"
                                                                                                id="profit_loss">0.00</span>
                                                                                        </li>
                                                                                        <li>Realized<span
                                                                                                class="pull-right"
                                                                                                id="realized">0.00</span>
                                                                                        </li>
                                                                                        <li>Unrealized<span
                                                                                                class="pull-right"
                                                                                                id="unrealized">0.00</span>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                        @if($report->projects->projectFunding->structure == 'Debt' || $report->projects->projectFunding->structure == 'debt')
                                                                            <div
                                                                                class="col-md-5 col-sm-5 col-12 debt_section"
                                                                                id="debt-{{ $report1->id }}">
                                                                                <div
                                                                                    class="equit-amount-heading text-center">
                                                                                    <h4>DEBT</h4>
                                                                                </div>
                                                                                <div class="for-report-type">

                                                                                    <ul>
                                                                                        <li>Report Type <span
                                                                                                class="pull-right"
                                                                                                id="report_type">N/A</span>
                                                                                        </li>
                                                                                        <li>Period<span
                                                                                                class="pull-right"
                                                                                                id="period">N/A</span>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>

                                                                                <div class="for-property-info">
                                                                                    <ul>
                                                                                        <h4>Project Info</h4>
                                                                                        <li>Fund value<span
                                                                                                class="pull-right"
                                                                                                id="fund_value_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>Amount Raised<span
                                                                                                class="pull-right"
                                                                                                id="amount_raised_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>Unit Price<span
                                                                                                class="pull-right"
                                                                                                id="unit_price_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>Total units<span
                                                                                                class="pull-right"
                                                                                                id="total_units_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>Lending Amount<span
                                                                                                class="pull-right"
                                                                                                id="lending_amount_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>Murabha Rate<span
                                                                                                class="pull-right"
                                                                                                id="murabha_rate_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>Total Period (always
                                                                                            in
                                                                                            months)<span
                                                                                                class="pull-right"
                                                                                                id="total_period_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>Payment Frequency
                                                                                            (in
                                                                                            months)<span
                                                                                                class="pull-right"
                                                                                                id="payment_requency_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>Total
                                                                                            Installments<span
                                                                                                class="pull-right"
                                                                                                id="total_installments_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>Installment Amount
                                                                                            Received
                                                                                            (Total)<span
                                                                                                class="pull-right"
                                                                                                id="installment_recieved_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>Principle Amount
                                                                                            Received<span
                                                                                                class="pull-right"
                                                                                                id="principle_amount_received_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>Profit Amount
                                                                                            Received<span
                                                                                                class="pull-right"
                                                                                                id="profit_amount_received_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>No of Installments
                                                                                            received<span
                                                                                                class="pull-right"
                                                                                                id="no_of_installments_received_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>Next Installment
                                                                                            Expected
                                                                                            (Date)<span
                                                                                                class="pull-right"
                                                                                                id="next_installment_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>Remaining
                                                                                            Balance<span
                                                                                                class="pull-right"
                                                                                                id="remaining_balance_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>Remaining Period
                                                                                            (Maturity)<span
                                                                                                class="pull-right"
                                                                                                id="remaining_period_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>ROI% (Holding
                                                                                            Period)<span
                                                                                                class="pull-right"
                                                                                                id="roi_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>Subscription
                                                                                            Fees<span
                                                                                                class="pull-right"
                                                                                                id="subscription_fees_debt">0.00</span>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="for-property-info">
                                                                                    <ul>
                                                                                        <h4>Investor Info</h4>
                                                                                        <li>Capital
                                                                                            Invested<span
                                                                                                class="pull-right"
                                                                                                id="capital_invested_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>Ownership % From
                                                                                            Fund<span
                                                                                                class="pull-right"
                                                                                                id="ownership_from_fund_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>Installment
                                                                                            Received<span
                                                                                                class="pull-right"
                                                                                                id="installment_received_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>Principle Amount
                                                                                            Received<span
                                                                                                class="pull-right"
                                                                                                id="principle_amount_received_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>Profit Amount
                                                                                            Received<span
                                                                                                class="pull-right"
                                                                                                id="profit_amount_received_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>Remaining
                                                                                            Balance<span
                                                                                                class="pull-right"
                                                                                                id="remaining_balance_debt">0.00</span>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <div class="for-property-info">
                                                                                    <ul>
                                                                                        <h4>Returns</h4>
                                                                                        <li>ROI % (Holding
                                                                                            Period)<span
                                                                                                class="pull-right"
                                                                                                id="roi_returns_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>ROI Amount (Interest
                                                                                            Received)<span
                                                                                                class="pull-right"
                                                                                                id="roi_amount_debt">0.00</span>
                                                                                        </li>
                                                                                        <li>Loss of
                                                                                            Principle<span
                                                                                                class="pull-right"
                                                                                                id="loss_of_principle">0.00</span>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="progress-download-sec">
                                                                <div class="container">
                                                                    <div class="row">
                                                                        @foreach($report1->reportDocuments as $report_doc)
                                                                            <div class="col-md-4 col-sm-4 col-12">
                                                                                <div class="down_prop1 ">
                                                                                    <div class="dow_analytics1">
                                                                                        <h6>
                                                                                            DOWNLOAD
                                                                                            <a href="{{ asset('project-documents/'.$report_doc->file_path) }}"
                                                                                               download=""
                                                                                               class="pull-right">
                                                                                                <img
                                                                                                    src="{{asset('images/download.png')}}"
                                                                                                    alt="">
                                                                                            </a>
                                                                                        </h6>
                                                                                        <a href="{{ asset('project-documents/'.$report_doc->file_path) }}"
                                                                                           download="">{{ $report_doc->prospectus }}</a>
                                                                                    </div>
                                                                                    {{--                                                                                    <div class="down_prop1 ">--}}
                                                                                    {{--                                                                                        <div class="dow_analytics1">--}}
                                                                                    {{--                                                                                            <h6>--}}
                                                                                    {{--                                                                                                DOWNLOAD--}}
                                                                                    {{--                                                                                                <a href="{{ route('investor.pdf',$report1->id) }}" class="pull-right">--}}
                                                                                    {{--                                                                                                    <img src="{{asset('images/download.png')}}" alt="">--}}
                                                                                    {{--                                                                                                </a>--}}
                                                                                    {{--                                                                                            </h6>--}}
                                                                                    {{--                                                                                            <a href="{{ route('investor.pdf',$report1->id) }}">Progress Report.pdf</a>--}}
                                                                                    {{--                                                                                        </div>--}}
                                                                                    {{--                                                                                    </div>--}}
                                                                                    {{--                                                                                </div>--}}
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                            <div class="position-absolute zindex-n1" style="left: 20px; top: 45px;">No Progress Report</div>
                        </div>
                        <div>
                            {{--{{ $reports->links() }}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script>
        $('.get_report_details').on('click', function (event) {
            event.preventDefault();
            var report_id = $(this).data('report-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('investor.performance.info') }}",
                method: 'post',
                data: {report_id: report_id},
                // beforeSend: function () {
                //
                // },
                success: function (result) {
                    if (result.status == true) {
                        if (result.data.report_type == 'Equity' || result.data.report_type == 'equity') {
                            //Equity report starts here
                            $('#equity-' + report_id + ' #report_type').empty().append(result.data.report_type);
                            $('#equity-' + report_id + ' #period').empty().append(result.data.period);
                            $('#equity-' + report_id + ' #fund_raised').empty().append(result.data.fund_raised.toLocaleString());
                            $('#equity-' + report_id + ' #unit_price').empty().append(result.data.unit_price.toLocaleString());
                            $('#equity-' + report_id + ' #total_units').empty().append(result.data.total_units.toLocaleString());
                            $('#equity-' + report_id + ' #ownership_percentage').empty().append(result.data.ownership_percentage);
                            $('#equity-' + report_id + ' #subscription_fee').empty().append(result.data.subscription_fee);
                            $('#equity-' + report_id + ' #capital_invested').empty().append(result.data.capital_invested.toLocaleString());
                            $('#equity-' + report_id + ' #units_owned').empty().append(result.data.units_owned);
                            $('#equity-' + report_id + ' #app_depp').empty().append(result.data.app_depp);
                            $('#equity-' + report_id + ' #investment_value').empty().append(result.data.investment_value.toLocaleString());
                            $('#equity-' + report_id + ' #unit_value').empty().append(result.data.unit_value);
                            $('#equity-' + report_id + ' #returns').empty().append(result.data.returns.toLocaleString());
                            $('#equity-' + report_id + ' #dividends_return').empty().append(result.data.dividends_return);
                            $('#equity-' + report_id + ' #sale_value').empty().append(result.data.sale_value.toLocaleString());
                            $('#equity-' + report_id + ' #realized_gain').empty().append(result.data.realized_gain);
                            $('#equity-' + report_id + ' #profit_loss').empty().append(result.data.profit_loss.toLocaleString());
                            $('#equity-' + report_id + ' #realized').empty().append(result.data.realized.toLocaleString());
                            $('#equity-' + report_id + ' #unrealized').empty().append(result.data.unrealized || 0);
                            //Equity report Ends here
                        } else {
                            $('#debt-' + report_id + ' #report_type').empty().append(result.data.report_type.toLocaleString());
                            $('#debt-' + report_id + ' #period').empty().append(result.data.period.toLocaleString());
                            $('#debt-' + report_id + ' #fund_value_debt').empty().append(result.data.fund_value_debt.toLocaleString());
                            $('#debt-' + report_id + ' #amount_raised_debt').empty().append(result.data.amount_raised_debt.toLocaleString());
                            $('#debt-' + report_id + ' #unit_price_debt').empty().append(result.data.unit_price_debt.toLocaleString());
                            $('#debt-' + report_id + ' #total_units_debt').empty().append(result.data.total_units_debt.toLocaleString());
                            $('#debt-' + report_id + ' #lending_amount_debt').empty().append(result.data.lending_amount_debt.toLocaleString());
                            $('#debt-' + report_id + ' #murabha_rate_debt').empty().append(result.data.murabha_rate_debt + '%');
                            $('#debt-' + report_id + ' #total_period_debt').empty().append(result.data.total_period_debt.toLocaleString());
                            $('#debt-' + report_id + ' #payment_requency_debt').empty().append(result.data.payment_requency_debt.toLocaleString());
                            $('#debt-' + report_id + ' #total_installments_debt').empty().append(result.data.total_installments_debt.toLocaleString());
                            $('#debt-' + report_id + ' #installment_recieved_debt').empty().append(result.data.installment_recieved_debt.toLocaleString());
                            $('#debt-' + report_id + ' #principle_amount_received_debt').empty().append(result.data.principle_amount_received_debt.toLocaleString());
                            $('#debt-' + report_id + ' #profit_amount_received_debt').empty().append(result.data.profit_amount_received_debt.toLocaleString());
                            $('#debt-' + report_id + ' #no_of_installments_received_debt').empty().append(result.data.no_of_installments_received_debt.toLocaleString());
                            $('#debt-' + report_id + ' #next_installment_debt').empty().append(result.data.next_installment_debt);
                            $('#debt-' + report_id + ' #remaining_balance_debt').empty().append(result.data.remaining_balance_debt.toLocaleString());
                            $('#debt-' + report_id + ' #remaining_period_debt').empty().append(result.data.remaining_period_debt);
                            $('#debt-' + report_id + ' #roi_debt').empty().append(result.data.roi_debt + '%');
                            $('#debt-' + report_id + ' #subscription_fees_debt').empty().append(result.data.subscription_fees_debt);
                            $('#debt-' + report_id + ' #capital_invested_debt').empty().append(result.data.capital_invested_debt);
                            $('#debt-' + report_id + ' #ownership_from_fund_debt').empty().append(result.data.ownership_from_fund_debt);
                            $('#debt-' + report_id + ' #installment_received_debt').empty().append(result.data.installment_received_debt);
                            $('#debt-' + report_id + ' #roi_returns_debt').empty().append(result.data.roi_returns_debt + '%');
                            $('#debt-' + report_id + ' #roi_amount_debt').empty().append(result.data.roi_amount_debt);
                            $('#debt-' + report_id + ' #loss_of_principle').empty().append(result.data.loss_of_principle);
                        }
                        $('.custom-loader').addClass('hide');
                    } else {
                        $.each(result.error, function (k, v) {
                            console.log(k, v);
                        });
                    }
                },
                error: function (result) {
                    $('.custom-loader').addClass('hide');
                }
            });
        })
    </script>
@endsection
