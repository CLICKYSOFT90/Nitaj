@extends('layouts.investor.investor')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Project Detail</title>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="card_slide1">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-12">
                            <div class="oppurtunity-main">
                                <div class="for-top-card">
                                    <img src="{{ asset('project-visual-uploads'.'/'.$project->projectImages[0]->filename) }}" alt="" class="img-fluid">
                                </div>
                                <div class="for-hegt">

                                    <div class="for_sdcer">
                                        <h2>{{ App::getLocale() == 'en' ? $project->project_name_en : $project->project_name_ar }}</h2>
                                        <span class="jed_sa jedd_ah">{{ $project->projectCities->name }}, {{ $project->projectCountry->name }}</span>
                                    </div>
                                    <div class="inf_height">
                                        <div class="row st-h ">
                                            <div class="col-md-6 col-sm-4 col-6">
                                                <div class="it_target_list ">
                                                    <h4>{{ __('projects.Investment Target') }}</h4>
                                                    <p>{{ $project->projectFunding->funding_required }} </p>
                                                </div>
                                                <div class="it_target_list ">
                                                    <h4>{{ __('projects.Projected ROI') }}</h4>
                                                    <p>{{ $project->projectFunding->project_roi }}%</p>
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-4 col-sm-4 col-12 "></div> -->
                                            <div class="col-md-6 col-sm-4 col-6 ">
                                                <div class="it_target_list ">

                                                    <h4>{{ __('projects.Price per Share') }}</h4>
                                                    <p>{{ $project->projectFunding->price_per_share }}</p>

                                                    <h4>{{ __('projects.Minimum Investment') }}</h4>
                                                    <p>{{ $project->projectFunding->min_investment }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 col-sm-8 col-12">
                            <div class="inv_carding1">
                                <div class="hdrr_12">
                                    <h4>{{ __('projects.Investment Info') }}</h4>
                                </div>
                                <div class="fty_twr">
                                    <div class="offer-content">
                                        <h5>{{ __('projects.Offer to invest in') }} {{ App::getLocale() == 'en' ? $project->project_name_en : $project->project_name_ar }}</h5>
                                    </div>
                                    <form id="invest-form">
                                        @csrf
                                        <div class="row fbr_brail">
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="istg_amount fr_pddring">
                                                    <div class="input-options">
                                                        <h6>{{ __('projects.No Of Shares') }}</h6>
                                                        <input type="text" name="no_of_share" id="no_of_share" aria-required="true" onkeyup="convertToShare(this,{{ $project->projectFunding->price_per_share }}, {{ $remaining_shares }})">
                                                        <span id="c-error"></span>
                                                    </div>
                                                    <p class="pixels_int1">{{ __('projects.Share Value') }}: 1 {{ __('projects.Share') }} = {{ $project->projectFunding->price_per_share }} SAR</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="istg_amount">
                                                    <div class="input-options">
                                                        <h6>{{ __('projects.Investment Amount') }}</h6>
                                                        <input type="text" name="invest_amount" id="invest_amount" readonly aria-required="true">
                                                    </div>
                                                    <p class="pixels_int">{{ $project->projectFunding->min_investment }} SR {{ __('projects.minimum investment commitment') }}.
                                                    </p>
                                                    <p class="pixels_int">100% {{ __('projects.of commitment required to close') }}.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-12">
                                                <div class="by_clicking_check">
                                                    <h6>{{ __('projects.By clicking the submit button you are agreeing to the following:') }}</h6>

                                                    <p class="chr_kbx"><input type="checkbox" class="ui_gen" name="i_acknowledge" id="i_acknowledge">
                                                        {{ __('projects.I acknowledge') }}
                                                    </p>
                                                    <p class="chr_kbx"><input type="checkbox" class="ui_gen" name="i_read" id="i_read">{{ __('projects.I have read') }}</p>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 col-sm-6 col-12">
                                                        <div class="cancel_1b">
                                                            <a href="{{ url()->previous() }}" class="btn_uicancel">{{ __('projects.Cancel') }}</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 col-12">
                                                        <div class="spacious_bn text-center ">
{{--                                                            <a href="# " class="inv-btn-4" data-toggle="modal" data-target="#exampleModal">{{ __('projects.INVEST') }}</a>--}}
                                                            <button type="submit" class="inv-btn-4" id="invest-btn">{{ __('projects.INVEST') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal -->
        <div class="modal fade main-modal" id="exampleModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog main-modal-dialog" role="document">
                <div class="modal-content main-modal-content">
                    <div class="modal-body-1 text-center">
                        <h2>Your OTP Sent Press OK</h2>
                        <a href="#" class="ok-modal-btn" data-toggle="modal" data-target="#exampleModal1"
                           data-toggle="modal" data-target="#exampleModal1">OK</a>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade main-modal-2" id="exampleModal1" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog main-modal-dialog-2" role="document">
                <div class="modal-content main-modal-content-2">
                    <form id="otp-verify">
                        <input type="hidden" name="share_id" id="share_id">
                        <div class="modal-body-2 text-center">
                            <h2>Write your OTP</h2>
                            <div class="row d-flex justify-content-center">
                                <div class="otp-main">
                                    <ul>
                                        <li><input type="tel" name="otp1" id="otp1" maxlength="1"></li>
                                        <li><input type="tel" name="otp2" id="otp2" maxlength="1"></li>
                                        <li><input type="tel" name="otp3" id="otp3" maxlength="1"></li>
                                        <li><input type="tel" name="otp4" id="otp4" maxlength="1"></li>
                                    </ul>
                                </div>
                            </div>
                            <span class="c-error"></span>
                            <button type="submit" class="submit-modal-btn" disabled>Submit</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
    function convertToShare(val, share, total_share){
        if(isNaN(val.value)){
            $('#c-error').html('<div class="alert alert-danger">Characters are not allowed.</div>');
            setTimeout(function(){
                $('#c-error').empty();
            }, 1000)
        } else if(val.value > total_share){
            $('#c-error').html('<div class="alert alert-danger">You cannot purchase more than total no of shares.</div>');
            setTimeout(function(){
                $('#c-error').empty();
            }, 3000);
            var remaining_value = val.value;
            $('#no_of_share').val(remaining_value.slice(0,-1));
        } else{
            var total = Math.round(val.value * share);
            $('#invest_amount').val(total.toLocaleString());
        }
    }

        $('#invest-form').validate({
            rules: {
                invest_amount: {
                    required: true,
                },
                i_acknowledge: {
                    required: true,
                },
                i_read: {
                    required: true,
                },
            },
            messages: {
                invest_amount: {
                    required: '{{ __('auth.required') }}',
                },
                i_acknowledge: {
                    required: '{{ __('auth.required') }}',
                },
                i_read: {
                    required: '{{ __('auth.required') }}',
                },
            }
        });

    $("#invest-form").on("submit", function(event) {
        event.preventDefault();
        var formValues = $(this).serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('investor.project.invest', $project->id) }}",
            method: 'post',
            data: formValues,
            beforeSend: function() {
                $('#invest-btn').html('Please wait...');
            },
            success: function(result) {
                if (result.status == true) {
                    $('#exampleModal').modal('show');
                    $('#invest-btn').html('{{ __('projects.INVEST') }}');
                    $('#share_id').val(result.data);
                    $('#invest-btn').html('{{ __('projects.INVEST') }}');
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: result.error,
                        timer: 3000,
                        showCancelButton: false,
                        showConfirmButton: false
                    });
                    $('#invest-btn').html('{{ __('projects.INVEST') }}');
                }
            },
            error: function (){
                $('#invest-btn').html('{{ __('projects.INVEST') }}');
            }
        });
    });

    $('#otp4').on('keyup', function (){
        $('#otp-verify .submit-modal-btn').prop('disabled', false);
    });

    $("#otp-verify").on("submit", function(event) {
        event.preventDefault();
        var formValues = $(this).serialize();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('investor.project.otp') }}",
            method: 'post',
            data: formValues,
            beforeSend: function (){
                $('#otp-verify .submit-modal-btn').prop('disabled', 'disabled');
            },
            success: function(result) {
                if (result.status == true) {
                    $('.c-error').html('<div class="alert alert-success">'+result.message+'</div>');
                    setTimeout(function(){
                        location.href = result.redirect;
                    }, 5000);
                } else {
                    $('.c-error').html('<div class="alert alert-danger">'+result.message+'</div>');
                }
            }
        });
    });

    $('.ok-modal-btn').on('click', function (){
        $('#exampleModal').modal('hide');
        $('#exampleModal1').modal('show');
    })

    $.ajax({
        url: "{{ route('investor.project.invest', $project->id) }}",
        method: 'post',
        data: formValues,
        success: function(result) {
            if (result.status == true) {
                $('#exampleModal').modal('show');

            } else {
                $.each(result.error, function(k, v) {
                    console.log(k, v);
                });
            }
        }
    });

    </script>

@endsection
