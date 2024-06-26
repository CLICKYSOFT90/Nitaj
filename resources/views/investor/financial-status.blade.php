@extends('layouts.app')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Financial Status</title>
@endsection
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <section class="invest_growth invs-signup-3">
        <form action="{{ route('financial-status') }}" method="post" id="form">
            @csrf
            <div class="container">
                <div class="row">
                    <!-- <div class="col-md-2 col-sm-2 col-12"></div> -->
                    <div class="col-md-12 col-sm-12 col-12">
                        <!--multisteps-form-->
                        <div class="multisteps-form">
                            <!--progress bar-->
                            <div class="row">
                                <div class="col-md-1 col-sm-0 col-12"></div>
                                <div class="col-md-10 col-sm-0 col-12">
                                    <div class="multisteps-form__progress">
                                        <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">
                                            <span>{{ __('auth.id_verification') }}</span></button>
                                        <button class="multisteps-form__progress-btn js-active" type="button" title="Address"><span>{{ __('auth.national_address_verification') }}</span></button>
                                        <button class="multisteps-form__progress-btn js-active" type="button" title="Order Info"><span>{{ __('auth.general_info') }}</span></button>
                                        <button class="multisteps-form__progress-btn js-active" type="button" title="Order Info"><span>{{ __('auth.financial_status') }}</span></button>
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-0 col-12"></div>

                            </div>
                        </div>
                        <!--form panels-->
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-12"></div>
                            <div class="col-md-8 col-sm-8  col-12">
                                <form class="multisteps-form__form">
                                    <!--single1 form panel-->
                                    <div class="invs_hdr ">
                                        <h2 class="text-left">{{ __('auth.financial_status') }}</h2>
                                    </div>
                                    <div class="firm_sec">
                                        <form action="">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-12">
                                                    <div class="select-fields">
                                                        <label for="worked_in_financial_sector">{{ __('auth.approx_net_worth') }}</label>
                                                        <select class="@error('net_worth') is-invalid @enderror" required name="net_worth" id="net_worth">
                                                            <option value="" selected disabled> {{ __('auth.select_approx_net_worth') }}</option>
                                                            <option value="More than 5 Million SR">{{ __('auth.more_than_5mil') }}</option>
                                                            <option value="Less than 5 Million SR">{{ __('auth.less_than_5mil') }}</option>
                                                        </select>
                                                        @error('net_worth')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="col-md-6 col-sm-6 col-12">
                                                    <div class="select-fields">
                                                        <label for="worked_in_financial_sector">{{ __('auth.invest_obj') }}</label>
                                                        <select class="@error('invest_obj') is-invalid @enderror" required name="invest_obj" id="invest_obj">
                                                            <option value="" selected disabled>{{ __('auth.select_invest_obj') }}</option>
                                                            <option value="Income">{{ __('auth.income') }}</option>
                                                            <option value="Growth">{{ __('auth.growth') }}</option>
                                                            <option value="Balanced portfolio">{{ __('auth.blc_portfolio') }}</option>
                                                        </select>
                                                        @error('invest_obj')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-12">
                                                    <div class="select-fields">
                                                        <label for="worked_in_financial_sector">{{ __('auth.curr_invest_in') }}</label>
                                                        <select class="curr-invested-multiple @error('curr_invested') is-invalid @enderror" name="curr_invested[]" id="curr_invested" multiple="multiple">
                                                            <option value="Real Estate">{{ __('auth.real_estate') }}</option>
                                                            <option value="Capital Market">{{ __('auth.cap_market') }}</option>
                                                            <option value="Private Equity">{{ __('auth.private_policy') }}</option>
                                                            <option value="Other">{{ __('auth.other') }}</option>
                                                        </select>
                                                        @error('curr_invested')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-12">
                                                    <div class="select-fields">
                                                        <label for="worked_in_financial_sector">{{ __('auth.approx_annual_income') }}</label>
                                                        <select class="@error('annual_income') is-invalid @enderror" required name="annual_income" id="annual_income">
                                                            <option value="" selected disabled> {{ __('auth.select_approx_annual_income') }}</option>
                                                            <option value="Less than 50,000"> {{ __('auth.less_50000') }}</option>
                                                            <option value="50,000 - 100,000">{{ __('auth.less_50000_100000') }}</option>
                                                            <option value="100,001 - 200,000">{{ __('auth.100001_200000') }}</option>
                                                            <option value="200,001 - 500,000">{{ __('auth.200001_500000') }}</option>
                                                            <option value="500,001 - 1,000,000">{{ __('auth.500001_1000000') }}</option>
                                                            <option value="1,000,000 +">{{ __('auth.1000000+') }}</option>
                                                        </select>
                                                        @error('annual_income')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-md-8 col-sm-12 col-12">
                                        <div class="select-fields">
                                            <label for="worked_in_financial_sector">{{ __('auth.amount_expexted_invest') }}</label>
                                            <select class="@error('expected_invest_oppornity') is-invalid @enderror" required name="expected_invest_oppornity" id="expected_invest_oppornity">
                                                <option value="" selected disabled> {{ __('auth.select_amount_expexted_invest') }}</option>
                                                <option value="1000-100,000">{{ __('auth.1000_100000') }}</option>
                                                <option value="100,000-1,000,000">{{ __('auth.100000_1000000') }}</option>
                                                <option value="1,000,000- 5,000,000">{{ __('auth.1000000_5000000') }}</option>
                                                <option value="5,000,000 +">{{ __('auth.5000000+') }}</option>
                                            </select>
                                            @error('expected_invest_oppornity')
                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                        <div class="select-fields">
                                            <label for="worked_in_financial_sector">{{ __('auth.expected_amount_invest_annually') }}</label>
                                            <select class="@error('expected_amount_annually') is-invalid @enderror" required name="expected_amount_annually" id="expected_amount_annually">
                                                <option value="" selected disabled> {{ __('auth.selected_expected_amount_invest_annually') }}</option>
                                                <option value="1000-10,000">{{ __('auth.1000_10000') }}</option>
                                                <option value="10,000-50,000">{{ __('auth.10000_50000') }}</option>
                                                <option value="50,000-100,000">{{ __('auth.50000_100000') }}</option>
                                                <option value="100,000-500,000">{{ __('auth.100000_500000') }}</option>
                                                <option value="500,000-1000,000">{{ __('auth.500000_1000000') }}</option>
                                                <option value="1000,000+">{{ __('auth.1000000+') }}</option>
                                            </select>
                                            @error('expected_amount_annually')
                                            <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-12"></div>
                        </div>
                    </div>
                </div>
                <div class="fix-positioned">
                    <div class="row ">
                        <div class="col-md-6 col-sm-6 col-12">
                            <div class="back-1">
                                <a class="btn-16 js-btn-prev"
                                   href="{{ route('general-info') }}">{{ __('auth.back') }}</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-12">
                            <div class="next-1 text-center">
                                <input type="submit" class="btn btn-17" value="{{ __('auth.finish') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function(){
            $('#form').validate({
                rules:{
                    net_worth: {
                        required: true
                    },
                    invest_obj: {
                        required: true
                    },
                    "curr_invested[]": "required",
                    annual_income: {
                        required: true
                    },
                    expected_invest_oppornity: {
                        required: true
                    },
                    expected_amount_annually: {
                        required: true
                    }
                },
                messages: {
                    net_worth: {
                        required: '{{ __('auth.required') }}'
                    },
                    invest_obj: {
                        required: '{{ __('auth.required') }}'
                    },
                    curr_invested: {
                        required: '{{ __('auth.required') }}'
                    },
                    annual_income: {
                        required: '{{ __('auth.required') }}'
                    },
                    expected_invest_oppornity: {
                        required: '{{ __('auth.required') }}'
                    },
                    expected_amount_annually: {
                        required: '{{ __('auth.required') }}'
                    }
                },
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.insertBefore(element);
                    }
                }
            });
            $('.curr-invested-multiple').select2({
                placeholder: "{{ __('auth.select_curr_invest_in') }}",
            });
        });
    </script>
@endsection
