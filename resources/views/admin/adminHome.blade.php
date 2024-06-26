@extends('layouts.investor.investor')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | {{ __('nav.Dashboard') }}</title>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="dash_sec">
            <div class="d-flex flex-column-fluid">

                <div class="container">
                    <div class="das_1">
                        <h1>Dashboard View</h1>
                    </div>
                    <div class="row mb-5">

                        <div class=" col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="row">
                                <div class="col-lg-4 col-md-12 col-sm-12 col-12">

                                    <div class="for_mbs_12 for_famio">
                                        <div class="ew_balance for_os">
                                            <div class="eww_b1">
                                                <h6>No. of Investors</h6>
                                                <p>{{ $data['investors'] }}</p>
{{--                                                <a href="#" class="pull-right"><img--}}
{{--                                                        src="{{asset('images/investor/arrow-right.png')}}" alt=""--}}
{{--                                                        class="img-fluid"></a>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                                    <div class="for_mbs_13 for_famio">
                                        <div class="ew_balance ">
                                            <div class="eww_b1">
                                                <h6>Investments to Date</h6>
                                                <p>{{ number_format($data['total_investments'][0]['total_amount']) }}
                                                    <sup class="sar">SAR</sup></p>
{{--                                                <a href="#" class="pull-right"><img--}}
{{--                                                        src="{{asset('images/investor/arrow-right.png')}}" alt=""--}}
{{--                                                        class="img-fluid"></a>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                                    <div class="for_mbs_13 for_famio">
                                        <div class="ew_balance">
                                            <div class="eww_b1">
                                                <h6>Total Amount Raised</h6>
                                                <p>{{ number_format($data['total_investments'][0]['total_amount']) }}
                                                    <sup class="sar">SAR</sup></p>
{{--                                                <a href="#" class="pull-right"><img--}}
{{--                                                        src="{{asset('images/investor/arrow-right.png')}}" alt=""--}}
{{--                                                        class="img-fluid"></a>--}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class=" col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card-body chart-body">
                                <div class="mixed-widget-7-chart card-rounded-bottom"></div>
                                <!--end::Chart-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pc_gy">
            <div class="container">
                <div class="row df_aic">
                    <!-- <div class="col-lg-6 col-md-8 col-sm-12 col-12"> -->
                    <!-- <div class="row df_aic"> -->
                    <div class="col-md-4 col-sm-4 col-12">
                        <div class="ic_btu">
                            <p class="dct"> Recent Activity</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="for_paginations">
                            <!-- <a href="" class="double_buy_dashboard">Active Project</a>
                            <a href="" class="double1_buy_dashboard">View all</a> -->
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4 col-12"></div>
                    <!-- </div> -->
                    <!-- </div> -->
                </div>
            </div>
        </div>
        <div class="q2_view">
            <div class="container">
                <div class="row">
                    @foreach($data['activities'] as $activity)
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="progress-content">
                                <div class="row mb-3">
                                    <div class="col-md-3 col-sm-3 col-12">
                                        <div class="forq_pic">
                                            <img
                                                src="{{ asset('project-visual-uploads'.'/'. (!is_null($activity->project) ? $activity->project->projectImages[0]->filename : 'dummy.png')) }}"
                                                alt="" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-md-9 col-sm-9 col-12">
                                        <div class="row for_jfc mb-2">
                                            <div class="col-md-6 col-sm-6 col-12 r_pzero">

                                                <div class="cm_1 d-flex">
                                                    <h2>{{ $activity->title }} </h2>

                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-12 r_pzero">
{{--                                                <div class="redux_ok1">--}}
{{--                                                    <a href="{{ route('admin.projects') }}" class="btn-3278">View</a>--}}
{{--                                                </div>--}}
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="rj_1">
                                                    <p>Update: {{ $activity->created_at->diffForHumans() }}</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        var chartOptions = {
            chart: {
                height: 280,
                type: "area"
            },
            dataLabels: {
                enabled: false
            },
            series: [{
                name: "Number Of Investors",
                data: [{{ $investor_total }}]
            }, {
                name: "Amount Raised",
                data: [{{ $amount_total }}]
            }, {
                name: "Number Of Projects",
                data: [{{ $project_total }}]
            }, {
                name: "Withdrawals",
                {{--data: [{{ rtrim($withdrawl_total, ",") }}]--}}
                data: [{{ $graph_total }}]
            }],
            colors: ['#3DAB98', '#707070', '#000000', '#708070'],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100]
                }
            },
            xaxis: {
                categories: [{!! $date_format !!}]
            }
        };

        var e = document.querySelectorAll(".mixed-widget-7-chart");
        [].slice.call(e).map(function (e) {
            if (e) {
                new ApexCharts(e, chartOptions).render();
            }
        });
    </script>
@endsection
