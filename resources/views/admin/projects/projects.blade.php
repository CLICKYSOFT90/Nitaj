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
                            <div class="col-md-6 col-sm-12 col-12">
                                <h4 class="campaign-text">{{ __('projects.List of Projects') }}</h4>

                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="for-new-add right-align">
                                    <a href="{{ route('admin.projects.add') }}"
                                        class="sbmt-btn">{{ __('projects.ADD NEW') }}</a>
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
                                        <th class="for-left-td">{{ __('projects.Project Name') }}</th>
                                        <th>{{ __('projects.Project Type') }}</th>
                                        <th>{{ __('projects.Funding Requires') }}</th>
                                        <th>{{ __('projects.Investment Period') }}</th>
                                        <th>{{ __('projects.No Of Shares') }}</th>
                                        <th>{{ __('projects.Added On') }}</th>
                                        <th> Marked As </th>
                                        <th> Sold At </th>
                                        <th class="for-right-td"></th>
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
                ajax: "{{ route('admin.projects.list') }}",
                oLanguage: {sLengthMenu:     " _MENU_ entries"},
                columns: [
                    {data: 'project_name_en'},
                    {data: 'project_type_en'},
                    {data: 'funding_required'},
                    {data: 'investment_period'},
                    {data: 'no_of_shares'},
                    {data: 'created_at'},
                    {data: 'marked_as'},
                    {data: 'sold_at'},
                    {data: 'action', orderable: false, searchable: false},
                ]
            });
        });

        function markAsSold(project_id, status){
            Swal.fire({
                icon: 'error',
                title: 'Are you sure you want to mark as sold?',
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
                        url: "{{ route('admin.projects.sold') }}",
                        method: 'post',
                        data: {
                            id: project_id,
                            status: status,
                        },
                        success: function (result) {
                            if(result.status == true){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: result.error,
                                    timer: 3000,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 5000);
                            } else{
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Warning',
                                    text: result.error,
                                    timer: 3000,
                                    showCancelButton: false,
                                    showConfirmButton: false
                                });
                            }
                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            });
        }
        function changeStatus(id, status){
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
                        url: "{{ route('admin.project.statusChange') }}",
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
