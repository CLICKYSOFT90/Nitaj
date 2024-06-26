@extends('layouts.app')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Fund Raising Request</title>
@endsection

@section('content')
    <section class="investor-signup invest_growth invs-signup-3">
        <div class="container">
            <form method="POST" action="{{ route('postFund-raising-request') }}" id="form" autocomplete="off"
                  enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-12"></div>
                    <div class="col-md-8 col-sm-8 col-12">
                        <div class="inv_snup">
                            <div class="investor_info-1 text-center">
                                <h2>{{ __('fund-raising-request.Fund Raising Request') }}</h2>
                                <p class="greetings_color">{{ __('fund-raising-request.greetings') }}</p>
                            </div>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="firm_sec text-center fund-form-main">
                            @csrf
                            <div class="row d-flex align-items-center">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="ikr_inp">
                                        <div class="form-group {{ old('investor_type') ? 'focused' : '' }}">
                                            <label class="form-label" for="investor_type">{{ __('fund-raising-request.Individual / group of investors or Company ?') }} </label>
                                            <input id="investor_type"
                                                   class="form-input @error('investor_type') is-invalid @enderror"
                                                   value="{{ old('investor_type') }}" name="investor_type" type="text"/>
                                            @error('investor_type')
                                            <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="select-fields for-drop-width">
                                        <label for="investor_type" class="investor-label ml-56" {{ __('fund-raising-request.I am a') }}</label>
                                        <select name="occupation" id="occupation" required>
                                            <option value="" selected>Select</option>
                                            <option value="Developer" {{ old('occupation') == 'Developer' ? 'selected' : '' }}>Developer</option>
                                            <option value="Contractor" {{ old('occupation') == 'Contractor' ? 'selected' : '' }}>Contractor</option>
                                            <option value="Individual Investor" {{ old('occupation') == 'Individual Investor' ? 'selected' : '' }}>Individual Investor</option>
                                            <option value="Representing a group of investors" {{ old('occupation') == 'Representing a group of investors' ? 'selected' : '' }}>Representing a group of
                                                investors
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="ikr_inp">
                                        <div class="form-group {{ old('company_name') ? 'focused' : '' }}">
                                            <label class="form-label" for="company_name">{{ __('fund-raising-request.Company Name') }}</label>
                                            <input id="company_name"
                                                   class="form-input @error('company_name') is-invalid @enderror"
                                                   value="{{ old('company_name') }}" name="company_name" type="text"/>
                                            @error('company_name')
                                            <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="ikr_inp">
                                        <div class="form-group {{ old('amount') ? 'focused' : '' }}">
                                            <label class="form-label" for="amount">{{ __('fund-raising-request.Amount') }}</label>
                                            <input id="amount"
                                                   class="form-input @error('amount') is-invalid @enderror"
                                                   value="{{ old('amount') }}" name="amount" type="text"
                                                   onkeyup="this.value=this.value.replace(/[^0-9]/g, '');"/>
                                            @error('amount')
                                            <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>{{ __('fund-raising-request.Company Address') }}</h3>
                                </div>
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="ikr_inp">
                                        <div class="form-group {{ old('email') ? 'focused' : '' }}">
                                            <label class="form-label" for="email">{{ __('fund-raising-request.Email') }}</label>
                                            <input id="email"
                                                   class="form-input @error('email') is-invalid @enderror"
                                                   value="{{ old('email') }}" name="email" type="text"/>
                                            @error('email')
                                            <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="ikr_inp">
                                        <div class="form-group {{ old('contact') ? 'focused' : '' }}">
                                            <label class="form-label" for="contact">{{ __('fund-raising-request.Contact') }}</label>
                                            <input id="contact" class="form-input @error('contact') is-invalid @enderror"
                                                   value="{{ old('contact') }}" name="contact" type="text"/>
                                            @error('contact')
                                            <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="ikr_inp">
                                        <div class="form-group {{ old('unit_no') ? 'focused' : '' }}">
                                            <label class="form-label" for="first">{{ __('fund-raising-request.Unit No') }}</label>
                                            <input id="unit_no"
                                                   class="form-input @error('unit_no') is-invalid @enderror"
                                                   value="{{ old('unit_no') }}" name="unit_no" type="text"/>
                                            @error('fname')
                                            <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="ikr_inp">
                                        <div class="form-group {{ old('street') ? 'focused' : '' }}">
                                            <label class="form-label" for="first">{{ __('fund-raising-request.Street') }}</label>
                                            <input id="street" class="form-input @error('street') is-invalid @enderror"
                                                   value="{{ old('street') }}" name="street" type="text"/>
                                            @error('fname')
                                            <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="ikr_inp">
                                        <div class="form-group {{ old('district') ? 'focused' : '' }}">
                                            <label class="form-label" for="first">{{ __('fund-raising-request.District') }}</label>
                                            <input id="district"
                                                   class="form-input @error('district') is-invalid @enderror"
                                                   value="{{ old('district') }}" name="district" type="text"/>
                                            @error('fname')
                                            <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="ikr_inp">
                                        <div class="form-group {{ old('city') ? 'focused' : '' }}">
                                            <label class="form-label" for="first">{{ __('fund-raising-request.City') }}</label>
                                            <input id="city" class="form-input @error('city') is-invalid @enderror"
                                                   value="{{ old('city') }}" name="city" type="text"/>
                                            @error('city')
                                            <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="ikr_inp">
                                        <div class="form-group {{ old('country') ? 'focused' : '' }}">
                                            <label class="form-label" for="first">{{ __('fund-raising-request.Country') }}</label>
                                            <input id="country"
                                                   class="form-input @error('country') is-invalid @enderror"
                                                   value="{{ old('country') }}" name="country" type="text"/>
                                            @error('fname')
                                            <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="ikr_inp">
                                        <div class="form-group {{ old('zip_code') ? 'focused' : '' }}">
                                            <label class="form-label" for="first">{{ __('fund-raising-request.Zip code') }}</label>
                                            <input id="zip_code"
                                                   class="form-input @error('zip_code') is-invalid @enderror"
                                                   value="{{ old('zip_code') }}" name="zip_code" type="text"/>
                                            @error('fname')
                                            <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12  col-12">
                                    <div class="ikr_inp">
                                        <div class="form-group {{ old('company_cr') ? 'focused' : '' }}">
                                            <label class="form-label" for="first">{{ __('fund-raising-request.Company CR. No. (If Applicable)') }}</label>
                                            <input id="company_cr"
                                                   class="form-input @error('company_cr') is-invalid @enderror"
                                                   value="{{ old('company_cr') }}" name="company_cr" type="text" style="width: 86%;"/>
                                            @error('fname')
                                            <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 col-sm-6  col-12 div-center">
                                    <label for="file" style="margin-left: -18px;">{{ __('fund-raising-request.Company profile attachment') }} </label>
                                </div>
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="custom-file-upload">
                                        <input type="file" id="profile_attachment" name="profile_attachment" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>{{ __('fund-raising-request.Project Info') }}</h3>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="select-fields for-drop-width">
                                        <label for="investor_type"
                                               class="investor-label ml-56">{{ __('fund-raising-request.Project Type') }}</label>
                                        <select name="project_type" id="project_type" required>
                                            <option value="" selected>Select</option>
                                            <option value="Development" {{ old('project_type') == 'Development' ? 'selected' : '' }}>Development</option>
                                            <option value="Acquisition" {{ old('project_type') == 'Acquisition' ? 'selected' : '' }}>Acquisition</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="select-fields for-drop-width">
                                        <label for="investor_type"
                                               class="investor-label ml-56">{{ __('fund-raising-request.Asset Type') }}</label>
                                        <select name="asset_type" id="asset_type" required>
                                            <option value="" selected>Select</option>
                                            <option value="Residential" {{ old('asset_type') == 'Residential' ? 'selected' : '' }}>Residential</option>
                                            <option value="Commercial" {{ old('asset_type') == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row d-flex align-items-center">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="select-fields for-drop-width">
                                            <label for="investor_type"
                                                   class="investor-label ml-56">{{ __('fund-raising-request.Land status?') }}</label>
                                            <select name="land_status" id="land_status" required>
                                                <option value="" selected>Select</option>
                                                <option value="Leased" {{ old('land_status') == 'Leased' ? 'selected' : '' }}>Leased</option>
                                                <option value="Owned" {{ old('land_status') == 'Owned' ? 'selected' : '' }}>Owned</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6  col-12">
                                        <div class="ikr_inp">
                                            <div class="form-group {{ old('location') ? 'focused' : '' }}">
                                                <label class="form-label" for="first">{{ __('fund-raising-request.Location') }}</label>
                                                <input id="location"
                                                       class="form-input @error('location') is-invalid @enderror"
                                                       value="{{ old('location') }}" name="location" type="text"/>
                                                @error('fname')
                                                <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12  col-12">
                                        <div class="ikr_inp">
                                            <div class="form-group {{ old('project_details') ? 'focused' : '' }}">
                                            <textarea id="project_details"
                                                      class="form-input @error('project_details') is-invalid @enderror"
                                                      name="project_details" placeholder="{{ __('fund-raising-request.Project Details & Objectives') }}" style="width: 86%;">{{ old('project_details') }}</textarea>
                                                @error('project_details')
                                                <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6 col-sm-6  col-12 div-center">
                                        <label for="file" style="margin-left: -48px;">{{ __('fund-raising-request.Project Document Uploads') }} </label>
                                    </div>
                                    <div class="col-md-6 col-sm-6  col-12">
                                        <div class="custom-file-upload">
                                            <input type="file" id="project_doc_attachment" name="project_doc_attachment" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Funding</h3>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="select-fields for-drop-width">
                                        <label for="funding_structure"
                                               class="investor-label ml-56">Funding Structure</label>
                                        <select name="funding_structure" id="funding_structure" required>
                                            <option value="" selected>Select Funding Structure</option>
                                            <option value="Equity" {{ old('funding_structure') == 'Equity' ? 'selected' : '' }}>Equity</option>
                                            <option value="Debt" {{ old('funding_structure') == 'Debt' ? 'selected' : '' }}>Debt</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="ikr_inp">
                                        <div class="form-group {{ old('proj_value') ? 'focused' : '' }}">
                                            <label class="form-label" for="first">Project Value</label>
                                            <input id="proj_value" class="form-input @error('proj_value') is-invalid @enderror"
                                                   value="{{ old('proj_value') }}" name="proj_value" type="text"/>
                                            @error('proj_value')
                                            <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="ikr_inp">
                                        <div class="form-group {{ old('cap_contribute') ? 'focused' : '' }}">
                                            <label class="form-label" for="first">How much capital will you contribute?</label>
                                            <input id="cap_contribute" class="form-input @error('cap_contribute') is-invalid @enderror"
                                                   value="{{ old('cap_contribute') }}" name="cap_contribute" type="text"/>
                                            @error('cap_contribute')
                                            <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="ikr_inp">
                                        <div class="form-group {{ old('loan_liability') ? 'focused' : '' }}">
                                            <label class="form-label" for="first">Current Loans/Other Liabilities?</label>
                                            <input id="loan_liability" class="form-input @error('loan_liability') is-invalid @enderror"
                                                   value="{{ old('loan_liability') }}" name="loan_liability" type="text"/>
                                            @error('loan_liability')
                                            <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="ikr_inp">
                                        <div class="form-group {{ old('fundraising_required') ? 'focused' : '' }}">
                                            <label class="form-label" for="first">FundRaising required?</label>
                                            <input id="fundraising_required" class="form-input @error('fundraising_required') is-invalid @enderror"
                                                   value="{{ old('fundraising_required') }}" name="fundraising_required" type="text"/>
                                            @error('fundraising_required')
                                            <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="ikr_inp">
                                        <div class="form-group {{ old('need_capital') ? 'focused' : '' }}">
                                            <label class="form-label" for="first">How soon do you need the capital?</label>
                                            <input id="need_capital" class="form-input @error('need_capital') is-invalid @enderror"
                                                   value="{{ old('need_capital') }}" name="need_capital" type="text"/>
                                            @error('need_capital')
                                            <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="ikr_inp">
                                        <div class="form-group {{ old('expected_roi') ? 'focused' : '' }}">
                                            <label class="form-label" for="first">Expected ROI?</label>
                                            <input id="expected_roi" class="form-input @error('expected_roi') is-invalid @enderror"
                                                   value="{{ old('expected_roi') }}" name="expected_roi" type="text"/>
                                            @error('expected_roi')
                                            <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="ikr_inp">
                                        <div class="form-group {{ old('expected_dividends') ? 'focused' : '' }}">
                                            <label class="form-label" for="first">Expected Dividends yield?</label>
                                            <input id="expected_dividends" class="form-input @error('expected_dividends') is-invalid @enderror"
                                                   value="{{ old('expected_dividends') }}" name="expected_dividends" type="text"/>
                                            @error('expected_dividends')
                                            <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Other Uploads</h3>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 col-sm-6  col-12 div-center">
                                    <label for="file" style="margin-left: -161px;">Valuations </label>
                                </div>
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="custom-file-upload">
                                        <input type="file" id="valuations" name="valuations"  accept="application/pdf"/>
                                    </div>
                                </div>
                                @error('valuations')
                                    <span class="invalid-feedback form-error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 col-sm-6  col-12 div-center">
                                    <label for="file" style="margin-left: -217px;">CR </label>
                                </div>
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="custom-file-upload">
                                        <input type="file" id="cr" name="cr"  accept="application/pdf"/>
                                    </div>
                                </div>
                                @error('cr')
                                <span class="invalid-feedback form-error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 col-sm-6  col-12 div-center">
                                    <label for="file" style="margin-left: -117px;">Feasibility Status </label>
                                </div>
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="custom-file-upload">
                                        <input type="file" id="feasibility_status" name="feasibility_status"  accept="application/pdf"/>
                                    </div>
                                </div>
                                @error('feasibility_status')
                                <span class="invalid-feedback form-error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fix-positioned">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-12">
                        </div>
                        <div class="col-md-6 col-sm-6 col-12">
                            <div class="next-1 text-center">
                                <input type="submit" class="btn-17 btn" value="{{ __('fund-raising-request.Submit') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('scripts')
    <script>

        (function ($) {
            // Browser supports HTML5 multiple file?
            var multipleSupport = typeof $("<input/>")[0].multiple !== "undefined",
                isIE = /msie/i.test(navigator.userAgent);

            $.fn.customFile = function () {
                return this.each(function () {
                    var $file = $(this).addClass("custom-file-upload-hidden"), // the original file input
                        $wrap = $('<div class="file-upload-wrapper">'),
                        $input = $('<input type="text" class="file-upload-input" />'),
                        // Button that will be used in non-IE browsers
                        $button = $(
                            '<button type="button" class="file-upload-button">Select a File</button>'
                        ),
                        // Hack for IE
                        $label = $(
                            '<label class="file-upload-button" for="' +
                            $file[0].id +
                            '">Select a File</label>'
                        );

                    // Hide by shifting to the left so we
                    // can still trigger events
                    $file.css({
                        position: "absolute",
                        left: "-9999px"
                    });

                    $wrap.insertAfter($file).append($file, $input, isIE ? $label : $button);

                    // Prevent focus
                    $file.attr("tabIndex", -1);
                    $button.attr("tabIndex", -1);

                    $button.click(function () {
                        $file.focus().click(); // Open dialog
                    });

                    $file.change(function () {
                        var files = [],
                            fileArr,
                            filename;

                        // If multiple is supported then extract
                        // all filenames from the file array
                        if (multipleSupport) {
                            fileArr = $file[0].files;
                            for (var i = 0, len = fileArr.length; i < len; i++) {
                                files.push(fileArr[i].name);
                            }
                            filename = files.join(", ");

                            // If not supported then just take the value
                            // and remove the path to just show the filename
                        } else {
                            filename = $file.val().split("\\").pop();
                        }

                        $input
                            .val(filename) // Set the value
                            .attr("title", filename) // Show filename in title tootlip
                            .focus(); // Regain focus
                    });

                    $input.on({
                        blur: function () {
                            $file.trigger("blur");
                        },
                        keydown: function (e) {
                            if (e.which === 13) {
                                // Enter
                                if (!isIE) {
                                    $file.trigger("click");
                                }
                            } else if (e.which === 8 || e.which === 46) {
                                // Backspace & Del
                                // On some browsers the value is read-only
                                // with this trick we remove the old input and add
                                // a clean clone with all the original events attached
                                $file.replaceWith(($file = $file.clone(true)));
                                $file.trigger("change");
                                $input.val("");
                            } else if (e.which === 9) {
                                // TAB
                                return;
                            } else {
                                // All other keys
                                return false;
                            }
                        }
                    });
                });
            };

            // Old browser fallback
            if (!multipleSupport) {
                $(document).on("change", "input.customfile", function () {
                    var $this = $(this),
                        // Create a unique ID so we
                        // can attach the label to the input
                        uniqId = "customfile_" + new Date().getTime(),
                        $wrap = $this.parent(),
                        // Filter empty input
                        $inputs = $wrap
                            .siblings()
                            .find(".file-upload-input")
                            .filter(function () {
                                return !this.value;
                            }),
                        $file = $(
                            '<input type="file" id="' +
                            uniqId +
                            '" name="' +
                            $this.attr("name") +
                            '"/>'
                        );

                    // 1ms timeout so it runs after all other events
                    // that modify the value have triggered
                    setTimeout(function () {
                        // Add a new input
                        if ($this.val()) {
                            // Check for empty fields to prevent
                            // creating new inputs when changing files
                            if (!$inputs.length) {
                                $wrap.after($file);
                                $file.customFile();
                            }
                            // Remove and reorganize inputs
                        } else {
                            $inputs.parent().remove();
                            // Move the input so it's always last on the list
                            $wrap.appendTo($wrap.parent());
                            $wrap.find("input").focus();
                        }
                    }, 1);
                });
            }
        })(jQuery);

        $("input[type=file]").customFile();
        // uploader js end


        $('#form').validate({
            rules: {
                investor_type: {
                    required: true,
                },
                occupation: {
                    required: true,
                },
                company_name: {
                    required: true,
                },
                email: {
                    required: true,
                },
                contact: {
                    required: true,
                },
                unit_no: {
                    required: true,
                },
                street: {
                    required: true,
                },
                district: {
                    required: true,
                },
                country: {
                    required: true,
                },
                city: {
                    required: true,
                },
                zip_code: {
                    required: true,
                },
                project_type: {
                    required: true,
                },
                asset_type: {
                    required: true,
                },
                land_status: {
                    required: true,
                },
                location: {
                    required: true,
                },
                project_details: {
                    required: true,
                },
                profile_attachment: {
                    required: true,
                },
                project_doc_attachment: {
                    required: true,
                },
                amount: {
                    required: true,
                },
                funding_structure: {
                    required: true,
                },
                proj_value: {
                    required: true,
                },
                cap_contribute: {
                    required: true,
                },
                loan_liability: {
                    required: true,
                },
                fundraising_required: {
                    required: true,
                },
                need_capital: {
                    required: true,
                },
                expected_roi: {
                    required: true,
                },
                expected_dividends: {
                    required: true,
                },
                valuations: {
                    required: true,
                },
                cr: {
                    required: true,
                },
                feasibility_status: {
                    required: true,
                }
            }, messages: {
                investor_type: {
                    required: '{{ __('auth.required') }}',
                },
                occupation: {
                    required: '{{ __('auth.required') }}',
                },
                company_name: {
                    required: '{{ __('auth.required') }}',
                },
                unit_no: {
                    required: '{{ __('auth.required') }}',
                },
                street: {
                    required: '{{ __('auth.required') }}',
                },
                district: {
                    required: '{{ __('auth.required') }}',
                },
                country: {
                    required: '{{ __('auth.required') }}',
                },
                city: {
                    required: '{{ __('auth.required') }}',
                },
                zip_code: {
                    required: '{{ __('auth.required') }}',
                },
                project_type: {
                    required: '{{ __('auth.required') }}',
                },
                asset_type: {
                    required: '{{ __('auth.required') }}',
                },
                land_status: {
                    required: '{{ __('auth.required') }}',
                },
                location: {
                    required: '{{ __('auth.required') }}',
                },
                project_details: {
                    required: '{{ __('auth.required') }}',
                },
                profile_attachment: {
                    required: '{{ __('auth.required') }}',
                },
                project_doc_attachment: {
                    required: '{{ __('auth.required') }}',
                },
                amount: {
                    required: '{{ __('auth.required') }}',
                },
                funding_structure: {
                    required: '{{ __('auth.required') }}',
                },
                proj_value: {
                    required: '{{ __('auth.required') }}',
                },
                cap_contribute: {
                    required: '{{ __('auth.required') }}',
                },
                loan_liability: {
                    required: '{{ __('auth.required') }}',
                },
                fundraising_required: {
                    required: '{{ __('auth.required') }}',
                },
                need_capital: {
                    required: '{{ __('auth.required') }}',
                },
                expected_roi: {
                    required: '{{ __('auth.required') }}',
                },
                expected_dividends: {
                    required: '{{ __('auth.required') }}',
                },
                valuations: {
                    required: '{{ __('auth.required') }}',
                },
                cr: {
                    required: '{{ __('auth.required') }}',
                },
                feasibility_status: {
                    required: '{{ __('auth.required') }}',
                }
            }
        });
    </script>
@endsection
