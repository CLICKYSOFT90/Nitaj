@extends('layouts.investor.investor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Add Vote Campaign</title>
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
                        <li class="tags-list-item"><a href="javascriptvoid:(0)" class="tags-list-text">Create a new vote
                                campaign</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="campaign-field-text container">
            <div class="d-flex flex-column-fluid">
                <form action="{{ route('admin.vote-campaign.add') }}" method="post" id="form">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="input-options">
                                    <label>Project Name </label>
                                    <select name="project_id" id="project_id" class="@error('project_id') is-invalid @enderror" >
                                        <option disabled selected value="">Select project</option>
                                        @foreach($campaign_projects as $project)
                                        <option value="{{ $project->projects->id }}" {{ old('project_id') == $project->projects->id ? 'selected' : '' }}>{{ $project->projects->project_name_en }}</option>
                                        @endforeach
                                    </select>
                                    @error('project_id')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="input-options">
                                    <label>Vote Type</label>
                                    <select name="vote_type" id="vote_type" class="@error('vote_type') is-invalid @enderror">
                                        <option disabled selected value="">Select Vote Type</option>
                                        <option value="Extend or Sell" {{ old('vote_type') == 'Extend or Sell' ? 'selected' : '' }}>Extend or Sell</option>
                                        <option value="Agree or Disagree" {{ old('vote_type') == 'Agree or Disagree' ? 'selected' : '' }}>Agree or Disagree</option>
                                        <option value="Accept or Reject" {{ old('vote_type') == 'Accept or Reject' ? 'selected' : '' }}>Accept or Reject </option>
                                    </select>
                                    @error('vote_type')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="input-options">
                                    <label>Starting Period</label>
                                    <input type="text" name="starting_period" id="starting_period" class="datepicker @error('starting_period') is-invalid @enderror" value="{{ old('starting_period') }}">
                                    @error('starting_period')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="input-options">
                                    <label>Ending Period</label>
                                    <input type="text" name="ending_period" id="ending_period" class="datepicker @error('ending_period') is-invalid @enderror" value="{{ old('ending_period') }}">
                                    @error('ending_period')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="v_campaigns">
{{--                                    <button type="button" class="dashboard-reset">Save</button>--}}
                                    <button type="submit" class="dashboard-save">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#form').validate({
                rules:{
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
