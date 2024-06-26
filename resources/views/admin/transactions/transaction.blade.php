@extends('layouts.investor.investor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Transactions Listing</title>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="funding-campaign-table">
            <div class="d-flex flex-column-fluid">
                <div class="container-fluid">
                    <div class="heding-aligned">
                        <div class="row df_aic">
                            <div class="col-md-12 col-sm-12 col-12 d-flex w-100">
                                <h4 class="campaign-text">Transactions</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="table-responsive">
                                <table class="table data-table">
                                    <thead>
                                    <tr>
                                        <th class="for-left-td">Transaction ID</th>
                                        <th class="for-left-td">Transaction Date</th>
                                        <th class="for-left-td">Transaction Type</th>
                                        <th class="for-left-td">Investor</th>
                                        <th class="for-right-td">Amount/Tax/Total</th>
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
                ajax: "{{ route('admin.transaction.list') }}",
                oLanguage: {sLengthMenu:     " _MENU_ entries"},
                columns: [
                    {data: 'transaction_id'},
                    {data: 'created_at'},
                    {data: 'transaction_type'},
                    {data: 'user_id'},
                    {data: 'amount'},
                    {data: 'action', orderable: false, searchable: false},
                ]
            });

        });
    </script>
@endsection
