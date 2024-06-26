@extends('layouts.investor.investor')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Vote</title>
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
                            <div class="col-md-12 col-sm-12 col-12">
                                <h4 class="campaign-text">{{ __('vote.Voting Campaigns') }}</h4>
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
                                               role="tab">{{ __('vote.Voting Campaign List') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tabs-2"
                                               role="tab">{{ __('vote.Casted Votes') }}</a>
                                        </li>

                                    </ul><!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                            <div class="buy-shares-table for_revert">
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-12">
                                                        <div class="table-responsive">
                                                            <table class="table data-table">
                                                                <thead>
                                                                <tr>
                                                                    <th class="for-left-td">{{ __('vote.Project Name') }}</th>
                                                                    <th>{{ __('vote.Asset Type') }}</th>
                                                                    <th>{{ __('vote.Amount Funded') }}</th>
                                                                    <th>{{ __('vote.Equity Share') }}</th>
                                                                    <th>{{ __('vote.Project Type') }}</th>
                                                                    <th>{{ __('vote.Status') }}</th>
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
                                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                                            <div class="buy-shares-table for_revert ">
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12 col-12">
                                                        <div class="table-responsive">
                                                            <table class="table casted-votes">
                                                                <thead>
                                                                <tr>
                                                                    <th class="for-left-td">{{ __('vote.Project Name') }}</th>
                                                                    <th>{{ __('vote.Asset Type') }}</th>
                                                                    <th>{{ __('vote.Amount Funded') }}</th>
                                                                    <th>{{ __('vote.Equity Share') }}</th>
                                                                    <th>{{ __('vote.Project Type') }}</th>
                                                                    <th>{{ __('vote.Status') }}</th>
                                                                    <th></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody class="vt-bg">
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
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('investor.vote.list') }}",
                oLanguage: {sLengthMenu:     " _MENU_ entries"},
                columns: [
                    {data: 'project_name'},
                    {data: 'asset_type'},
                    {data: 'amount_funded'},
                    {data: 'equity_share'},
                    {data: 'project_type'},
                    {data: 'status'},
                    {data: 'action', orderable: false, searchable: false},
                ]
            });
        });
        $(function() {
            var table = $('.casted-votes').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('investor.vote.list2') }}",
                oLanguage: {sLengthMenu:     " _MENU_ entries"},
                columns: [
                    {data: 'project_name'},
                    {data: 'asset_type'},
                    {data: 'amount_funded'},
                    {data: 'equity_share'},
                    {data: 'project_type'},
                    {data: 'status'},
                    {data: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection
