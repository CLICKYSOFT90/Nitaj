@extends('layouts.investor.investor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Edit Funding Campaign</title>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="help_sec">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <ul class="tags-listing">
                        <li class="tags-list-item">
                            <a href="{{ route('admin.funding-campaign') }}" class="tags-list-text">
                                <i class="fa fa-angle-left tag-icon" aria-hidden="true"></i>
                                Back
                            </a>
                        </li>
                        <li class="tags-list-item">
                            <a href="javascriptvoid:(0)" class="tags-list-text for-color">Funding Campaign</a>
                        </li>
                        <li class="tags-list-item">
                            <a href="javascriptvoid:(0)" class="tags-list-text">
                                <i class="fa fa-angle-double-right tag-icon" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="tags-list-item">
                            <a href="javascriptvoid:(0)" class="tags-list-text">Edit Funding Campaign</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="complain_sec pro-sec">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="pro-info">
                                Add New Funding Campaign
                                <span class="float-right"> إضافة حملة تمويل جديدة</span>
                            </h2>
                        </div>
                    </div>
                    <form action="{{ route('admin.funding-campaign.edit', $campaign->id) }}" method="post" id="form">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-12">
                                <div class="input-options">
                                    <label>Project Name</label>
                                    <select name="proj_name"
                                            class="@error('proj_name') is-invalid @enderror" id="project">
                                        <option value="" selected="" disabled="">Select Project</option>
                                        @foreach($projects as $project)
                                            <option value="{{ $project->id }}" {{ $project->id == $campaign->project_id ? 'selected' : '' }}>{{ $project->project_name_en }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('proj_name')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                            <div class="col-md-3 col-sm-3 col-12">
                                <div class="input-options">
                                    <label>Campaign Type</label>
                                    <input type="text" readonly placeholder="Campaign Type" name="campaign_type" id="campaign_type"
                                           class="@error('campaign_type') is-invalid @enderror" value="{{ $campaign->campaign_type }}">
                                </div>
                                @error('campaign_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-3 col-sm-3 col-12">
                                <div class="input-options">
                                    <label>Starting Period</label>
                                    <input type="date" placeholder="From" name="start_period"
                                           class="@error('start_period') is-invalid @enderror" value="{{ $campaign->starting_period }}">
                                    @error('start_period')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-12">
                                <div class="input-options">
                                    <label>Ending Period</label>
                                    <input type="date" placeholder="To" name="ending_period"
                                           class="@error('ending_period') is-invalid @enderror" value="{{ $campaign->ending_period }}">
                                    @error('ending_period')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-12">
                                <div class="input-options">
                                    <label>Amount Required</label>
                                    <input type="text" placeholder="Amount Required" name="amount_req"
                                           class="@error('amount_req') is-invalid @enderror" value="{{ $campaign->amount_required }}">
                                    @error('amount_req')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-12">
                                <div class="input-options">
                                    <label>Funding Phases</label>
                                    <select name="funding_phases"
                                            class="@error('funding_phases') is-invalid @enderror">
                                        <option value="" selected="" disabled="">Select Funding Phases</option>
                                        <option value="1" {{ $campaign->funding_phases == 1 ? 'selected' : '' }}>1</option>
                                    </select>
                                </div>
                                @error('funding_phases')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        @foreach($campaign->campaign_phase as $key => $campaign_phase)
                        <div class="row">
                            <div class="col-12">
                                <h2 class="pro-info mt-10">
                                    Funding Phase {{ ++$key }}
                                </h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-12">
                                <div class="input-options">
                                    <label>Minimun Investment</label>
                                    <input type="text" placeholder="Insert Amount" name="min_amount"
                                           class="@error('min_amount') is-invalid @enderror" value="{{ $campaign_phase->min_investment }}">
                                    @error('min_amount')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-12">
                                <div class="input-options">
                                    <label>Starting Period</label>
                                    <input type="date" placeholder="From" name="phase_start_period"
                                           class="@error('phase_start_period') is-invalid @enderror" value="{{ $campaign_phase->phase_start }}">
                                    @error('phase_start_period')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-12">
                                <div class="input-options">
                                    <label>Ending Period</label>
                                    <input type="date" placeholder="To" name="phase_ending_period"
                                           class="@error('phase_ending_period') is-invalid @enderror" value="{{ $campaign_phase->phase_end }}">
                                    @error('phase_ending_period')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="dashboard-buttons">
                                    <button type="submit" class="dashboard-save">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('scripts')
    <script>

        $(document).ready(function () {

            //Get Category
            $('#project').on('change', function (e) {
                var project_id = $('#project').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('projectCategory') }}",
                    method: 'post',
                    data: {
                        project_id: project_id,
                    },
                    success: function (result) {
                        $('#campaign_type').empty();
                        $('#campaign_type').val(result.data);
                    }
                });
            });


            $('#form').validate({
                rules: {
                    proj_name: {
                        required: true,
                    },
                    campaign_type: {
                        required: true,
                    },
                    start_period: {
                        required: true,
                    },
                    ending_period: {
                        required: true,
                    },
                    amount_req: {
                        required: true,
                    },
                    min_amount: {
                        required: true,
                    },
                    funding_phases: {
                        required: true,
                    },
                    phase_start_period: {
                        required: true,
                    },
                    phase_ending_period: {
                        required: true,
                    },
                }, messages: {
                    proj_name: {
                        required: '{{ __('auth.required') }}',
                    },
                    campaign_type: {
                        required: '{{ __('auth.required') }}',
                    },
                    start_period: {
                        required: '{{ __('auth.required') }}',
                    },
                    ending_period: {
                        required: '{{ __('auth.required') }}',
                    },
                    amount_req: {
                        required: '{{ __('auth.required') }}',
                    },
                    min_amount: {
                        required: '{{ __('auth.required') }}',
                    },
                    funding_phases: {
                        required: '{{ __('auth.required') }}',
                    },
                    phase_start_period: {
                        required: '{{ __('auth.required') }}',
                    },
                    phase_ending_period: {
                        required: '{{ __('auth.required') }}',
                    },
                }
            });
        });
    </script>
@endsection
