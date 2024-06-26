@extends('layouts.investor.investor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Shares Approval Requests Listing</title>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="funding-campaign-table">
            <div class="d-flex flex-column-fluid">
                <div class="container-fluid">
                    <div class="heding-aligned">
                        <div class="row df_aic">
                            <div class="col-md-12 col-sm-12 col-12 d-flex w-100">
                                <h4 class="campaign-text">Shares Approval Requests</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="table-responsive">
                                <table class="table data-table">
                                    <thead>
                                    <tr>
                                        <th class="for-left-td">User</th>
                                        <th class="for-left-td">Project</th>
                                        <th class="for-left-td">No Of Shares</th>
                                        <th class="for-left-td">OTP Verified</th>
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
                ajax: "{{ route('admin.approval.requests.list') }}",
                oLanguage: {sLengthMenu:     " _MENU_ entries"},
                columns: [
                    {data: 'user'},
                    {data: 'project'},
                    {data: 'no_of_shares'},
                    {data: 'otp_verified'},
                    {data: 'action', orderable: false, searchable: false},
                ]
            });

        });
    </script>
@endsection
