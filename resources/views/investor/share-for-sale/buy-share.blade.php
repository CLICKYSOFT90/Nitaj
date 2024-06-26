@extends('layouts.investor.investor')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Buy Share</title>
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
                                <div class="switch-button">
                                    <a href={{ route('investor.sell.shares') }} class="switch-btn">{{ __('shares.Switch To Sell Shares') }}</a>
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
                                                            <table class="table shares-sale">
                                                                <thead>
                                                                <tr>
                                                                    <th class="for-left-td">{{ __('shares.List No') }}</th>
                                                                    <th>{{ __('shares.Project Name') }}</th>
                                                                    <th>{{ __('shares.No. Share') }}</th>
                                                                    <th>{{ __('shares.Price Per Share') }}</th>
                                                                    <th>{{ __('shares.Total Amount (Incl Tax)') }}</th>
                                                                    <th>{{ __('shares.Bids') }}</th>
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
                                                                    <th class="for-left-td">{{ __('shares.List No') }}</th>
                                                                    <th>{{ __('shares.Project Name') }}</th>
                                                                    <th>{{ __('shares.No. Shares') }}</th>
                                                                    <th>{{ __('shares.Price Per Share') }}</th>
                                                                    <th>{{ __('shares.Total Amount (Incl Tax)') }}</th>
                                                                    <th>{{ __('shares.Status') }}</th>
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
            var i = 1;
            var table = $('.shares-sale').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('investor.buy.shares.list') }}",
                oLanguage: {sLengthMenu:     " _MENU_ entries"},
                columns: [
                    {
                        "render": function() {
                            return i++;
                        }
                    },
                    {data: 'project_name'},
                    {data: 'no_of_share'},
                    {data: 'price_per_share'},
                    {data: 'total_amount'},
                    {data: 'bids'},
                ]
            });
        });
        $(function() {
            var i = 1;
            var table = $('.bid-offered').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('investor.buy.shares.bid.list') }}",
                oLanguage: {sLengthMenu:     " _MENU_ entries"},
                columns: [
                    {
                        "render": function() {
                            return i++;
                        }
                    },
                    {data: 'project_name'},
                    {data: 'no_of_share'},
                    {data: 'price_per_share'},
                    {data: 'total_amount'},
                    {data: 'status'},
                ]
            });
        });
    </script>
@endsection
