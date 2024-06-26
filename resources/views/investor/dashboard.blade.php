@extends('layouts.investor.investor')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | {{ __('nav.Dashboard') }}</title>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="dash_sec">
            <div class="d-flex flex-column-fluid">
                <div class="container-fluid">
                    <div class="row mb-5">
                        <div class=" col-lg-4 col-md-12 col-sm-12 col-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="das_1">
                                        <h1>{{ __('dashboard.Dashboard View') }}</h1>
                                    </div>
                                    <div class="for_mbs_12">
                                        <div class="ew_balance for_os ">
                                            <div class="eww_b1">
                                                <h6>{{ __('dashboard.Wallet Balance') }}</h6>
                                                <p>{{ getUserWallet(auth()->user()->id) }} <sup
                                                        class="sar">SAR</sup></p>
                                                <a href="#" class="pull-right"><img
                                                        src="{{ asset('images/investor/arrow-right.png') }}" alt=""
                                                        class="img-fluid"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">--}}
                                {{--                                    <div class="for_mbs_13 ">--}}
                                {{--                                        <div class="ew_balance">--}}
                                {{--                                            <div class="eww_b1">--}}
                                {{--                                                <h6>{{ __('dashboard.DEBT Wallet Balance') }}</h6>--}}
                                {{--                                                <p>{{ getUserDebitWallet(auth()->user()->id) }} <sup--}}
                                {{--                                                        class="sar">SAR</sup></p>--}}
                                {{--                                                <a href="#" class="pull-right"><img--}}
                                {{--                                                        src="{{ asset('images/investor/arrow-right.png') }}" alt=""--}}
                                {{--                                                        class="img-fluid"></a>--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                        <div class=" col-lg-8 col-md-12 col-sm-12 col-12">
                            <div class="total-months-parent">
                                <div class="row vertical-alignment">
                                    <div class="col-md-7 col-sm-6 col-12">
                                        <div class="total-investments-content">
                                            <h3>{{ __('dashboard.Total Net Worth of All Investments') }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-6 col-12">
                                        <div class="months-select">
                                            <select name="month" id="month">
                                                <option value="6">{{ __('dashboard.Last 6 months') }}</option>
                                                <option value="5">{{ __('dashboard.Last 5 months') }}</option>
                                                <option value="4">{{ __('dashboard.Last 4 months') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body chart-body">
                                <div class="mixed-widget-7-chart card-rounded-bottom"></div>
                                <!--end::Chart-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <div class="Equity_debt_sec">
                    <div class="d-flex flex-column-fluid">
                        <div class="container-fluid">
                            <div class="bx_shw">
                                <div class="row ">
                                    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-12">
                                        <div class="divider-main">
                                            <div class="for_equit_left_right">
                                                <h2>{{ __('dashboard.EQUITY') }}</h2>
                                                <p><strong class="wallet_iban">{{ __('dashboard.Wallet IBAN') }}:</strong>
                                                    SA723876328761000000288</p>
                                            </div>
                                            <div class="for_rsp_setups">
                                                <div class="row mb-4">
                                                    <div class="col-md-3 col-sm-3 col-12">
                                                        <div class="dividens_1 ">
                                                            <div class="dividends_hp">
                                                                <h6>{{ __('dashboard.Deposits') }}</h6>
                                                                <p>{{ number_format(totalDeposits(auth()->user()->id)) }}<sup class="sar1">SAR</sup></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-12">
                                                        <div class="dividens_1 ">
                                                            <div class="dividends_hp">
                                                                <h6>{{ __('dashboard.No Of Invesments') }}</h6>
                                                                <p>{{ totalNoOfInvestments(auth()->user()->id) }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-12">
                                                        <div class="dividens_1 ">
                                                            <div class="dividends_hp">
                                                                <h6>{{ __('dashboard.Total Invested') }}</h6>
                                                                <p>{{ number_format(getUserInvestments(auth()->user()->id)) }}<sup class="sar1">SAR</sup></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-12">
                                                        <div class="dividens_1 ">
                                                            <div class="dividends_hp">
                                                                <h6>{{ __('dashboard.Dividends') }}</h6>
                                                                <p>{{ number_format(totalDividends(auth()->user()->id)) }}<sup class="sar1">SAR</sup></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-md-3 col-sm-3 col-12">
                                                        <div class="dividens_1 ">
                                                            <div class="dividends_hp">
                                                                <h6>{{ __('dashboard.Profit on Sale') }}</h6>
                                                                <p>{{ number_format(totalProfit(auth()->user()->id)) }}<sup class="sar1">SAR</sup></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-12">
                                                        <div class="dividens_1 ">
                                                            <div class="dividends_hp">
                                                                <h6>{{ __('dashboard.Unrealized Returns') }}</h6>
                                                                <p>{{ number_format(totalUnrealizedReturns(auth()->user()->id)) }}<sup class="sar1">SAR</sup></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-12">
                                                        <div class="dividens_1 ">
                                                            <div class="dividends_hp">
                                                                <h6>{{ __('dashboard.Realized Returns') }}</h6>
                                                                <p>{{ number_format(totalRealizedReturns(auth()->user()->id)) }}<sup class="sar1">SAR</sup></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-12">
                                                        <div class="dividens_1 ">
                                                            <div class="dividends_hp">
                                                                <h6>{{ __('dashboard.Average Annual Return (%)') }}</h6>
                                                                <p>{{ annualizedROI(auth()->user()->id) }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
{{--                                                <div class="rtl_dtr ">--}}
{{--                                                    <p>{{ __('dashboard.Max Investment per deal') }}: 0 SAR <span--}}
{{--                                                            class="am-100">{{ __('dashboard.Annual Maximum') }}: 0 SAR</span>--}}
{{--                                                    </p>--}}

{{--                                                </div>--}}
                                            </div>
                                        </div>
                                    </div>
{{--                                    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-12">--}}
{{--                                        <div class="divider-main">--}}
{{--                                            <div class="for_equit_left_right ">--}}
{{--                                                <h2>{{ __('dashboard.DEBT') }}</h2>--}}
{{--                                                <p><strong class="wallet_iban">{{ __('dashboard.Wallet IBAN') }}:</strong>--}}
{{--                                                    SA723876328761000000288</p>--}}
{{--                                            </div>--}}
{{--                                            <div class="for_rsp_setups">--}}
{{--                                                <div class="row mb-4">--}}
{{--                                                    <div class="col-md-4 col-sm-4 col-12">--}}
{{--                                                        <div class="dividens_1 ">--}}
{{--                                                            <div class="dividends_hp">--}}
{{--                                                                <h6>{{ __('dashboard.Total Invested') }}</h6>--}}
{{--                                                                <p>0 K<sup class="sar1">SAR</sup></p>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-md-4 col-sm-4 col-12">--}}
{{--                                                        <div class="dividens_1 ">--}}
{{--                                                            <div class="dividends_hp">--}}
{{--                                                                <h6>{{ __('dashboard.Number Of Investment') }}</h6>--}}
{{--                                                                <p>0 K<sup class="sar1">SAR</sup></p>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-md-4 col-sm-4 col-12">--}}
{{--                                                        <div class="dividens_1 ">--}}
{{--                                                            <div class="dividends_hp">--}}
{{--                                                                <h6>{{ __('dashboard.Average Annual Return (%)') }}</h6>--}}
{{--                                                                <p>0 %</p>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="row mb-4">--}}
{{--                                                    <div class="col-md-4 col-sm-4 col-12">--}}
{{--                                                        <div class="dividens_1 ">--}}
{{--                                                            <div class="dividends_hp">--}}
{{--                                                                <h6>{{ __('dashboard.Unrealized Returns') }}</h6>--}}
{{--                                                                <p>0 K<sup class="sar1">SAR</sup></p>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-md-4 col-sm-4 col-12">--}}
{{--                                                        <div class="dividens_1 ">--}}
{{--                                                            <div class="dividends_hp">--}}
{{--                                                                <h6>{{ __('dashboard.Realized Returns') }}</h6>--}}
{{--                                                                <p>0 K<sup class="sar1">SAR</sup></p>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-md-4 col-sm-4 col-12">--}}
{{--                                                        <div class="dividens_1 ">--}}
{{--                                                            <div class="dividends_hp">--}}
{{--                                                                <h6>{{ __('dashboard.Withdrawals') }}</h6>--}}
{{--                                                                <p>0 K<sup class="sar1">SAR</sup></p>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="rtl_dtr ">--}}
{{--                                                    <p>{{ __('dashboard.Max Investment per deal') }}: 0 SAR <span--}}
{{--                                                            class="am-100">{{ __('dashboard.Annual Maximum') }}: 0 SAR</span>--}}
{{--                                                    </p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        <div class="pc_gy">
            <div class="container-fluid">
                <div class="row df_aic">
                    <!-- <div class="col-lg-6 col-md-8 col-sm-12 col-12"> -->
                    <!-- <div class="row df_aic"> -->
                    <div class="col-md-4 col-sm-4 col-12">
                        <div class="ic_btu">
                            <a href="#"><img src="{{ asset('images/investor/briefcase.png') }}" alt=""
                                             class="img-fluid">
                                <span class="r_act">
                                    <p class="dct"> {{ __('dashboard.Recent Activity') }}</p>
                                </span></a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        {{--                        <div class="for_tabs_1 pull-right">--}}
                        {{--                            <ul class="nav nav-tabs" role="tablist">--}}
                        {{--                                <li class="nav-item">--}}
                        {{--                                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">{{ __('dashboard.View all') }}--}}
                        {{--                                    </a>--}}
                        {{--                                </li>--}}

                        {{--                            </ul>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="col-md-4 col-sm-4 col-12">
                        <div class="capital-heading">
                            <div class="for dtl_dispatch">
                                <h3>{{ __('dashboard.Capital Allocation') }}
                                                                    <a href="{{ route('investor.my-portfolio') }}" class="ijk_muy">{{ __('dashboard.Show All List') }}</a>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!-- </div> -->
                    <!-- </div> -->
                </div>
            </div>
        </div>
        <div class="q2_view">
            <div class="container-fluid">
                <div class="tab-content">
                    <div class="tab-pane active" id="tabs-1" role="tabpanel">
                        <div class="row">
                            <div class="col-xxl-8 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                                @if(count($activities) > 0)
                                    @foreach($activities as $activity)
                                        <div class="progress-content">
                                            <div class="row mb-3">
                                                <div class="col-md-4 col-sm-4 col-12">
                                                    <div class="forq2_pic">
                                                        <img
                                                            src="{{ asset('project-visual-uploads'.'/'. (!is_null($activity->project) ? $activity->project->projectImages[0]->filename : 'dummy.png')) }}"
                                                            alt="" class="img-fluid">
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-sm-8 col-12">
                                                    <div class="row for_jfc mb-2">
                                                        <div class="col-md-6 col-sm-6 col-12 r_pzero">
                                                            <div class="cm_e d-flex">
                                                                <h2>{{ $activity->title }} </h2>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 col-12 r_pzero">
                                                            <div class="redux_ok1">
                                                                @if($activity->type == 'share_purchased')
                                                                    <a href="{{ route('investor.projects.detail',$activity->project->id) }}"
                                                                       class="btn-3278">{{ __('dashboard.View') }}</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-md-6 col-sm-6 col-12 p-0">
                                                            <div class="rj_1">
                                                                <h4>{{ App::getLocale() == 'en' ? (!is_null($activity->project) ? $activity->project->project_name_en : '') : (!is_null($activity->project) ? $activity->project->project_name_ar : '') }}</h4>
                                                                <p>{{ __('dashboard.Update') }}
                                                                    : {{ date('d M Y', strtotime($activity->created_at)) }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="text-center">
                                        <a href="" class="dashboard-save">{{ __('dashboard.View all') }}</a>
                                    </div>
                                @else
                                    <div class="progress-content">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <p>No Recent Activities</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                            <div class="col-lg-12 col-xl-4 col-xxl-4 col-md-12 col-sm-12 col-12">
                                @if(!empty($values))
                                <div class="pie_set">

                                    <ul class="resedential-list">
                                        {{--                                        <h4>{{ __('dashboard.Residential') }}</h4>--}}
                                        {{--                                        <li><i class="fa fa-circle" aria-hidden="true"></i>2500$ (15%)</li>--}}
                                    </ul>
                                    <!-- for pie chart -->
                                    <div class="position-relative">
                                        <div class="oi_k">
                                            <h4>{{ number_format_short(getUserInvestments(auth()->user()->id)) }}</h4>
                                        </div>
                                        <canvas id="graph-1">

                                        </canvas>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        @foreach($capital_allocation as $key => $capital)
                                            <div class="col-md-6 col-sm-6 col-6 r_pzero">
                                                <ul class="canvas-list ">
                                                    <li><img src="{{ asset('images/investor/Color-Sign.png') }}" alt=""
                                                             class="img-fluid"> {{ $key }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-6">
                                                <ul class="canvas-list1 ">
                                                    <li>{{ number_format($capital) }}</li>
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @else
                                    <div class="pie_set">
                                        No Capital Allocation
                                    </div>
                                @endif

                                <!-- for pie chart -->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tabs-2" role="tabpanel">

                        <div class="row">
                            <div class="col-xxl-8 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="progress-content">
                                    <div class="row mb-3">
                                        <div class="col-md-4 col-sm-4 col-12">
                                            <div class="forq2_pic">
                                                <img src="{{ asset('images/investor/pfd.png') }}" alt=""
                                                     class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-12">
                                            <div class="row for_jfc mb-2">
                                                <div class="col-md-6 col-sm-6 col-12 r_pzero">
                                                    <div class="cm_e d-flex">
                                                        <h2>{{ __('dashboard.Dividend Received') }}</h2>

                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-12 r_pzero">
                                                    <div class="redux_ok">
                                                        <a href="#" class="deadline-btn">{{ __('dashboard.Deadline') }}
                                                            10 Nov 2019</a>
                                                        <a href="#" class="btn-3278">{{ __('dashboard.View') }}</a>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-6 col-sm-6 col-12 p-0">
                                                    <div class="rj_1">
                                                        <h4>Modern Villas</h4>
                                                        <p>{{ __('dashboard.Update') }}: 20 Nov 2021</p>
                                                    </div>

                                                </div>
                                                <div class="col-md-6 col-sm-6 col-12">
                                                    <div class="trg_1">
                                                        <a href=""><img
                                                                src="{{ asset('images/investor/Group-1301.png') }}"
                                                                alt=""
                                                                class="img-fluid"><span>6</span></a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress-content">
                                    <div class="row mb-3">
                                        <div class="col-md-4 col-sm-4 col-12">
                                            <div class="forq2_pic">
                                                <img src="{{ asset('images/investor/pxd.png') }}" alt=""
                                                     class="img-fluid">
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-sm-8 col-12">
                                            <div class="row for_jfc mb-2">
                                                <div class="col-md-6 col-sm-6 col-12 r_pzero">
                                                    <div class="cm_e d-flex">
                                                        <h2>{{ __('dashboard.Vote Campaign') }} </h2>

                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-12 r_pzero">
                                                    <div class="redux_ok">
                                                        <a href="#" class="deadline-btn">{{ __('dashboard.Deadline') }}
                                                            10 Nov 2019</a>
                                                        <a href="#" class="btn-3278">{{ __('dashboard.View') }}</a>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-6 col-sm-6 col-12 p-0">
                                                    <div class="rj_1">
                                                        <h4>AM Condominiums</h4>
                                                        <p>{{ __('dashboard.Update') }}: 20 Nov 2021</p>
                                                    </div>

                                                </div>
                                                <div class="col-md-6 col-sm-6 col-12">
                                                    <div class="trg_1">
                                                        <a href=""><img
                                                                src="{{ asset('images/investor/Group-1301.png') }}"
                                                                alt=""
                                                                class="img-fluid"><span>12</span></a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-12 col-xl-4 col-xxl-4 col-md-12 col-sm-12 col-12">

                                <div class="pie_set">

                                    <ul class="resedential-list">
                                        <h4>{{ __('dashboard.Residential') }}</h4>
                                        <li><i class="fa fa-circle" aria-hidden="true"></i>2500$ (15%)</li>
                                    </ul>
                                    <!-- for pie chart -->
                                    <div class="oi_k">
                                        <h4>246K</h4>
                                    </div>
                                    <canvas id="graph-2">

                                    </canvas>
                                    <hr>

                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-6 r_pzero">
                                            <ul class="canvas-list ">
                                                <li><img src="{{ asset('images/investor/Color-Sign.png') }}" alt=""
                                                         class="img-fluid"> {{ __('dashboard.Residential Buildings') }}
                                                </li>
                                                <li><img src="{{ asset('images/investor/Color-Sign.png') }}" alt=""
                                                         class="img-fluid">{{ __('dashboard.Retail') }}</li>
                                                <li><img src="{{ asset('images/investor/Color-Sign.png') }}" alt=""
                                                         class="img-fluid">{{ __('dashboard.Commercial Buildings') }}
                                                </li>
                                                <li><img src="{{ asset('images/investor/Color-Sign.png') }}" alt=""
                                                         class="img-fluid">{{ __('dashboard.Multi Family Houses') }}
                                                </li>
                                                <li><img src="{{ asset('images/investor/Color-Sign.png') }}" alt=""
                                                         class="img-fluid">{{ __('dashboard.Villas') }}</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-6">
                                            <ul class="canvas-list1 ">
                                                <li>29,193</li>
                                                <li>18,832</li>
                                                <li>19,758</li>
                                                <li>23,078</li>
                                                <li>29,193</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- for pie chart -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>

        $('#month').on('change', function (e) {
            var month = $('#month').val();
            window.location.href = "{{ url('investor/home') }}"+'/'+month;
            {{--$.ajaxSetup({--}}
            {{--    headers: {--}}
            {{--        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')--}}
            {{--    }--}}
            {{--});--}}
            {{--$.ajax({--}}
            {{--    url: "{{ route('investor.home.chart') }}",--}}
            {{--    method: 'post',--}}
            {{--    data: {--}}
            {{--        month: month,--}}
            {{--    },--}}
            {{--    success: function (result) {--}}
            {{--        $('#to').empty();--}}
            {{--        $('#to').append(result.data);--}}
            {{--    }--}}
            {{--});--}}
        });


        var chartOptions = {
            chart: {
                height: 280,
                type: "area"
            },
            dataLabels: {
                enabled: false
            },
            series: [{
                name: "Dividends",
                data: [{{ $dividends_total }}]
            }, {
                name: "Account Value",
                data: [{{ $acc_valuation_total }}]
            }, {
                name: "Deposits",
                data: [0,0,0,0,0,0]
            }, {
                name: "Withdrawals",
                data: [{{ $withdrawl_total }}]
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
                categories: [{!! $month_format !!}]
            }
        };

        var e = document.querySelectorAll(".mixed-widget-7-chart");
        [].slice.call(e).map(function (e) {
            if (e) {
                new ApexCharts(e, chartOptions).render();
            }
        });

        var ctx = document.getElementById('graph-1').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'doughnut',
            // The data for our dataset
            data: {
                // labels: ["Investors", "Fund raising", "Beslutningstager", "Brugerorienteret leder"],
                datasets: [{
                    label: "Din ledelsesstil",
                    backgroundColor: [
                        "#1ACEB3", "#F1C50F"
                    ],
                    data: [{{ $values }}],
                }]
            },

            // Configuration options go here
            options: {
                legend: {
                    display: false,
                },
                tooltips: {
                    enabled: true,
                    mode: 'index',
                    callbacks: {
                        label: function (tooltipItems, data) {
                            var i, label = [],
                                l = data.datasets.length;
                            for (i = 0; i < l; i += 1) {
                                label[i] = data.datasets[i].label + ': ' + data.datasets[i].data[tooltipItems.index] + '%';
                            }
                            return label;
                        }
                    }
                }
            }
        });

    </script>
@endsection
