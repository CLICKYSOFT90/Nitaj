@extends('layouts.investor.investor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Vote Campaign Listing</title>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="funding-campaign-table">
            <div class="d-flex flex-column-fluid">
                <div class="container-fluid">
                    <div class="heding-aligned">
                        <div class="row df_aic">
                            <div class="col-md-6 col-sm-12 col-12">
                                <h4 class="campaign-text">Vote Campaign</h4>

                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="for-new-add right-align">
                                    <a href="{{ route('admin.vote-campaign.add') }}" class="sbmt-btn">Add New</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <h3>Projects Requiring Vote Campaigns</h3>
                        </div>
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="table-responsive">
                                <table class="table data-table">
                                    <thead>
                                    <tr>
                                        <th class="for-left-td">Project Name</th>
                                        <th>Project Type</th>
                                        <th>No of Investor</th>
                                        <th>Investment Period</th>
                                        <th>Ending On</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            {{-- <a href="javascriptvoid:(0)" class="show-more">Show More <i class="fa fa-angle-double-down" aria-hidden="true"></i></a> --}}
                        </div>
                    </div>
                    <div class="row mt-30">
                        <div class="col-md-12 col-sm-12 col-12">
                            <h3>Vote Campaigns</h3>
                        </div>
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="table-responsive">
                                <table class="table casted-votes">
                                    <thead>
                                    <tr>
                                        <th class="for-left-td">Project Name</th>
                                        <th>Issued On</th>
                                        <th>Expiry Date</th>
                                        <th>Voted Sell/Extend</th>
                                        <th>Voted Agreed/Disagree</th>
                                        <th>Voted Accept/Reject</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            {{-- <a href="javascriptvoid:(0)" class="show-more">Show More <i class="fa fa-angle-double-down" aria-hidden="true"></i></a> --}}
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
                ajax: "{{ route('admin.vote-campaign.list') }}",
                oLanguage: {sLengthMenu:     " _MENU_ entries"},
                columns: [
                    {data: 'project_name'},
                    {data: 'project_type'},
                    {data: 'no_of_investor'},
                    {data: 'investment_period'},
                    {data: 'ending_on'},
                    {data: 'status'},
                    {data: 'action', orderable: false, searchable: false},
                ]
            });
        });
        $(function() {
            var table = $('.casted-votes').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.vote-campaign.another.list') }}",
                oLanguage: {sLengthMenu:     " _MENU_ entries"},
                columns: [
                    {data: 'project_name'},
                    {data: 'issued_on'},
                    {data: 'expiry_date'},
                    {data: 'sell_extend'},
                    {data: 'agree_disagree'},
                    {data: 'accept_reject'},
                    {data: 'status'},
                    {data: 'action', orderable: false, searchable: false},
                ],
            });
        });

        function changeStatus(id, status) {
            Swal.fire({
                icon: 'error',
                title: 'Are you sure you want to change status?',
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonColor: '#3ea99d',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('admin.vote-campaign.statusChange') }}",
                        method: 'post',
                        data: {
                            id: id,
                            status: status,
                        },
                        success: function (result) {
                            if (result.status == true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Status Changed!',
                                    timer: 2000,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                });
                                location.reload();
                            } else {
                                Swal.fire('Oops Something went wrong!', '', 'warning')
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
