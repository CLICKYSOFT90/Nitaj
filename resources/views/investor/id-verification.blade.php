@extends('layouts.app')

@section('title')
    <title>{{ config('app.name', 'Laravel') }} | ID Verification</title>
@endsection
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css"/>
@endsection


@section('content')
    <section class="invest_growth invs-signup-3">
        <form action="{{ route('id-verification') }}" method="post" id="form">
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
                                <div class="col-md-10 col-sm-0 col-12 ">
                                    <div class="multisteps-form__progress">
                                        <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">
                                            <span>{{ __('auth.id_verification') }}</span>
                                        </button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Address"><span>{{ __('auth.national_address_verification') }}</span></button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Order Info"><span>{{ __('auth.general_info') }}</span></button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Order Info"><span>{{ __('auth.financial_status') }}</span></button>
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-0 col-12"></div>
                            </div>
                        </div>
                        <!--form panels-->
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-12"></div>
                            <div class="col-md-8 col-sm-8  col-12">
                                    <!--single1 form panel-->
                                    <div class="invs_hdr">
                                        <h2>{{ __('auth.insert_info') }}</h2>
                                    </div>
                                    <div class="firm_sec text-center">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="ikr_inp">
                                                    <input type="text" name="nat_id"
                                                           class="gbr_blck @error('nat_id') is-invalid @enderror {{ session()->has('error') ? 'is-invalid' : '' }}"
                                                           placeholder="{{ __('auth.national_id') }} *" value="{{ old('nat_id') }}" required>
                                                    @error('nat_id')
                                                    <span class="invalid-feedback form-error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="ikr_inp">
                                                    <input type="text" name="dob"
                                                           class="for_grb @error('dob') is-invalid @enderror {{ session()->has('error') ? 'is-invalid' : '' }}"
                                                           placeholder="{{ __('auth.dob') }}" value="{{ old('dob') }}" required id="datepicker">
                                                    @error('dob')
                                                    <span class="invalid-feedback form-error" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
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
                        </div>
                        <div class="col-md-6 col-sm-6 col-12">
                            <div class="next-1 text-center">
                                <input type="submit" class="btn btn-17" value="{{ __('auth.next') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script>
        $(function() {
            $("#datepicker").datepicker({
                dateFormat: 'dd/mm/yy',
            });
        });
        $(document).ready(function(){
            $('#form').validate({
                messages: {
                    nat_id: {
                        required: '{{ __('auth.required') }}'
                    },
                    dob: {
                        required: '{{ __('auth.required') }}'
                    }
                }
            });
        });
    </script>
@endsection
