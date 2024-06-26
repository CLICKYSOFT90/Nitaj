@extends('layouts.app')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | National Address Verification</title>
@endsection

@section('content')
    <section class="invest_growth invs-signup-3">
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
                                            <span>{{ __('auth.id_verification') }}</span></button>
                                        <button class="multisteps-form__progress-btn js-active" type="button" title="Address"><span>{{ __('auth.national_address_verification') }}</span></button>
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
                                <div class="invs_hdr ">
                                    <h2 class="text-left">IDENTITY INFO</h2>
                                </div>
                                <div class="firm_sec text-center">

                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="ikr_inp">
                                                <input type="text" class="gbr_blck" value="{{ $data->first_name }}" readonly placeholder="First Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="ikr_inp">
                                                <input type="text" class="for_grb" value="{{ $data->id_expire }}" readonly placeholder="ID Expiry Date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="ikr_inp">
                                                <input type="text" class="gbr_blck" value="{{ $data->second_name }}" readonly placeholder="Second Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="ikr_inp">
                                                <input type="text" class="for_grb" value="{{ $data->gender }}" readonly placeholder="Gender">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="ikr_inp">
                                                <input type="text" class="gbr_blck" value="{{ $data->third_name }}" readonly placeholder="Third Name">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="ikr_inp">
                                                <input type="text" class="gbr_blck" value="{{ $data->last_name }}" readonly placeholder="Last Name">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="invs_hdr">
                                    <h2 class="text-left">ADDRESS</h2>
                                </div>
                                <div class="firm_sec text-center">

                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="ikr_inp">
                                                <input type="text" class="gbr_blck" value="{{ $data->unit_address }}" readonly placeholder="Unit Number">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="ikr_inp">
                                                <input type="text" class="for_grb" value="{{ $data->building_number }}" readonly placeholder="Building Number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="ikr_inp">
                                                <input type="text" class="gbr_blck" value="{{ $data->street_name }}" readonly placeholder="Street Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="ikr_inp">
                                                <input type="text" class="for_grb" value="{{ $data->district }}" readonly placeholder="District">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="ikr_inp">
                                                <input type="text" class="gbr_blck" value="{{ $data->city }}" readonly placeholder="City">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="ikr_inp">
                                                <input type="text" class="gbr_blck" value="{{ $data->postal_code }}" readonly placeholder="Postal Code">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="ikr_inp">
                                                <input type="text" class="gbr_blck" value="{{ $data->additional_code }}" readonly placeholder="Additional Code">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="ikr_inp">
                                                <input type="text" class="gbr_blck" value="{{ $data->location }}" readonly placeholder="Location">
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
                            <div class="back-1">
                                <a class="btn-16 js-btn-prev" href="{{ route('id-verification') }}">{{ __('auth.back') }}</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-12">
                            <div class="next-1">
                                <a class="btn-17 status" href="javascript:;">
                                    {{ __('auth.next') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg acc-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="row">
                    <div class="col-md-12 col-sm-12  col-12">
                        <div class="invs_hdr5">
                            <h2>CONGRATS, {{ auth()->user()->fname }} {{ auth()->user()->lname }}</h2>
                            <p class="for_clr5 text-center">YOUR ACCOUNT HAS BEEN CREATED</p>
                            <p>YOU CAN NOW ACCESS THE DASHBOARD AND CONTINUE YOUR APPLICATION AT YOUR CONVENIENCE
                            </p>
                        </div>
                        <div class="modal-footer">
                            <div class="new-main">
                                <div class="new-created text-center">
                                    <a href="{{ route('investor.home') }}" class="btn-098">MY DASHBOARD</a>
                                </div>
                                <div class="new-created">
                                    <a href="{{ route('general-info') }}" class="hov_btn">Continue Application</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered bd-example-modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.status').on('click', function (){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type:'POST',
                url:'{{ route('stepIdVerificationStatus') }}',
                success:function(data) {
                    $('.acc-modal').modal('show');
                }
            });
        });
    </script>
@endsection
