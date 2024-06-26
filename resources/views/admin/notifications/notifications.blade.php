@extends('layouts.investor.investor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Notifications</title>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="for-notification">
            <div class="container">
                <div class="row df_aic mt-5">
                    <div class="col-md-12 col-sm-12 col-12">
                        <h3 class="campaign-text">Notifications</h3>
                        {{--                        <div class="for-new-add">--}}
                        {{--                            <a href="#" class="sbmt-btn">Create new</a>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="campaign-field-text transaction-type-role">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <form action="{{ route('admin.send.notification') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="input-options">
                                    <label>Notification Subject </label>
                                    <input type="text" name="subject" class="for-custom-width">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="input-options">
                                    <label>Purpose</label>
                                    <input type="text" name="purpose" class="for-custom-width">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="input-options">
                                    <label>Project Name</label>
                                    <select name="project_name" id="project_name">
                                        <option value="" selected disabled>Select Project</option>
                                        @foreach($projects as $project)
                                            <option value="{{ $project->projects->id }}">{{ $project->projects->project_name_en }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="input-options">
                                    <label>To</label>
                                    <select name="to" id="to">
                                        <option value="" selected disabled>Select User</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->fname }} {{ $user->lname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="text-notificcation-box">
                                    <textarea name="desc" id="" cols="30" rows="10"
                                              placeholder="Inset notification text here.."
                                              class="custom-textarea"></textarea>
                                </div>
                                <div class="post-notif_button">
                                    <button type="submit" class="dashboard-save">Post</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="funding-campaign-table funding-notification-table">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <h4 class="campaign-text">List Of Notifications</h4>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="table-responsive custom-table">
                                <table class="table noti-table">
                                    <thead>
                                    <tr>
                                        <th class="for-left-td">Notification ID</th>
                                        <th>Subject</th>
                                        <th>Purpose</th>
                                        <th>To</th>
                                        <th>Project Name</th>
                                        <th>Text</th>
{{--                                        <th>Status</th>--}}
                                        <th class="for-right-td"></th>
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
        $(function () {
            var table = $('.noti-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.notifications.list') }}",
                oLanguage: {sLengthMenu: " _MENU_ entries"},
                columns: [
                    {data: 'id'},
                    {data: 'subject'},
                    {data: 'purpose'},
                    {data: 'to'},
                    {data: 'project_name'},
                    {data: 'text'},
                    // {data: 'action', orderable: false, searchable: false},
                ]
            });
        });

        $('#project_name').on('change', function(e) {
            var project_id = $('#project_name').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.get.project.investors') }}",
                method: 'post',
                data: {
                    project_id: project_id,
                },
                success: function(result) {
                    $('#to').empty();
                    $('#to').append(result.data);
                }
            });
        });
    </script>
@endsection
