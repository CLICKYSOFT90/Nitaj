@extends('layouts.investor.investor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | {{ __('my-portfolio.My Portfolio') }}</title>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="funding-campaign-table">
            <div class="d-flex flex-column-fluid">
                <div class="container-fluid">
                    <div class="heding-aligned">
                        <div class="row df_aic">
                            <div class="col-md-6 col-sm-12 col-12">
                                <h4 class="campaign-text">{{ __('my-portfolio.My Portfolio') }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="table-responsive">
                                <table class="table data-table">
                                    <thead>
                                    <tr>
                                        <th class="for-left-td">{{ __('my-portfolio.Project Name') }}</th>
                                        <th>{{ __('my-portfolio.Project Type') }}</th>
                                        <th>{{ __('my-portfolio.Project Market Value') }}</th>
                                        <th>{{ __('my-portfolio.Equity Share') }}</th>
                                        <th>{{ __('my-portfolio.% of Portfolio') }}</th>
                                        <th>{{ __('my-portfolio.Position total') }}</th>
                                        <th class="for-right-td"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
{{--                            <a href="javascriptvoid:(0)" class="show-more">Show More <i class="fa fa-angle-double-down" aria-hidden="true"></i></a>--}}
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
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('investor.my-portfolio.list') }}",
                oLanguage: {sLengthMenu:     " _MENU_ entries"},
                columns: [
                    {data: 'project_name'},
                    {data: 'project_type'},
                    {data: 'project_market_value'},
                    {data: 'equity_share'},
                    {data: 'portfolio'},
                    {data: 'position_total'},
                    {data: 'action', orderable: false, searchable: false},
                ]
            });

        });
    </script>
@endsection
