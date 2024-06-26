@extends('layouts.investor.investor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Upgrade To Pro Listing</title>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="funding-campaign-table">
            <div class="d-flex flex-column-fluid">
                <div class="container-fluid">
                    <div class="heding-aligned">
                        <div class="row df_aic">
                            <div class="col-md-12 col-sm-12 col-12 d-flex w-100">
                                <h4 class="campaign-text">Upgrade To Pro</h4>
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
                                        <th class="">Made transactions in the stock markets with a total value of not less than forty million Saudi riyals and not less than ten transactions in each quarter during the past twelve months.</th>
                                        <th class="">Net assets shall not be less than five million Saudi riyals.</th>
                                        <th class="">Worked or have previously worked in any investment or financial institutions for a period not less than 3 years.</th>
                                        <th class="">To be carrying a professional certificates that are internationally approved in the investments or financial sector</th>
                                        <th class="">He shall be holding a Certificate for Trading Securities that is approved by the Authority, and providing that his annual income is not less than six hundred thousand Saudi riyals in the past two years.</th>
                                        <th class="">Status</th>
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
                ajax: "{{ route('admin.upgrade.list') }}",
                oLanguage: {sLengthMenu:     " _MENU_ entries"},
                columns: [
                    {data: 'user'},
                    {data: 'made_transactions'},
                    {data: 'net_assets'},
                    {data: 'worked_previously'},
                    {data: 'pro_certificate'},
                    {data: 'trading_certificate'},
                    {data: 'status'},
                    {data: 'action', orderable: false, searchable: false},
                ]
            });
        });

        function changeStatus(id, status){
            Swal.fire({
                icon: 'error',
                title: 'Are you sure you want to change the status?',
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
                        url: "{{ route('admin.upgrade.status') }}",
                        method: 'post',
                        data: {
                            id: id,
                            status: status,
                        },
                        success: function (result) {
                            if(result.status == true){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Status Changed!',
                                    timer: 2000,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                });
                                location.reload();
                            } else{
                                Swal.fire('Oops Something went wrong!', '', 'warning')
                            }
                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            });
        }

    </script>
@endsection
