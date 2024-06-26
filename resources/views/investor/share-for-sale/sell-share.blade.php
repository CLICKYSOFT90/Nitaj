@extends('layouts.investor.investor')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | {{ __('shares.Sell Share') }}</title>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="wd-3">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <div class="share-hd">
                        <div class="row df_aic">
                            <div class="col-md-6 col-sm-6 col-6">
                                <h4 class="campaign-text">{{ __('shares.Shares Market') }}</h4>
                            </div>
                            <div class="col-md-6 col-sm-6 col-6">
                                <div class="switch-button selling-shares-button">
                                    <a href={{ route('investor.buy.shares') }} class="switch-btn">{{ __('shares.Switch To Buy Shares') }}</a>
                                    <a href="{{ route('investor.sell.ownShares') }}" class="sbmt-btn">{{ __('shares.Sell Your Shares') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="share-listed-sec">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="tabs-main">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <div class="slider"></div>
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#tabs-1"
                                               role="tab">{{ __('shares.Shares Listed for Sale') }} </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tabs-2"
                                               role="tab">{{ __('shares.Bid Offers') }}</a>
                                        </li>

                                    </ul><!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                            <div class="buy-shares-table for_revert">
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-12">
                                                        <div class="table-responsive">
                                                            <table class="table list-shares">
                                                                <thead>
                                                                <tr>
                                                                    <th class="for-left-td">{{ __('shares.List No') }}</th>
                                                                    <th>{{ __('shares.Project Name') }}</th>
                                                                    <th>{{ __('shares.No. Share') }}</th>
                                                                    <th>{{ __('shares.Price Per Share') }}</th>
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
                                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                                            <div class="buy-shares-table for_revert">
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-12">
                                                        <div class="table-responsive">
                                                            <table class="table bid-offers">
                                                                <thead>
                                                                <tr>
                                                                    <th class="for-left-td">{{ __('shares.Offer ID') }}</th>
                                                                    <th>{{ __('shares.Bidder') }}</th>
                                                                    <th>{{ __('shares.No. Shares') }}</th>
                                                                    <th>{{ __('shares.Price Per Share') }}</th>
                                                                    <th>{{ __('shares.Value') }}</th>
                                                                    <th></th>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function() {
            var table = $('.list-shares').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('investor.sell.shares.list') }}",
                oLanguage: {sLengthMenu:     " _MENU_ entries"},
                columns: [
                    {data: 'id'},
                    {data: 'project_name'},
                    {data: 'no_of_share'},
                    {data: 'price_per_share'},
                ]
            });
        });
        $(function() {
            var table = $('.bid-offers').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('investor.sell.shares.bidding_offer.list') }}",
                oLanguage: {sLengthMenu:     " _MENU_ entries"},
                columns: [
                    {data: 'id'},
                    {data: 'bidder'},
                    {data: 'no_of_share'},
                    {data: 'price_per_share'},
                    {data: 'value'},
                    {data: 'action'},
                ]
            });
        });

        // $('body').on('click', '.buy-accept-btn', function (){
        //     $(this).html('Please Wait');
        // })

        function changeStatus(id, status, project_id, seller_id, ref) {
            Swal.fire({
                icon: 'question',
                title: '{{ __('shares.Are you sure you want to change status?') }}',
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonColor: '#3ea99d',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var content = $(ref).text();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('investor.sell.bid.statusChange') }}",
                        method: 'post',
                        data: {
                            id: id,
                            status: status,
                            project_id: project_id,
                            seller_id: seller_id,
                        },
                        beforeSend: function() {
                            $(ref).html('{{ __('shares.Please wait') }}'+'...');
                        },
                        success: function (result) {
                            if (result.status == true) {
                                $(ref).html(content);
                                Swal.fire({
                                    icon: 'success',
                                    title: '{{ __('shares.Success') }}',
                                    text: '{{ __('shares.Status Changed!') }}',
                                    timer: 2000,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                });
                                location.reload();
                            } else {
                                $(ref).html(content);
                                Swal.fire({
                                    icon: 'warning',
                                    title: '{{ __('shares.Warning') }}',
                                    text: result.error,
                                    timer: 2000,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                });
                            }
                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })
        }
    </script>
@endsection
