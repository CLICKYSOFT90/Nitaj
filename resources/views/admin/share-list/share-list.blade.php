@extends('layouts.investor.investor')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Share Market</title>
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
                                <h4 class="campaign-text">Shares Market</h4>
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
                                               role="tab">Shares Listed for Sale </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tabs-2"
                                               role="tab">Bid Offers</a>
                                        </li>
                                    </ul><!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                            <div class="buy-shares-table for_revert">
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-12">
                                                        <div class="table-responsive">
                                                            <table class="table shares-sale">
                                                                <thead>
                                                                <tr>
                                                                    <th class="for-left-td">User ID</th>
                                                                    <th>Project Name</th>
                                                                    <th>No. Share</th>
                                                                    <th>Price Per Share</th>
                                                                    <th>Bids</th>
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
                                                            <table class="table bid-offered">
                                                                <thead>
                                                                <tr>
                                                                    <th class="for-left-td">User ID</th>
                                                                    <th>Project Name</th>
                                                                    <th>No. Shares</th>
                                                                    <th>Price Per Share</th>
                                                                    <th>Share Holder ID</th>
                                                                    <th>Total Amount</th>
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

    <div class="modal fade buy-modal" id="exampleModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content buy-modal-content">
                <div class="modal-buy-1">
                    <div class="bid-heding">
                        <h3>{{ __('shares.Bid Offer') }}s</h3>
                    </div>
                    <div class="bid-field-main">
                        <div class="bidding-heding">
                            <h2>{{ __('shares.Bidding Details') }}</h2>
                        </div>
                    </div>
                    <div class="buy-shares-table for_revert">
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table biddig-list">
                                            <thead>
                                            <tr>
                                                <th>Bidder ID</th>
                                                <th>No Of Shares</th>
                                                <th>Price Per Share</th>
                                                <th>Amount</th>
                                                <th>Total (Incl Tax)</th>
                                                <th>Date Of Bid</th>
                                                <th>Status</th>
                                            </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
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
        $(function () {
            var i = 1;
            var table = $('.shares-sale').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.shares.listing') }}",
                oLanguage: {sLengthMenu: " _MENU_ entries"},
                columns: [
                    {data: 'user_id'},
                    {data: 'project_name'},
                    {data: 'no_of_share'},
                    {data: 'price_per_share'},
                    {data: 'bids'},
                ]
            });
        });
        $(function () {
            var i = 1;
            var table = $('.bid-offered').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.shares.bid.offers.listing') }}",
                oLanguage: {sLengthMenu: " _MENU_ entries"},
                columns: [
                    {data: 'user_id'},
                    {data: 'project_name'},
                    {data: 'no_of_share'},
                    {data: 'price_per_share'},
                    {data: 'shareholder_id'},
                    {data: 'total_amount'},
                    {data: 'action'},
                ]
            });
        });

        function biddingList(share_id) {
            $('.biddig-list').DataTable().clear().destroy();
            $(function () {
                var url = '{{ route('admin.shares.bids.listing', ":id") }}';
                 url = url.replace(':id',share_id);
                var table = $('.biddig-list').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: url,
                    oLanguage: {sLengthMenu: " _MENU_ entries"},
                    columns: [
                        {data: 'bidder_id'},
                        {data: 'no_of_share'},
                        {data: 'price_per_share'},
                        {data: 'amount'},
                        {data: 'total'},
                        {data: 'date_of_bid'},
                        {data: 'Status'},
                    ]
                });
            });
            $('#exampleModal').modal('show');
        }
    </script>
@endsection
