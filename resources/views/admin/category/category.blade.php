@extends('layouts.investor.investor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Categories Listing</title>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="funding-campaign-table">
            <div class="d-flex flex-column-fluid">
                <div class="container-fluid">
                    <div class="heding-aligned">
                        <div class="row df_aic">
                            <div class="col-md-6 col-sm-12 col-12">
                                <h4 class="campaign-text">{{ __('category.List of Categories') }}</h4>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="for-new-add right-align">
                                    <a href="{{ route('admin.category.add') }}" class="sbmt-btn">{{ __('category.ADD NEW') }}</a>
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
                                        <th class="for-left-td">{{ __('category.SN') }}</th>
                                        <th>{{ __('category.Category Type EN') }}</th>
                                        <th>{{ __('category.Category Type Arabic') }}</th>
                                        <th>{{ __('category.Property Type') }} </th>
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
                ajax: "{{ route('admin.category.list') }}",
                oLanguage: {sLengthMenu:     " _MENU_ entries"},
                columns: [
                    {data: 'id'},
                    {data: 'name_en'},
                    {data: 'name_ar'},
                    {data: 'property_type_en'},
                    {data: 'action', orderable: false, searchable: false},
                ]
            });

        });

        function delete_cat(cat_id){
            var div = event.target.parentNode;
            var td = div.parentNode; // the row to be removed
            var tr = td.parentNode; // the row to be removed
            Swal.fire({
                icon: 'error',
                title: 'Are you sure you want to delete?',
                showCancelButton: true,
                showConfirmButton: true
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
                        url: "{{ route('admin.category.delete') }}",
                        method: 'post',
                        data: {
                            cat_id: cat_id,
                        },
                        success: function (result) {
                            if(result.status == true){
                                tr.parentNode.removeChild(tr);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Category deleted.',
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
    </script>
@endsection
