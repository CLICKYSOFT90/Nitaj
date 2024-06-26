@extends('layouts.investor.investor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Performance</title>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="funding-campaign-table">
            <div class="d-flex flex-column-fluid">
                <div class="container-fluid">
                    <div class="heding-aligned">
                        <div class="row df_aic">
                            <div class="col-md-12 col-sm-12 col-12">
                                <h4 class="campaign-text">Performance Report</h4>
                                <div class="for-new-add padding-set">
                                    <a href="{{ route('admin.create-new-report') }}" class="sbmt-btn pull-right">CREATE A
                                        NEW
                                        REPORT</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="table-responsive">
                                <table class="table data-table">
                                    <thead>
                                        <tr>
                                            <th class="for-left-td">ID</th>
                                            <th>Project Name En</th>
                                            <th>Project Name Ar</th>
                                            <th>Action</th>
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
@endsection
@section('scripts')
    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.performance') }}",
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'project_name_en'
                    },
                    {
                        data: 'project_name_en'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });
        function deleteReport(id, curr){
            Swal.fire({
                icon: 'error',
                title: 'Are you sure you want to delete?',
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
                        url: "{{ route('admin.delete-report') }}",
                        method: 'post',
                        data: {
                            id: id,
                        },
                        success: function (result) {
                            if(result.status == true){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: result.data,
                                    timer: 2000,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                });
                                $(curr).parent().parent().parent().remove();
                            } else{
                                Swal.fire('Oops Something went wrong!', '', 'warning')
                            }
                        },
                        error: function (result){
                            if(result.status == false){
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Warning',
                                    text: result.data,
                                    timer: 2000,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                });
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
