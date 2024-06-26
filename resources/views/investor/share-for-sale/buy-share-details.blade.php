@extends('layouts.investor.investor')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | {{ __('shares.Buy Share') }}</title>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="shres-market-sec">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12">
                        <ul class="tags-listing">
                            <li class="tags-list-item"><a href="{{ route('investor.buy.shares') }}"
                                                          class="tags-list-text"><i class="fa fa-angle-left tag-icon"
                                                                                    aria-hidden="true"></i> {{ __('shares.Back') }}
                                </a>
                            </li>
                            <li class="tags-list-item"><a href="javascriptvoid:(0)"
                                                          class="tags-list-text for-color">{{ __('shares.Shares Market') }}</a>
                            </li>
                            <li class="tags-list-item"><a href="javascriptvoid:(0)"
                                                          class="tags-list-text"><i
                                        class="fa fa-angle-double-right tag-icon"
                                        aria-hidden="true"></i></a></li>
                            <li class="tags-list-item"><a href="javascriptvoid:(0)"
                                                          class="tags-list-text">{{ __('shares.Highest Offer') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="listing-information">
            <div class="container">
                <div class="listing-box-main">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-12">
                            <div class="listed-box">
                                <div class="listed-image">
                                    <img
                                        src="{{ asset('project-visual-uploads'.'/'.$share_for_sales[0]->project->projectImages[0]->filename) }}"
                                        alt="" class="img-fluid">
                                </div>
                                <div class="shed-content">
                                    <h4>BS {{ $share_for_sales[0]->project_id }}</h4>
                                    <h3>{{ App::getLocale() == 'en' ? $share_for_sales[0]->project->project_name_en : $share_for_sales[0]->project->project_name_ar }}</h3>
                                    <p>{{ App::getLocale() == 'en' ? $share_for_sales[0]->project->projectCompany->name_en : $share_for_sales[0]->project->projectCompany->name_ar }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-sm-12 col-12">
                        <div class="offered-equity">
                            <ul>
                                <li>
                                    <h4>{{ !empty($share_for_sales[0]->bidding[0]) ? $share_for_sales[0]->bidding->max('amount') : 0 }}</h4>
                                    <p>{{ __('shares.Highest Offer') }}</p>
                                </li>
                                <li>
                                    <h4>{{ !empty($share_for_sales[0]->bidding[0]) ? $share_for_sales[0]->bidding->min('amount') : 0 }}</h4>
                                    <p>{{ __('shares.Lowest Offer') }}</p>
                                </li>
                                <li>
                                    <h4>{{ $share_for_sales[0]->sfs_amount }}</h4>
                                    <p>{{ __('shares.Listing Price') }}</p>
                                </li>
                                <li class="m-0">
                                    <h4>{{ $share_for_sales[0]->sfs_no_of_shares - $share_for_sales[0]->sfs_sold_shares }}</h4>
                                    <p>{{ __('shares.Number of Shares') }}</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="shared-projects">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12">
                        <div class="projects-heading">
                            <h2>{{ __('shares.Project Reports') }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 col-sm-8 col-12">
                        <div class="down-main">
                            <div class="row">
                                @foreach($share_for_sales as $share_for_sale)
                                    @foreach($share_for_sale->project->projectDocuments as $doc)
                                        <div class="col-md-4 col-sm-4 co-12">
                                            <div class="down-report">
                                                <h6>{{ __('shares.DOWNLOAD') }}<span class="dow_icon ">
                                                <a href="{{ asset('project-doc'.'/'.$doc->doc_name) }}"
                                                   class="pull-right" download>
                                                    <img src="{{ asset('images/download.png') }}" alt="">
                                                </a>
                                            </span>
                                                </h6>
                                                <p>{{ $doc->doc_name }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                        <div class="report-button">
                            <a href="#" class="sbmt-btn" data-toggle="modal"
                               data-target="#exampleModal">{{ __('shares.PLACE YOUR BID') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade buy-modal" id="exampleModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog main-buy-dialog" role="document">
            <div class="modal-content buy-modal-content">
                <div class="modal-buy-1">
                    <div class="bid-heding">
                        <h3>{{ __('shares.Bid Offer') }}</h3>
                    </div>
                    <div class="bid-main">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="bid-box">
                                    <h6>{{ __('shares.Available Funds') }}</h6>
                                    <h5>{{ getUserWallet(auth()->user()->id) }} <sup>SAR</sup></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bid-field-main">
                        <div class="bidding-heding">
                            <h2>{{ __('shares.Bidding Details') }}</h2>
                        </div>
                    </div>
                    <form id="place-bid">
                        @csrf
                        <input type="hidden" name="seller_id" value="{{ $share_for_sales[0]->user_id }}">
                        <input type="hidden" name="project_id" value="{{ $share_for_sales[0]->project_id }}">
                        <input type="hidden" name="share_for_sales_id" value="{{ $share_for_sales[0]->id }}">
                        <div class="row mb-5">
                            <div class="col-md-10 col-sm-6 col-12">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="bidding-field">
                                            <input type="text" placeholder="No of Shares" name="no_of_shares"
                                                   id="no_of_shares" class="@error('no_of_shares') is-invalid @enderror"
                                                   onkeyup="totalShares(this, {{ $share_for_sales[0]->sfs_no_of_shares - $share_for_sales[0]->sfs_sold_shares }})">
                                            <span class="invalid-feedback form-error no_of_shares" style="display: block;" role="alert">

                                                </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="bidding-field">
                                            <input type="text" placeholder="Amount" name="amount" id="amount" class="@error('amount') is-invalid @enderror"
                                                   onkeyup="calculateFees(this, {{ $price_per_share }})">
                                            <span class="invalid-feedback form-error amount" style="display: block;" role="alert">
                                                </span>
                                        </div>
                                    </div>
                                    <div id="c-error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9 col-sm-9 col-12">
                                <div class="summary-shares">
                                    <h6>{{ __('shares.Summary') }}</h6>
                                </div>
                                <div class="shares-listing">
                                    <ul>
                                        <li>{{ __('shares.Nitaj Exit Fees') }} <span class="pull-right" id="nitaj_fee">0 SAR</span></li>
                                        <li>{{ __('shares.Service Fees') }} <span class="pull-right" id="service_fee">0 SAR</span></li>
                                        <li>VAT % <span class="pull-right" id="vat">0 SAR</span></li>
                                    </ul>
                                </div>
                                <div class="buy-listing">
                                    <ul>
                                        <li>{{ __('shares.Total') }}<span class="pull-right" id="total">0 SAR</span></li>
                                    </ul>
                                </div>
                                <div class="buy-terms">
                                    <input type="checkbox" name="tc" id="tc">
                                    <p>
                                        {{ __('shares.I have read and understood') }}
                                        <a href="#"> {{ __('shares.Bidding Terms & Conditions') }}</a>
                                    </p>
                                </div>
                                <div class="modal-sub-button">
                                    <button type="submit" class="sbmt-btn">{{ __('shares.SUBMIT') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </div>
                    <h4 class="modal-title w-100">Are you sure?</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;
                    </button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete these records? This process cannot be undone.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">

        function calculateFees(val, price_per_share) {
            var no_of_share = $('#no_of_shares').val();
            var total_price = no_of_share * price_per_share;
            if(val.value < total_price){
                $('#c-error').html('<div class="alert alert-danger">'+'{{ __('shares.Entered amount should be greater than') }}'+' '+total_price+'</div>');
                setTimeout(function () {
                    $('#c-error').empty();
                }, 1000);
            }else {
                // VAT
                const vat = {{ $settings->vat }} / 100 * val.value;
                const fee = {{ $settings->fee }} / 100 * val.value;
                const nitaj_fee = {{ $settings->nitaj_exit_fee }} / 100 * val.value;
                const total = (+val.value) + (+vat) + (+fee) + (+nitaj_fee);
                $('#nitaj_fee').html(nitaj_fee + ' SAR')
                $('#vat').html(vat + ' SAR')
                $('#service_fee').html(fee + ' SAR')
                $('#total').html(total + ' SAR')
            }
        }

        function totalShares(val, total_shares) {
            if (val.value > total_shares) {
                $('#c-error').html('<div class="alert alert-danger">'+'{{ __('shares.You cannot enter more than total no of shares') }}'+'</div>');
                setTimeout(function () {
                    $('#c-error').empty();
                }, 1000);
                var remaining_value = val.value;
                $('#no_of_shares').val(remaining_value.slice(0,-1));
            }
        }


        $("#place-bid").on("submit", function (event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('investor.place.bid') }}",
                method: 'post',
                data: formData,
                processData: false,
                cache: false,
                contentType: false,
                beforeSend: function() {
                    $('.sbmt-btn').html('{{ __('shares.Please wait') }}'+'...');
                },
                success: function (result) {
                    if (result.status == true) {
                        $('.sbmt-btn').html('{{ __('shares.SUBMIT') }}');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: result.message,
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                        setTimeout(function () {
                            location.href = '{{route('investor.buy.shares')}}';
                        }, 3000);
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Warning',
                            text: result.message,
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                        $('.sbmt-btn').html('{{ __('shares.SUBMIT') }}');
                    }
                },
                error: function (data) {
                    var errors = $.parseJSON(data.responseText);
                        console.log(errors.error.amount[0]);
                        $('.amount').html('<strong>'+errors.error.amount[0]+'</strong>')
                        $('.no_of_shares').html('<strong>'+errors.error.no_of_shares[0]+'</strong>')
                }
            });
        });

        jQuery.validator.addMethod("characters", function (value, element) {
                var result = /[0-9]/.test(value);
                return result;
            },
            "{{ __('shares.Characters not allowed') }}"
        )

        $('#place-bid').validate({
            rules: {
                no_of_shares: {
                    required: true,
                    characters: true,
                },
                amount: {
                    required: true,
                    characters: true,
                },
                tc: {
                    required: true,
                },
            }, messages: {
                no_of_shares: {
                    required: '{{ __('auth.required') }}',
                },
                amount: {
                    required: '{{ __('auth.required') }}',
                },
                tc: {
                    required: '{{ __('auth.required') }}',
                },
            }
        });
    </script>
@endsection
