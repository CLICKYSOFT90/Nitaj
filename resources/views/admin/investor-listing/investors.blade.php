@extends('layouts.investor.investor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Projects Listing</title>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="funding-campaign-table">
            <div class="d-flex flex-column-fluid">
                <div class="container-fluid">
                    <div class="heding-aligned">
                        <div class="row df_aic">
                            <div class="col-md-12 col-sm-12 col-12 d-flex w-100">
                                <h4 class="campaign-text">Investors</h4>
{{--                                <div class="for-new-add text-right ml-auto">--}}
{{--                                    <a href="{{ route('admin.projects.add') }}" class="sbmt-btn">{{ __('projects.ADD NEW') }}</a>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="table-responsive">
                                <table class="table data-table">
                                    <thead>
                                    <tr>
                                        <th class="for-left-td">S.N</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Investor Type</th>
                                        <th>Registered On</th>
                                        <th>National ID</th>
                                        <th class="for-right-td">Status</th>
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
            var i = 1;
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.investor.list') }}",
                oLanguage: {sLengthMenu:     " _MENU_ entries"},
                columns: [
                    {
                        "render": function() {
                            return i++;
                        }
                    },
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'user_type'},
                    {data: 'created_at'},
                    {data: 'national_id'},
                    {data: 'status', orderable: false, searchable: false},
                ]
            });
        });

        function delete_investor(investor_id){
            var div = event.target.parentNode;
            var td = div.parentNode; // the row to be removed
            var tr = td.parentNode; // the row to be removed
            Swal.fire({
                icon: 'error',
                title: 'Are you sure you want to delete?',
                showCancelButton: true,
                showConfirmButton: true,
                confirmButtonColor: "red",
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var $tr = $(this).closest('tr');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('admin.investor.delete') }}",
                        method: 'post',
                        data: {
                            investor_id: investor_id,
                        },
                        success: function (result) {
                            if(result.status == true){
                                tr.parentNode.removeChild(tr);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Investor deleted.',
                                    timer: 2000,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                })
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
        function changeStatus(investor_id, status){
            var statusText = 'Are you sure you want to reactivate account';
            if(status == 0){
                statusText = 'Are you sure you want to deactive account'
            }
            Swal.fire({
                icon: 'question',
                title: statusText,
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
                        url: "{{ route('admin.investor.statusChange') }}",
                        method: 'post',
                        data: {
                            investor_id: investor_id,
                            status: status,
                        },
                        success: function (result) {
                            if(result.status == true){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Investor Status Updated!',
                                    timer: 2000,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                })
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
