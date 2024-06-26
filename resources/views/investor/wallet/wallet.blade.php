@extends('layouts.investor.investor')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | {{ __('nav.Wallet') }}</title>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="wd-3">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <div class="eq-clearance-box">
                        <div class="eq-clear-bx-1 separartor">
                            <h6>{{ __('wallet.Equity Wallet') }}</h6>
                            <h3>{{ getUserWallet(auth()->user()->id) }}<sup>SAR</sup></h3>
                            <p>{{ __('wallet.Account Balance') }}</p>
                        </div>
{{--                        <div class="eq-clear-bx-1 separartor">--}}
{{--                            <h6>{{ __('wallet.Debt Wallet') }}</h6>--}}
{{--                            <h3>{{ getUserDebitWallet(auth()->user()->id) }} <sup>SAR</sup></h3>--}}
{{--                            <p>{{ __('wallet.Account Balance') }}</p>--}}
{{--                        </div>--}}
                        <div class="eq-clear-bx-1 separartor">
                            <h6>{{ __('wallet.Withdrawn') }}</h6>
                            <h3>{{ $wallet_requests }}<sup>SAR</sup></h3>
                        </div>
                        <div class="eq-clear-bx-1 separartor">
                            <h6>{{ __('wallet.Pending Clearance') }}</h6>
                            <h3>{{ $pending_requests }}<sup>SAR</sup></h3>
                        </div>
                        <div class="eq-clear-bx-1">
                            <h6>{{ __('wallet.Net Income') }}</h6>
                            <h3>0 <sup>SAR</sup></h3>
                        </div>
                    </div>
                    <div class="share-hd">
                        <div class="row df_aic">
                            <div class="col-md-12 col-sm-12 col-12">
                                <h4 class="campaign-text">{{ __('wallet.Withdraw Funds') }}</h4>
                                <div class="bank-button">
                                    <button class="bank-btn"><img
                                            src="{{asset('images/bank.png')}}" alt=""
                                            class="img-fluid"> {{ __('wallet.Bank Transfer') }}
                                    </button>
                                </div>
                            </div>
                            <!-- <div class=""></div> -->
                        </div>
                    </div>
                    <div class="share-listed-sec">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="transaction-title">
                                    <h3>{{ __('wallet.Transaction') }}</h3>
                                </div>
                            </div>
                        </div>
{{--                        <div class="row">--}}
{{--                            <div class="col-md-8 col-sm-12 col-12">--}}
{{--                                <div class="show-everything">--}}
{{--                                    <div class="show-title">--}}
{{--                                        <h6>Show</h6>--}}
{{--                                    </div>--}}
{{--                                    <div class="show-field every-md">--}}
{{--                                        <select name="" id="">--}}
{{--                                            <option value="">Everything</option>--}}
{{--                                            <option value="">Withdrawn</option>--}}
{{--                                            <option value="">Pending Clearance</option>--}}
{{--                                            <option value="">Cleared</option>--}}
{{--                                        </select>--}}

{{--                                    </div>--}}
{{--                                    <div class="show-field every-sm">--}}
{{--                                        <select name="" id="">--}}
{{--                                            <option value="">2022</option>--}}
{{--                                            <option value="">2021</option>--}}
{{--                                            <option value="">2020</option>--}}
{{--                                            <option value="">2019</option>--}}
{{--                                            <option value="">2018</option>--}}
{{--                                            <option value="">2017</option>--}}
{{--                                            <option value="">2016</option>--}}
{{--                                            <option value="">2015</option>--}}
{{--                                        </select>--}}

{{--                                    </div>--}}
{{--                                    <div class="show-field">--}}
{{--                                        <select name="" id="">--}}
{{--                                            <option value="">All Month</option>--}}
{{--                                            <option value="">January</option>--}}
{{--                                            <option value="">February</option>--}}
{{--                                            <option value="">March</option>--}}
{{--                                            <option value="">April</option>--}}
{{--                                            <option value="">May</option>--}}
{{--                                            <option value="">June</option>--}}
{{--                                            <option value="">July</option>--}}
{{--                                            <option value="">August</option>--}}
{{--                                            <option value="">September</option>--}}
{{--                                            <option value="">October</option>--}}
{{--                                            <option value="">November</option>--}}
{{--                                            <option value="">December</option>--}}
{{--                                        </select>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="buy-shares-table for_revert">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="table-responsive">
                                        <table class="table data-table">
                                            <thead>
                                            <tr>
                                                <th class="for-left-td">{{ __('wallet.Transaction ID') }}</th>
                                                <th>{{ __('wallet.Description') }}</th>
                                                <th>{{ __('wallet.Transaction Type') }}</th>
                                                <th>{{ __('wallet.Account') }}</th>
                                                <th>{{ __('wallet.Amount') }}</th>
                                                <th class="for-right-td">{{ __('wallet.Status') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade wdraw-modal " id="withdrawbank" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideout modal-wd" role="document">
            <div class="modal-content buy-modal-content">
                <div class="withdraw-body">
                    <div class="">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">X</span>
                        </button>
                    </div>
                    <div class="withdraw-head">
                        <h3><img src="{{asset('images/green-ban.png')}}" alt="" class="img-fluid">{{ __('wallet.Withdraw to Bank') }}</h3>
                    </div>
                    <div class="bid-main">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="with-details">
                                    <h5>{{ __('wallet.Withdrawal Details') }}</h5>
                                    <p>{{ __('wallet.Withdraw to your personal bank account') }}<a href="#">{{ __('wallet.Add new account') }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form method="post" id="withdraw">
                        @csrf
                        <div class="bank-fld-main">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="wallet-ban-fields">
                                        <select name="bank_acc" id="bank_acc">
                                            <option value="" disabled selected>{{ __('wallet.Select bank account') }}</option>
                                            <option value="{{ auth()->user()->iban }}">{{ auth()->user()->bank_name }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="wallet-ban-fields">
                                        <select name="wallet_type" id="wallet-type">
                                            <option value="" disabled selected>{{ __('wallet.Select Wallet') }}</option>
                                            <option value="Equity Wallet">Equity Wallet ({{ getUserWallet(auth()->user()->id) }} SAR)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="wallet-ban-fields">
                                        <input type="text" name="amount" id="amount"
                                               onkeyup="this.value=this.value.replace(/[^0-9]/g, '');"
                                               placeholder="{{ __('wallet.Amount to Withdraw') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="review-button">
                                        <button type="submit" class="review-btn sbmt-btn">{{ __('wallet.Review') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade wdraw-modal" id="summary" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideout modal-wd " role="document">
            <div class="modal-content buy-modal-content">
                <div class="withdraw-body">
                    <div class="">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">X</span>
                        </button>
                    </div>
                    <div class="withdraw-head">
                        <h3><img src="{{asset('images/green-ban.png')}}" alt="" class="img-fluid">{{ __('wallet.Withdraw to Bank') }}</h3>
                    </div>
                    <div class="bid-main">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="with-details">
                                    <h5>{{ __('wallet.Withdrawal Summary') }}</h5>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bank-list-main">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="bank-listing">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <ul>
                                                <li class="strong-text">{{ __('wallet.Bank') }}
                                                    <span class="pull-right">{{ __('wallet.Amount') }}</span>
                                                </li>
                                                <li class="mb-5" id="s_bank">
                                                    <span class="pull-right" id="s_amount"></span>
                                                </li>
                                                <li>{{ __('wallet.Fees') }} <span class="pull-right font-res" id="s_fee"></span></li>
                                                <li>{{ __('wallet.Withdrawal Fees') }} <span class="pull-right font-res" id="s_withdraw_fee"></span></li>
                                                <li>{{ __('wallet.VAT') }} <span class="pull-right font-res" id="s_vat"></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="receive-listing">
                                            <ul>
                                                <li>{{ __('wallet.Amount to Receive') }} <span class="pull-right" id="s_total"></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form id="confirm-wallet">
                            <input type="hidden" id="wallet_id">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="review-button">
                                        <button class="confirm-btn sbmt-btn">{{ __('wallet.Confirm') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="congrats" class="modal fade wdraw-modal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-slideout modal-wd">
            <div class="modal-content">
                <div class="withdraw-body">
                    <div class="check-anim">
                        <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_2mm5zqab.json"
                                       background="transparent" speed="1" style="width: 100%; height: 200px;" loop
                                       autoplay></lottie-player>
                    </div>
                    <div class="on-way-text">
                        <h3 id="total_amount"></h3>
                        <p>{{ __('wallet.Funds should land in your bank account within 7 business days') }}</p>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="review-button confirm-button">
                                <button class="back-btn sbmt-btn">{{ __('wallet.Back to wallet') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script>

        $(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('investor.wallet.list') }}",
                oLanguage: {sLengthMenu:     " _MENU_ entries"},
                columns: [
                    {data: 'transaction_id'},
                    {data: 'description'},
                    {data: 'transaction_type'},
                    {data: 'bank_account'},
                    {data: 'amount'},
                    {data: 'status', orderable: false, searchable: false},
                ]
            });

        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $('.bank-btn').on('click', function (){
            $('#withdraw').trigger("reset");
            $('#withdrawbank').modal('show')
        })
        $("#withdraw").on("submit", function (event) {
            event.preventDefault();
            var formValues = $(this).serialize();
            $.ajax({
                url: "{{ route('investor.wallet.withdrawRequest') }}",
                method: 'post',
                data: formValues,
                success: function (result) {
                    if (result.status == true) {
                        console.log(result.data);
                        console.log(result.data.amount+' SAR');
                        $('#withdrawbank').modal('hide')
                        $('#s_bank').append(result.data.bank);
                        $('#s_amount').html(result.data.amount+' SAR');
                        $('#s_vat').html(result.data.vat+' SAR');
                        $('#s_fee').html(result.data.fee+' SAR');
                        $('#s_withdraw_fee').html(result.data.withdraw_fee+' SAR');
                        $('#s_total').html(result.data.total+' SAR');
                        $('#s_withdrawbank').modal('hide');
                        $('#wallet_id').val(result.data.id);
                        $('#summary').modal('show');
                    }
                }
            });
        });
        $("#confirm-wallet").on("submit", function (event) {
            event.preventDefault();
            var id = $('#confirm-wallet #wallet_id').val();
            $.ajax({
                url: "{{ route('investor.wallet.withdrawRequest.confirm') }}",
                method: 'post',
                data: {id: id},
                success: function (result) {
                    if (result.status == true) {
                        console.log(result.data);
                        $('#total_amount').html(result.data.amount+' SAR'+" {{ __('wallet.are on their way') }}");
                        $('#summary').modal('hide');
                        $('#congrats').modal('show');
                    }
                }
            });
        });

        $(".confirm-btn").click(function () {
            $("#congrats").modal('hide');

        });

        $(".back-btn").click(function () {
            $("#congrats").modal('hide');
            location.reload();
        });


        $('#withdraw').validate({
            rules: {
                bank_acc: {
                    required: true,
                },
                wallet_type: {
                    required: true,
                },
                amount: {
                    required: true,
                }
            }, messages: {
                bank_acc: {
                    required: '{{ __('auth.required') }}',
                },
                wallet_type: {
                    required: '{{ __('auth.required') }}',
                },
                amount: {
                    required: '{{ __('auth.required') }}',
                }
            }
        });

    </script>
@endsection
