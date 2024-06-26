@extends('layouts.investor.investor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | View Vote Campaign</title>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="help_sec vote-sec-text">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <ul class="tags-listing">
                        <li class="tags-list-item"><a href="{{ route('admin.vote-campaign') }}" class="tags-list-text"><i
                                    class="fa fa-angle-left tag-icon" aria-hidden="true"></i> Back</a></li>
                        <li class="tags-list-item"><a href="javascriptvoid:(0)" class="tags-list-text for-color">Vote
                                Campaigns</a></li>
                        <li class="tags-list-item"><a href="javascriptvoid:(0)" class="tags-list-text"><i
                                    class="fa fa-angle-double-right tag-icon" aria-hidden="true"></i></a></li>
                        <li class="tags-list-item"><a href="javascriptvoid:(0)" class="tags-list-text">View vote
                                campaign</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="campaign-field-text">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="input-options">
                                <label>Project Name </label>
                                <select name="project_id" id="project_id" disabled>
                                    <option disabled selected value="">Select project</option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}" {{ $project->id == $vote_campaign->project_id ? 'selected' : '' }}>{{ $project->project_name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="input-options">
                                <label>Vote Type</label>
                                <select name="vote_type" id="vote_type" disabled>
                                    <option disabled selected value="">Select Vote Type</option>
                                    <option value="Extend or Sell" {{ $vote_campaign->vote_type == 'Extend or Sell' ? 'selected' : '' }}>Extend or Sell</option>
                                    <option value="Agree or Disagree" {{ $vote_campaign->vote_type == 'Agree or Disagree' ? 'selected' : '' }}>Agree or Disagree</option>
                                    <option value="Accept or Reject" {{ $vote_campaign->vote_type == 'Accept or Reject' ? 'selected' : '' }}>Accept or Reject</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="input-options">
                                <label>Starting Period</label>
                                <input type="text" name="starting_period" id="starting_period" class="" value="{{ date('d-M-y', strtotime($vote_campaign->starting_period)) }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="input-options">
                                <label>Ending Period</label>
                                <input type="text" name="ending_period" id="ending_period" class="" value="{{ date('d-M-y', strtotime($vote_campaign->ending_period)) }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#form').validate({
            rules: {
                project_id: {
                    required: true
                },
                vote_type: {
                    required: true
                },
                starting_period: {
                    required: true
                },
                ending_period: {
                    required: true
                }
            },
            messages: {
                project_id: {
                    required: '{{ __('auth.required') }}'
                },
                vote_type: {
                    required: '{{ __('auth.required') }}'
                },
                starting_period: {
                    required: '{{ __('auth.required') }}'
                },
                ending_period: {
                    required: '{{ __('auth.required') }}'
                }
            }
        });
    </script>
@endsection
