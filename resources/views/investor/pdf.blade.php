<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
          integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('investor/assets/css/rej.css') }}">
    <link rel="stylesheet" href="{{ asset('investor/assets/css/plugin.bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
    <title>NITAJ REPORT</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        body {
            font-family: 'Poppins';
        }


        ul li {
            list-style: none;
        }

        .thm_cot {
            color: #36B387;
            font-weight: 500;
            margin-right: 8px;
            font-size: 12px;
        }

        .for_cnt_trxt p {
            font-size: 12px;
            margin-bottom: 0px;
            color: #8D8B8B;
        }

        .for_cnt_trxt h4 {
            color: #4C4C55;
            font-weight: 500;
        }

        .date_for1 {
            font-size: 12px;
            color: #8D8B8B;
            font-weight: 400;
        }

        .perfom_2 {
            padding: 60px 0px;
        }

        .card-header {
            background-color: unset;
            padding: 30px;
        }


        .content_trt1 h6 {
            font-size: 14px;
            color: #4C4C55;
            font-weight: 700;
            text-align: center;
        }

        .content_trt1 p {
            font-size: 13px;
            text-align: center;
            margin-bottom: 0px;
            color: #8D8B8B;
        }

        .assets-1 {
            padding: 30px 0px;
        }

        .porgress_summar_hd h2 {
            font-size: 30px;
            font-weight: 500;
            color: #4C4C55;
            margin-bottom: 45px;
        }

        .equit-amount-heading h4 {
            font-size: 25px;
            color: #4C4C55;
            margin-bottom: 30px;
        }

        .for-report-type {
            border-bottom: 1px solid #F1F1F3;
            margin-bottom: 15px;
        }

        .for-report-type li {
            font-size: 13px;
            color: #8D8B8B;
            margin-bottom: 7px;
        }

        .for-property-info h4 {
            color: #4C4C55;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .for-property-info li {
            font-size: 13px;
            color: #8D8B8B;
            list-style: none;
            margin-bottom: 7px;
        }

        .for-property-info {
            margin-bottom: 25px;
        }

        td{
            text-align: center;
        }
    </style>

</head>

<body>
<div class="perfom_2">
    <div class="container">
        <div class="dbx_fcr">
            <div class="row for_shaw_shine">
                <div class="col-md-12 col-sm-12 col-12 un_str">
                    <div id="pdf-rep">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <div class="for_cnt_trxt lon_alit">
                                        <p class="conflict_kit"><span class="thm_cot">PR {{ $report->project_id }}</span>
                                            Progress Report</p>
                                        <h4>{{ App::getLocale() == 'en' ? $report->project->project_name_en : $report->project->project_name_ar }}</h4>
                                        <strong class="date_for1">{{ date('d/m/Y', strtotime($funding_campaign->starting_period)) }}
                                            To {{ date('d/m/Y', strtotime($funding_campaign->ending_period)) }}</strong>
                                    </div>
                                </h5>
                            </div>
                            <div class="bd-rep-main">
                                <div class="assets-1">
                                    <div class="table-responsive">
                                        <table class="table" style="width: 100%;">
                                            <thead>
                                            <th>Type</th>
                                            <th>Investment</th>
                                            <th>Share</th>
                                            <th>Structure</th>
                                            <th>Type</th>
                                            <th>Project Status</th>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Quarterly</td>
                                                <td>{{ getUserInvestmentsByProject(auth()->user()->id, $report->project_id) }} SR</td>
                                                <td>{{ getUserProjectShares(auth()->user()->id, $report->project_id) }}%</td>
                                                <td>{{ $report->project->projectFunding->structure }}</td>
                                                <td>{{ App::getLocale() == 'en' ? $report->project->project_type_en : $report->project->project_type_ar }}</td>
                                                <td>{{ $funding_campaign->ending_period > date('Y-m-d') ? 'In Progress' : 'Closed' }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- loaders div -->
                                <div class="cc_circle1">
                                    <div class="d-flex flex-column-fluid">
                                        <div class="container">
                                            <div class="circle_progress">
                                                <div class="development_hadfr">
                                                    <h2>Development Progress</h2>
                                                    <p>Sponsor Progress</p>
                                                </div>
                                                <div class="row">
                                                    @foreach($report->reportProgress as $progress)
                                                        <div
                                                            class="col-md-4 col-sm-4 col-12 progress-loader {{ $progress->progress_type }}">
                                                            <div class="card">
                                                                <div class="percent">
                                                                    <svg>
                                                                        <circle cx="105" cy="105"
                                                                                r="100"></circle>
                                                                        <circle cx="105" cy="105"
                                                                                r="100"
                                                                                style="--percent: {{ $progress->progress_percentage }}"></circle>
                                                                    </svg>
                                                                    <div class="number">
                                                                        <h3>{{ $progress->progress_percentage }}
                                                                            <span>%</span></h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-12">
                                                        <div class="chart-areas">
                                                            <ul>
                                                                @foreach($report->reportProgress as $progress)
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
                                <!-- loaders div end -->
                                <div class="card-body">
                                    <div class="inline_columns">
                                        <div class="container">
                                            <div class="porgress_summar_hd">
                                                <h2>Progress Report Summary</h2>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-5 col-sm-5 col-12">
                                                    <div class="equit-amount-heading text-center">
                                                        <h4>Equity</h4>
                                                    </div>
                                                    <div class="for-report-type">

                                                        <ul>
                                                            <li>Report Type <span class="pull-right">N/A</span>
                                                            </li>
                                                            <li>Period<span class="pull-right">N/A</span>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="for-property-info">
                                                        <ul>
                                                            <h4>Investment Info</h4>
                                                            <li>Amount invested <span class="pull-right">N/A</span>
                                                            </li>
                                                            <li>Transactional Cost <span
                                                                    class="pull-right">N/A</span>
                                                            </li>
                                                            <li>Capital Allocated <span
                                                                    class="pull-right">N/A</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="for-property-info">
                                                        <h4>Property Value</h4>
                                                        <li>Amount invested <span class="pull-right">N/A</span>
                                                        </li>
                                                        <li>Transactional Cost <span class="pull-right">N/A</span>
                                                        </li>
                                                        <li>Capital Allocated <span class="pull-right">N/A</span>
                                                        </li>
                                                    </div>
                                                    <div class="for-property-info">
                                                        <h4>Property Expenses &amp; Fees</h4>
                                                        <li>Advisory Fees <span class="pull-right">N/A</span>
                                                        </li>
                                                        <li>Property Management Fees <span
                                                                class="pull-right">N/A</span>
                                                        </li>
                                                        <li>Maintenance Fees <span class="pull-right">N/A</span>
                                                        </li>
                                                        <li>Construction/ Renovation <span
                                                                class="pull-right">N/A</span>
                                                        </li>
                                                        <li>Other Expenses <span class="pull-right">N/A</span>
                                                        </li>
                                                    </div>
                                                    <div class="for-property-info">
                                                        <h4>Dividends - (Applicable for Rentals)
                                                        </h4>
                                                        <li>Rent Amount<span class="pull-right">N/A</span>
                                                        </li>
                                                        <li>Gross Yield % <span class="pull-right">N/A</span>
                                                        </li>
                                                        <li>Net Yield %<span class="pull-right">N/A</span>
                                                        </li>
                                                        <li>Net Return <span class="pull-right">N/A</span>
                                                        </li>
                                                    </div>
                                                    <div class="for-property-info">
                                                        <h4>Sale Returns - (Applicable to
                                                            Selling Events)</h4>
                                                        <li>Expected ROI <span class="pull-right">N/A</span>
                                                        </li>
                                                        <li>Actual ROI <span class="pull-right">N/A</span>
                                                        </li>
                                                        <li>Sales Proceeds <span class="pull-right">N/A</span>
                                                        </li>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-2 col-12"></div>
                                                <div class="col-md-5 col-sm-5 col-12">
                                                    <div class="equit-amount-heading text-center">
                                                        <h4>DEBT</h4>
                                                    </div>
                                                    <div class="for-report-type">

                                                        <ul>
                                                            <li>Report Type <span class="pull-right">N/A</span>
                                                            </li>
                                                            <li>Period<span class="pull-right">N/A</span>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="for-property-info">
                                                        <ul>
                                                            <h4>Investment Info</h4>
                                                            <li>Amount invested <span class="pull-right">N/A</span>
                                                            </li>
                                                            <li>Transactional Cost <span
                                                                    class="pull-right">N/A</span>
                                                            </li>
                                                            <li>Capital Allocated <span
                                                                    class="pull-right">N/A</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="for-property-info">
                                                        <h4>Lending info</h4>
                                                        <li>Lending Type <span class="pull-right">N/A</span>
                                                        </li>
                                                        <li>Murabaha Rate <span class="pull-right">N/A</span>
                                                        </li>
                                                        <li>Amount Borrowed <span class="pull-right">N/A</span>
                                                        </li>
                                                    </div>
                                                    <div class="for-property-info">
                                                        <h4>Installments</h4>
                                                        <ul>
                                                            <li>Installments Received <span
                                                                    class="pull-right">N/A</span>
                                                            </li>
                                                            <li>Next Installment Expected<span
                                                                    class="pull-right">N/A</span>
                                                            </li>
                                                            <li>Amount Expected <span class="pull-right">N/A</span>
                                                            </li>
                                                            <li>Remaining Balance <span
                                                                    class="pull-right">N/A</span>
                                                            </li>
                                                            <li>Installments Received</li>
                                                        </ul>
                                                    </div>
                                                    <div class="for-property-info">
                                                        <h4>Returns</h4>

                                                        <li>ROI % <span class="pull-right">N/A</span>
                                                        </li>
                                                        <li>Net Return (SAR) <span class="pull-right">N/A</span>
                                                        </li>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src=" https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js "
        integrity=" sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns "
        crossorigin=" anonymous "></script>
</body>

</html>
