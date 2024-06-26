@extends('layouts.investor.investor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | View Fund Raising Request</title>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="help_sec">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <ul class="tags-listing">
                        <li class="tags-list-item">
                            <a href="{{ url()->previous() }}" class="tags-list-text">
                                <i class="fa fa-angle-left tag-icon" aria-hidden="true"></i>
                                Back
                            </a>
                        </li>
                        <li class="tags-list-item">
                            <a href="javascriptvoid:(0)" class="tags-list-text for-color">Fund Request</a>
                        </li>
                        <li class="tags-list-item">
                            <a href="javascriptvoid:(0)" class="tags-list-text">
                                <i class="fa fa-angle-double-right tag-icon" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="tags-list-item">
                            <a href="javascriptvoid:(0)" class="tags-list-text">View Fund Raising Request</a>
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
                                View Fund Raising Request
                            </h2>
                        </div>
                    </div>
                    <form action="{{ route('admin.category.add') }}" method="post" id="form">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-12">
                                <div class="input-options">
                                    <label>Individual / group of investors or Company ?</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->investor_type }}">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-12">
                                <div class="input-options">
                                    <label>Occupation</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->occupation }}">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-12">
                                <div class="input-options">
                                    <label>Company Name</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->company_name }}">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-12">
                                <div class="input-options">
                                    <label>Amount</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->amount.' SAR' }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-10">
                                <h3>Company Address</h3>
                            </div>
                            <div class="col-md-4 col-sm-4 col-12">
                                <div class="input-options">
                                    <label>Email</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->email }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-12">
                                <div class="input-options">
                                    <label>Contact</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->contact }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-12">
                                <div class="input-options">
                                    <label>Unit No</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->unit_no }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-12">
                                <div class="input-options">
                                    <label>Street</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->street }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-12">
                                <div class="input-options">
                                    <label>District</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->district }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-12">
                                <div class="input-options">
                                    <label>City</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->city }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-12">
                                <div class="input-options">
                                    <label>Country</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->country }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-12">
                                <div class="input-options">
                                    <label>Zip Code</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->zip_code }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-12">
                                <div class="input-options">
                                    <label>Company CR. No.</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->company_cr }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-12">
                                <div class="input-options">
                                    <label>Company Profile Attachment</label>
                                    <a href="{{ asset('funding-request/profile_attachment'.'/'.$funding_request->profile_attachment ) }}" target="_blank">{{ $funding_request->profile_attachment }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-10">
                                <h3>Project Info</h3>
                            </div>
                            <div class="col-md-3 col-sm-3 col-12">
                                <div class="input-options">
                                    <label>Project Type</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->project_type }}">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-12">
                                <div class="input-options">
                                    <label>Asset Type</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->asset_type }}">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-12">
                                <div class="input-options">
                                    <label>Land status?</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->land_status }}">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-12">
                                <div class="input-options">
                                    <label>Location</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->location }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="input-options">
                                    <label>Project Details & Objectives</label>
                                    <textarea class="form-input form-control" rows="10" readonly>{{ $funding_request->project_details }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-12">
                                <div class="input-options">
                                    <label>Project Document Uploads</label>
                                    <a href="{{ asset('funding-request/project_doc_attachment'.'/'. $funding_request->project_doc_attachment) }}" target="_blank">{{ $funding_request->project_doc_attachment }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-10">
                                <h3>Funding</h3>
                            </div>
                            <div class="col-md-3 col-sm-3 col-12">
                                <div class="input-options">
                                    <label>Funding Structure</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->funding_structure }}">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-12">
                                <div class="input-options">
                                    <label>Project Value</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->proj_value }}">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-12">
                                <div class="input-options">
                                    <label>How much capital will you contribute?</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->cap_contribute }}">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-12">
                                <div class="input-options">
                                    <label>Current Loans/Other Liabilities?</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->loan_liability }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-12">
                                <div class="input-options">
                                    <label>FundRaising required?</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->fundraising_required }}">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-12">
                                <div class="input-options">
                                    <label>How soon do you need the capital?</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->need_capital }}">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-12">
                                <div class="input-options">
                                    <label>Expected ROI?</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->expected_roi }}">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-12">
                                <div class="input-options">
                                    <label>Expected Dividends yield?</label>
                                    <input type="text" placeholder="Name" readonly
                                           value="{{ $funding_request->expected_dividends }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-10">
                                <h3>Other Uploads</h3>
                            </div>
                            <div class="col-md-4 col-sm-4 col-12">
                                <div class="input-options">
                                    <label>Valuations</label>
                                    <a href="{{ asset('funding-request/valuations'.'/'.$funding_request->valuations ) }}" target="_blank">{{ $funding_request->valuations }}</a>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-12">
                                <div class="input-options">
                                    <label>CR</label>
                                    <a href="{{ asset('funding-request/cr'.'/'.$funding_request->cr ) }}" target="_blank">{{ $funding_request->cr }}</a>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-12">
                                <div class="input-options">
                                    <label>Feasibility Status</label>
                                    <a href="{{ asset('funding-request/feasibility_status'.'/'.$funding_request->feasibility_status ) }}" target="_blank">{{ $funding_request->feasibility_status }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            $('#form').validate({
                rules: {
                    name_en: {
                        required: true,
                        maxlength: 50
                    },
                    name_ar: {
                        required: true,
                        maxlength: 50
                    },
                    prop_type_en: {
                        required: true,
                    },
                    prop_type_ar: {
                        required: true,
                    },
                },
                messages: {
                    name_en: {
                        required: '{{ __('auth.required') }}'
                    },
                    name_ar: {
                        required: '{{ __('auth.required') }}'
                    },
                    prop_type_en: {
                        required: '{{ __('auth.required') }}'
                    },
                    prop_type_ar: {
                        required: '{{ __('auth.required') }}'
                    }
                }
            });
        });
    </script>
    <script>
        $('.select').on('change', function () {

            $("select option:selected").addClass('select-black')
        });


    </script>
@endsection
