@extends('layouts.investor.investor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Edit Project</title>
@endsection

@section('content')
    @php $segment = Request::segment(3); @endphp
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="help_sec pt-0 pb-10">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <ul class="tags-listing">
                        <li class="tags-list-item"><a href="{{ route('admin.projects') }}" class="tags-list-text"><i
                                    class="fa fa-angle-left tag-icon" aria-hidden="true"></i> Back</a></li>
                        <li class="tags-list-item"><a href="javascriptvoid:(0)" class="tags-list-text for-color">Projects</a>
                        </li>
                        <li class="tags-list-item"><a href="javascriptvoid:(0)" class="tags-list-text"><i
                                    class="fa fa-angle-double-right tag-icon" aria-hidden="true"></i></a></li>
                        <li class="tags-list-item"><a href="javascriptvoid:(0)"
                                                      class="tags-list-text">{{ $segment == 'view' ? 'View Project' : 'Edit Project' }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="complain_sec pro-sec">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="multisteps-form__progress">
                                <button class="multisteps-form__progress-btn js-active info" type="button" title="User Info">
                                    <span>Project Info</span>
                                </button>
                                <button class="multisteps-form__progress-btn js-active details" type="button" title="Project Details">
                                    <span>Project Details</span>
                                </button>
                                <button class="multisteps-form__progress-btn js-active intro" type="button" title="Project Intro">
                                    <span>Project Intro</span>
                                </button>
                                <button class="multisteps-form__progress-btn js-active uploads" type="button" title="Project Uploads">
                                    <span>Project Uploads</span>
                                </button>
                                <button class="multisteps-form__progress-btn js-active location" type="button" title="Location">
                                    <span>Location</span>
                                </button>
                                <button class="multisteps-form__progress-btn js-active funding" type="button" title="Funding Info">
                                    <span>Funding Info</span>
                                </button>
                                <button class="multisteps-form__progress-btn js-active sponsors" type="button" title="Sponsors">
                                    <span>Sponsors</span>
                                </button>
                                <button class="multisteps-form__progress-btn js-active documents" type="button" title="Documents Attached">
                                    <span>Documents Attached</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h2 class="pro-info">Project Information</h2>
                        </div>
                    </div>
                    <div id="proj_info_error"></div>
                    <form id="proj_info">
                        <input type="hidden" name="project_id" value="{{ $projects->id }}">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="input-options">
                                            <label>Project Name</label>
                                            <input type="text" placeholder="Name"
                                                   {{ $segment == 'view' ? 'readonly' : '' }} name="project_name_en"
                                                   id="project_name"
                                                   required value="{{ $projects->project_name_en }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="input-options">
                                            <label>Country</label>
                                            <select {{ $segment == 'view' ? 'disabled' : '' }} name="country"
                                                    id="country">
                                                <option value="">Select Country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}"
                                                        {{ $projects->country == $country->id ? 'selected' : '' }}>
                                                        {{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12 dir-rtl">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12 dir-rtl">
                                        <div class="input-options">
                                            <label class="text-right">اسم المشروع</label>
                                            <input type="text" placeholder="اسم المشروع"
                                                   {{ $segment == 'view' ? 'readonly' : '' }} name="project_name_ar"
                                                   id="project_name" value="{{ $projects->project_name_ar }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="input-options">
                                            <label>Company</label>
                                            <select {{ $segment == 'view' ? 'disabled' : '' }} name="company_id"
                                                    id="company_id">
                                                <option selected disabled value="">Select Company</option>
                                                @foreach($companies as $company)
                                                    <option
                                                        value="{{ $company->id }}" {{ $company->id == $projects->company_id ? 'selected' : '' }}>{{ $company->name_en }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="input-options">
                                            <label>City</label>
                                            <select {{ $segment == 'view' ? 'disabled' : '' }} name="city" id="city">
                                                <option value="" disabled>Select City</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}"
                                                        {{ $city->id == $projects->city ? 'selected' : '' }}>
                                                        {{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-0 col-12">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="input-options">
                                            <label>Category</label>
                                            <select {{ $segment == 'view' ? 'disabled' : '' }} name="category">
                                                <option value="" disabled selected>Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $projects->category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name_en }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($segment == 'edit')
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="dashboard-buttons">
                                        <button type="button" class="dashboard-reset"
                                                onclick="this.form.reset(); $('#city').empty();">Reset
                                        </button>
                                        <button type="submit" class="dashboard-save">Save</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div id="div-hidden">
            <div class="pro-detail-sec">
                <div class="d-flex flex-column-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="pro-detail">Project Details</h2>
                            </div>
                        </div>
                        <div id="proj_type_error"></div>
                        <form id="proj_type">
                            <input type="hidden" name="project_id" value="{{ $projects->id }}">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>Project Type</label>
                                                <select {{ $segment == 'view' ? 'disabled' : '' }} name="proj_type_en"
                                                        id="proj_type">
                                                    <option value="" disabled> Select the Project Type</option>
                                                    <option value="Development"
                                                        {{ $projects->project_type_en == 'Development' ? 'selected' : '' }}>
                                                        Development
                                                    </option>
                                                    <option value="Acquisition"
                                                        {{ $projects->project_type_en == 'Acquisition' ? 'selected' : '' }}>
                                                        Acquisition
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>Asset Type</label>
                                                <select {{ $segment == 'view' ? 'disabled' : '' }} name="asset_type_en"
                                                        id="asset_type">
                                                    <option value="" disabled> Select the Project Type</option>
                                                    <optgroup label="Residential">
                                                        <option value="Villa"
                                                            {{ $projects->asset_type_en == 'Villa' ? 'selected' : '' }}>
                                                            Villa
                                                        </option>
                                                        <option value="Apartment"
                                                            {{ $projects->asset_type_en == 'Apartment' ? 'selected' : '' }}>
                                                            Apartment
                                                        </option>
                                                        <option value="Studio"
                                                            {{ $projects->asset_type_en == 'Studio' ? 'selected' : '' }}>
                                                            Studio
                                                        </option>
                                                        <option value="Townhouse"
                                                            {{ $projects->asset_type_en == 'Townhouse' ? 'selected' : '' }}>
                                                            Townhouse
                                                        </option>
                                                        <option value="Apartment Building"
                                                            {{ $projects->asset_type_en == 'Apartment Building' ? 'selected' : '' }}>
                                                            Apartment Building
                                                        </option>
                                                        <option value="Compound"
                                                            {{ $projects->asset_type_en == 'Compound' ? 'selected' : '' }}>
                                                            Compound
                                                        </option>
                                                    </optgroup>
                                                    <optgroup label="Commercial">
                                                        <option value="Apartment Complex"
                                                            {{ $projects->asset_type_en == 'Apartment Complex' ? 'selected' : '' }}>
                                                            Apartment Complex
                                                        </option>
                                                        <option value="Villa Compound"
                                                            {{ $projects->asset_type_en == 'Villa Compound' ? 'selected' : '' }}>
                                                            Villa Compound
                                                        </option>
                                                        <option value="Industrial "
                                                            {{ $projects->asset_type_en == 'Industrial' ? 'selected' : '' }}>
                                                            Industrial
                                                        </option>
                                                        <option value="Office Building"
                                                            {{ $projects->asset_type_en == 'Office Building' ? 'selected' : '' }}>
                                                            Office Building
                                                        </option>
                                                        <option value="Hotels"
                                                            {{ $projects->asset_type_en == 'Hotels' ? 'selected' : '' }}>
                                                            Hotels
                                                        </option>
                                                        <option value="Medical"
                                                            {{ $projects->asset_type_en == 'Medical' ? 'selected' : '' }}>
                                                            Medical
                                                        </option>
                                                        <option value="Vacation Home"
                                                            {{ $projects->asset_type_en == 'Vacation Home' ? 'selected' : '' }}>
                                                            Vacation Home
                                                        </option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-0 col-12">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>نوع الأصول</label>
                                                <select {{ $segment == 'view' ? 'disabled' : '' }} name="asset_type_ar"
                                                        id="asset_type_ar">
                                                    <option value="" disabled>حدد نوع المشروع</option>
                                                    <optgroup label="سكني">
                                                        <option value="فيلا"
                                                            {{ $projects->asset_type_ar == 'فيلا' ? 'selected' : '' }}>
                                                            فيلا
                                                        </option>
                                                        <option value="شقة"
                                                            {{ $projects->asset_type_ar == 'شقة' ? 'selected' : '' }}>
                                                            شقة
                                                        </option>
                                                        <option value="ستوديو"
                                                            {{ $projects->asset_type_ar == 'ستوديو' ? 'selected' : '' }}>
                                                            ستوديو
                                                        </option>
                                                        <option value="تاون هاوس"
                                                            {{ $projects->asset_type_ar == 'تاون هاوس' ? 'selected' : '' }}>
                                                            تاون هاوس
                                                        </option>
                                                        <option value="مبنى سكني"
                                                            {{ $projects->asset_type_ar == 'مبنى سكني' ? 'selected' : '' }}>
                                                            مبنى سكني
                                                        </option>
                                                        <option value="مُجَمَّع"
                                                            {{ $projects->asset_type_ar == 'مُجَمَّع' ? 'selected' : '' }}>
                                                            مُجَمَّع
                                                        </option>
                                                    </optgroup>
                                                    <optgroup label="تجاري">
                                                        <option value="مجمع سكني"
                                                            {{ $projects->asset_type_ar == 'مجمع سكني' ? 'selected' : '' }}>
                                                            مجمع سكني
                                                        </option>
                                                        <option value="مجمع فيلات"
                                                            {{ $projects->asset_type_ar == 'مجمع فيلات' ? 'selected' : '' }}>
                                                            مجمع فيلات
                                                        </option>
                                                        <option value="صناعي "
                                                            {{ $projects->asset_type_ar == 'صناعي' ? 'selected' : '' }}>
                                                            صناعي
                                                        </option>
                                                        <option value="مبنى إداري"
                                                            {{ $projects->asset_type_ar == 'مبنى إداري' ? 'selected' : '' }}>
                                                            مبنى إداري
                                                        </option>
                                                        <option value="الفنادق"
                                                            {{ $projects->asset_type_ar == 'الفنادق' ? 'selected' : '' }}>
                                                            الفنادق
                                                        </option>
                                                        <option value="طبي"
                                                            {{ $projects->asset_type_ar == 'طبي' ? 'selected' : '' }}>
                                                            طبي
                                                        </option>
                                                        <option value="منزل الأجازة"
                                                            {{ $projects->asset_type_ar == 'منزل الأجازة' ? 'selected' : '' }}>
                                                            منزل الأجازة
                                                        </option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12 dir-rtl">
                                            <div class="input-options">
                                                <label class="text-right">نوع المشروع</label>
                                                <select {{ $segment == 'view' ? 'disabled' : '' }} name="proj_type_ar"
                                                        id="proj_type_ar">
                                                    <option value="" disabled> حدد نوع المشروع</option>
                                                    <option value="التطور"
                                                        {{ $projects->project_type_ar == 'التطور' ? 'selected' : '' }}>
                                                        التطور
                                                    </option>
                                                    <option value="اكتساب"
                                                        {{ $projects->project_type_ar == 'اكتساب' ? 'selected' : '' }}>
                                                        اكتساب
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column-fluid">
                                    <div class="container">
                                        <div class="col-12">
                                            <h2 class="pro-detail">
                                                Project Introduction
                                                <span class="float-right"> مقدمة المشروع</span>
                                            </h2>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="text-area-box">
                                                    <textarea cols="4" rows="8"
                                                              {{ $segment == 'view' ? 'readonly' : '' }} name="proj_intro_en"
                                                              id="proj_intro_en"
                                                              placeholder="Insert your text here">{{ $projects->project_intro_en }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-12 dir-rtl">
                                                <div class="text-area-box">
                                                    <textarea cols="4" rows="8"
                                                              {{ $segment == 'view' ? 'readonly' : '' }} name="proj_intro_ar"
                                                              id="proj_intro_ar"
                                                              placeholder="أدخل النص الخاص بك هنا">{{ $projects->project_intro_ar }}</textarea>
                                                </div>
                                            </div>

                                        </div>
{{--                                        @if($segment == 'edit')--}}
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-12">
                                                    <div class="dashboard-buttons">
                                                        <button type="button" class="dashboard-reset"
                                                                onclick="this.form.reset();">Resets
                                                        </button>
                                                        <button type="submit" class="dashboard-save">Save</button>
                                                    </div>
                                                </div>
                                            </div>
{{--                                        @endif--}}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="pro-uploads pro-edit-uploads">
                <div class="d-flex flex-column-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="pro-detail">Project Visual Uploads</h2>
                            </div>
                        </div>
                        <div id="pro-uploads_error"></div>
                        <form id="pro-uploads" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="table-responsive">
                                        <table class="table append-div">
                                            <tbody>
                                            <input type="hidden" name="project_id" value="{{ $projects->id }}">
                                            @foreach($projects->projectImages as $key => $projectImages)
                                                <tr>
                                                    <input type="hidden" value="{{ $projectImages->id }}"
                                                           {{ $segment == 'view' ? 'readonly' : '' }} name="uploads_id[]">
                                                    <td width="30%"><img width="230px" id="first-img-{{$key}}"
                                                                         src="{{ url('project-visual-uploads').'/'.$projectImages->filename }}">
                                                    </td>
                                                    <td width="36%" class="visual-type-text">
                                                        <label>File name</label>
                                                        <input type="text"
                                                               {{ $segment == 'view' ? 'readonly' : '' }} name="file_name_old[]"
                                                               placeholder="Name"
                                                               value="{{ $projectImages->filename }}"
                                                               id="first-name-{{$key}}" readonly>
                                                    </td>
                                                    <td width="30%">
                                                        <div class="browse">
                                                            <label class="dashboard-reset"> Browse
                                                                <input type="file"
                                                                       {{ $segment == 'view' ? 'disabled' : '' }} name="visual_upload_old[]"
                                                                       id="first-file-{{$key}}"
                                                                       class="input-upload"
                                                                       accept="image/jpeg, image/jpg, image/png"
                                                                       onchange="uploadImage(this, 'first-img-{{$key}}', 'first-name-{{$key}}','first-file-{{$key}}')">
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="delete-upload">
                                                            <i class="fa fa-times cross-sign"
                                                               data-id="{{ $projectImages->id }}"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if($segment == 'edit')
                                        <div class="row df_aic">
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="for-adding-new-project-button">
                                                    <a href="javascriptvoid:(0)" class="dashboard-save add-new">ADD
                                                        NEW </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="funding-buttons for-alignment">
                                                    <button type="submit" class="dashboard-save uploads-save">Save
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="pro-location">
                <div class="d-flex flex-column-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="pro-detail">Select Project Location</h2>
                            </div>
                        </div>
                        <div id="pro-location_error"></div>
                        <form id="pro-location">
                            <div class="row">
                                <input type="hidden" name="project_id" value="{{ $projects->id }}">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label>Location</label>
                                        <input type="text" placeholder="Location" id="location"
                                               {{ $segment == 'view' ? 'readonly' : '' }} name="location"
                                               value="{{ $projects->project_location }}">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="google-map">
                                        <div id="map">
                                            <iframe width="100%" height="245px" frameborder="0"
                                                    style="border:0;margin-top: 10px;"
                                                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBOfpaMO_tMMsuvS2T4zx4llbtsFqMuT9Y&q=' + {{ $projects->project_location }}"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($segment == 'edit')
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-12">
                                        <div class="location-buttons">
                                            <button type="button" class="dashboard-reset" onclick="this.form.reset();">
                                                Resets
                                            </button>
                                            <button type="submit" class="dashboard-save">Save</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            <div class="pro-funding-info">
                <div class="d-flex flex-column-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="pro-info">Funding Info</h2>
                            </div>
                        </div>
                        <div id="pro-funding-info_error"></div>
                        <form id="pro-funding-info">
                            <input type="hidden" name="project_id" value="{{ $projects->id }}">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>Funding Required</label>
                                                <input type="number" placeholder="Amount"
                                                       {{ $segment == 'view' ? 'readonly' : '' }} name="funding_required"
                                                       id="funding_required"
                                                       value="{{ !empty($projects->projectFunding->funding_required) ? $projects->projectFunding->funding_required : ''  }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>Min Investment</label>
                                                <input type="number" placeholder="Amount"
                                                       {{ $segment == 'view' ? 'readonly' : '' }} name="min_investment"
                                                       id="min_investment" onkeyup="calcNoOfShares(this)"
                                                       value="{{ !empty($projects->projectFunding->min_investment) ? $projects->projectFunding->min_investment : '' }}">
                                                <span id="c-error"></span>
                                            </div>
                                            <div class="error" id="min_invest"></div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>No. of Shares</label>
                                                <input type="text" placeholder="Insert no. of shares"
                                                       {{ $segment == 'view' ? 'readonly' : '' }} name="no_of_shares"
                                                       id="no_of_shares" readonly
                                                       value="{{ !empty($projects->projectFunding->no_of_shares) ? $projects->projectFunding->no_of_shares : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>Unit Price</label>
                                                <input type="text" placeholder="Insert Value per share"
                                                       name="price_per_share" id="price_per_share" readonly
                                                       value="{{ !empty($projects->projectFunding->price_per_share) ? $projects->projectFunding->price_per_share : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>Projected ROI %</label>
                                                <input type="text" placeholder="Inserted ROI"
                                                       {{ $segment == 'view' ? 'readonly' : '' }} name="projected_roi"
                                                       value="{{ !empty($projects->projectFunding->project_roi) ? $projects->projectFunding->project_roi : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>Investment Period</label>
                                                <select
                                                    {{ $segment == 'view' ? 'disabled' : '' }} name="investment_period">
                                                    <option value="" disabled selected>Select Investment Period</option>
                                                    @php $i = 0; @endphp
                                                    @for ($i = 1; $i < 11; $i++)
                                                        <option value="{{ $i }}"
                                                            {{ (!empty($projects->projectFunding->investment_period) ? $projects->projectFunding->investment_period : '') == $i ? 'selected' : '' }}>
                                                            {{ $i }}
                                                            Years
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>Structure</label>
                                                <select {{ $segment == 'view' ? 'disabled' : '' }} name="structure">
                                                    <option value="" disabled selected>Select Structure</option>
                                                    <option value="Equity"
                                                        {{ (!empty($projects->projectFunding->structure) ? $projects->projectFunding->structure : '') == 'Equity' ? 'selected' : '' }}>
                                                        Equity
                                                    </option>
                                                    <option value="Debt"
                                                        {{ (!empty($projects->projectFunding->structure) ? $projects->projectFunding->structure : '') == 'Debt' ? 'selected' : '' }}>
                                                        Debt
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>Fund Subscription</label>
                                                <input type="text" placeholder="Subscription Fee"
                                                       {{ $segment == 'view' ? 'readonly' : '' }} name="subscription_fee"
                                                       value="{{ !empty($projects->projectFunding->subscription_fee) ? $projects->projectFunding->subscription_fee : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>Projected Dividend Yield %</label>
                                                <input type="text" placeholder="Inserted dividend yield"
                                                       {{ $segment == 'view' ? 'readonly' : '' }} name="dividend_yield"
                                                       value="{{ !empty($projects->projectFunding->dividend_yield) ? $projects->projectFunding->dividend_yield : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>Dividend Frequency</label>
                                                <select
                                                    {{ $segment == 'view' ? 'disabled' : '' }} name="dividend_frequency">
                                                    <option value="" disabled selected>Select Dividend Frequency</option>
                                                        <option value="monthly"
                                                            {{ $projects->projectFunding->dividend_frequency == 'monthly'  ? 'selected' : '' }}>
                                                            Monthly
                                                        </option>
                                                        <option value="Quarterly"
                                                            {{ $projects->projectFunding->dividend_frequency == 'quarterly'  ? 'selected' : '' }}>
                                                            Quarterly
                                                        </option>
                                                        <option value="semi annually"
                                                            {{ $projects->projectFunding->dividend_frequency == 'semi annually'  ? 'selected' : '' }}>
                                                            Semi Annually
                                                        </option>
                                                        <option value="yearly"
                                                            {{ $projects->projectFunding->dividend_frequency == 'yearly'  ? 'selected' : '' }}>
                                                            Yearly
                                                        </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-0 col-12">
                                </div>
                            </div>
                            @if($segment == 'edit')
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-12">
                                        <div class="funding-buttons funding-buttons-reset">
                                            <button type="button" class="dashboard-reset" onclick="this.form.reset();">
                                                Resets
                                            </button>
                                            <button type="submit" class="dashboard-save">Save</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            <div class="pro-sponsor-info {{ $segment == 'view' ? 'mt-10' : '' }}">
                <div class="d-flex flex-column-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="pro-sponsor">Sponsors</h2>
                                <div class="sponsor-buttons">
                                </div>
                            </div>
                        </div>
                        <div id="pro-sponsor-info_error"></div>
                        <form id="pro-sponsor-info" enctype="multipart/form-data" accept-charset="utf-8">
                            <input type="hidden" name="project_id" value="{{ $projects->id }}">
                            @foreach ($projects->projectSponsors as $key => $sponsors)
                                <div class="row">
                                    <input type="hidden" value="{{ $sponsors->id }}"
                                           {{ $segment == 'view' ? 'readonly' : '' }} name="sponsor_id[]">
                                    <div class="col-md-7 col-sm-7 col-12">
                                        <div class="row sponsor-sec-row">
                                            <div class="col-md-1 col-sm-1 col-12">
                                                <div class="company-info">
                                                    <span>{{ ++$key }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-sm-5 col-12">
                                                <div class="company-info">
                                                    <input type="text" placeholder="Company Name"
                                                           {{ $segment == 'view' ? 'readonly' : '' }} name="company_name_old[]"
                                                           value="{{ $sponsors->company_name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-5 col-sm-5 col-12">
                                                <div class="company-info">
                                                    <input type="text" placeholder="Title"
                                                           {{ $segment == 'view' ? 'readonly' : '' }} name="company_title_old[]"
                                                           value="{{ $sponsors->title }}">
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-sm-1 col-12">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-1 col-sm-1 col-12">
                                            </div>
                                            <div class="col-md-10 col-sm-10 col-12">
                                                <div class="company-info">
                                            <textarea cols="4" rows="8"
                                                      placeholder="Insert your text here.."
                                                      {{ $segment == 'view' ? 'readonly' : '' }} name="company_info_old[]">{{ $sponsors->desc }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-sm-1 col-12">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-5 col-12">
                                        <div class="jack-profile">
                                            <img src="{{ url('project-sponsors') . '/' . $sponsors->filename }}"
                                                 id="first-{{ $key }}" class="img-fluid jack-1 mx-auto"
                                                 width="200px">
                                            <i class="fa fa-times cross-sign remove-sponsor"
                                               data-id="{{ $sponsors->id }}"></i>
                                        </div>
                                        <div class="jack-profile-buttons text-center">
                                            <div class="browse">
                                                <label class="dashboard-reset d-flex mx-auto"> Browse
                                                    <input type="file"
                                                           {{ $segment == 'view' ? 'disabled' : '' }} name="sponsor_upload_old[]"
                                                           id="files" accept="image/jpeg, image/jpg, image/png"
                                                           onchange="readURL(this, 'first-{{$key}}')"
                                                           class="input-upload">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="append-sponsor"></div>
                            @if($segment == 'edit')
                                <div class="row df_aic">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="for-adding-new-project-button">
                                            <a href="javascript:;" class="dashboard-save add-sponsor">ADD NEW </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="funding-buttons for-alignment">
                                            <button type="submit" class="dashboard-save spons-uploads">Save</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            <div class="pro-document-attach">
                <div class="d-flex flex-column-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="pro-document">Documents Attached</h2>
                            </div>
                        </div>
                        <div id="pro-document-attach_error"></div>
                        <form id="pro-document-attach" enctype="multipart/form-data">
                            <input type="hidden" name="project_id" value="{{ $projects->id }}">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="table-responsive">
                                        <table class="table append-doc">
                                            <tbody>
                                            @foreach($projects->projectDocuments as $key => $doc)
                                                @php
                                                    $ext = explode('.',$doc->doc_name)
                                                @endphp
                                                <tr>
                                                    <input type="hidden" value="{{ $doc->id }}"
                                                           {{ $segment == 'view' ? 'readonly' : '' }} name="doc_id[]">
                                                    <td width="35%" class="visual-type-text">
                                                        <div class="input-options">
                                                            <label>Name</label>
                                                            <input
                                                                {{ $segment == 'view' ? 'readonly' : '' }} name="doc_name_old[]"
                                                                type="text"
                                                                placeholder="Project Prospectus"
                                                                id="first-doc-{{ $key }}"
                                                                value="{{ $doc->doc_name }}" readonly>
                                                        </div>
                                                    </td>
                                                    <td class="file-ext" width="36%">
                                                        <label>File Type</label>
                                                        <img src="{{ asset('images/investor/'.$ext[1].'.png') }}"
                                                             id="first-image-{{ $key }}"
                                                             width="30px">
                                                        {{--                                                    <span>.pdf (Acrobat Reader)</span>--}}
                                                    </td>
                                                    <td class="tick-1 tb-button">
                                                        <div class="jack-profile-buttons text-center">
                                                            <div class="browse">
                                                                <label class="dashboard-reset d-flex mx-auto"> Browse
                                                                    <input type="file"
                                                                           {{ $segment == 'view' ? 'disabled' : '' }} name="doc_upload_old[]"
                                                                           id="first-file-doc-{{ $key }}"
                                                                           accept="application/pdf, application/doc, application/docx"
                                                                           onchange="readNameAndType(this, 'first-doc-{{ $key }}', 'first-file-doc-{{ $key }}','first-image-{{ $key }}')"
                                                                           class="input-upload">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    @if( $segment !== 'view')
                                                        <td><i class="fa fa-times cross-sign remove-doc"
                                                               data-id="{{ $doc->id }}"></i></td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @if($segment == 'edit')
                                <div class="row df_aic">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="for-adding-new-project-button">
                                            <a href="javascript:;" class="dashboard-save add-doc">ADD NEW</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="funding-buttons for-alignment">
                                            <button type="submit" class="dashboard-save doc-uploads">Save</button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>

        function checkMinInvestment(val) {
            var fund_required = $('#funding_required').val();
            var min_investment = $('#min_investment').val();
            console.log(min_investment, fund_required);
            if (min_investment > fund_required) {
                $('#c-error').html('<div class="alert alert-danger">Minimum investment should not be greater than fund required.</div>');
                $('#min_investment').val(min_investment.slice(0, -1));
                setTimeout(function () {
                    $('#c-error').empty();
                }, 3000);
            }
        }

        function calcNoOfShares(value){
            var fund_required = $('#funding_required').val();
            var no_of_shares = fund_required / value.value;
            $('#price_per_share').val(value.value);
            $('#no_of_shares').val(no_of_shares);

        }

        function calcPricePerShare(val) {
            var fund_required = $('#funding_required').val();
            var no_of_shares = $('#no_of_shares').val();
            var price_per_share = fund_required / no_of_shares;
            $('#price_per_share').val();
            $('#price_per_share').val(price_per_share);
        }

        function readURL(input, divName) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var file_name = input.files[0].name;
                var fileExtension = ['png', 'jpeg', 'jpg'];
                if ($.inArray(file_name.split('.').pop().toLowerCase(), fileExtension) == -1) {
                    alert("Only formats are allowed : " + fileExtension.join(', '));
                } else {

                    reader.onload = function (e) {
                        $('#' + divName).attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        }

        function readNameAndType(input, divName, file, image) {
            var fileExtension = ['pdf', 'doc', 'docx'];
            var i = $(this).prev('label').clone();
            var file = $('#' + file)[0].files[0].name;
            if ($.inArray(file.split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Only formats are allowed : " + fileExtension.join(', '));
            } else {
                $('#' + divName).val(file);
                var fileExt = file.split('.');
                var imageExt = "{{ url('images/investor/') }}" + '/' + fileExt[1] + '.png';
                $('#' + image).attr('src', imageExt);
            }
        }

        function uploadImage(form, imgdiv, namediv, file) {
            var i = $(this).prev('label').clone();
            var file = $('#' + file)[0].files[0].name;
            var fileExtension = ['png', 'jpg', 'jpeg'];
            if ($.inArray(file.split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Only formats are allowed : " + fileExtension.join(', '));
            } else {
                var fileName = file.split('.');
                $('#' + namediv).val(fileName[0]);
                if (form.files && form.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#' + imgdiv)
                            .attr('src', e.target.result);
                    };

                    reader.readAsDataURL(form.files[0]);
                }
            }
        }

        $(document).ready(function () {
            //Add Visual Uploads Images
            $('.add-new').on('click', function () {
                var number = 1 + Math.floor(Math.random() * 6);
                var div = '<tr>' +
                    '<td width="30%"><img width="230px" id="' + number +
                    '-img" src="https://via.placeholder.com/150"></td>' +
                    '<td width="36%" class="visual-type-text">' +
                    '<label>File name</label>' +
                    '<input type="text" name="file_name[]" placeholder="Name" id="' + number + '-name">' +
                    '</td>' +
                    '<td width="30%">' +
                    '<div class="browse">' +
                    '<label class="dashboard-reset"> Browse' +
                    '<input type="file" name="visual_upload[]" id="' + number +
                    '-file" class="input-upload" accept="image/jpeg, image/jpg, image/png" onchange="uploadImage(this, \'' + number + '-img\', \'' +
                    number + '-name\', \'' + number + '-file\')">' +
                    '</label>' +
                    '</div>' +
                    '</td>' +
                    '<td>' +
                    '<div class="delete-upload">' +
                    '<i class="fa fa-times cross-sign"></i> ' +
                    '</div>' +
                    '</td>' +
                    '</tr>';
                $('.append-div tbody').append(div);
            })

            //Delete Visual Uploads Images
            $(document).on('click', '.delete-upload', function () {
                var id = $(this).find('.cross-sign').data('id');
                if (id) {
                    $(this).parent().parent().remove();
                    $.ajax({
                        url: "{{ route('admin.projects.removeProjectUploads') }}",
                        method: 'post',
                        data: {
                            id: id
                        },
                        success: function (result) {
                            if (result.status == true) {
                            } else {
                                $.each(result.error, function (k, v) {
                                    console.log(k, v);
                                });
                            }
                        }
                    });
                } else {
                    $(this).parent().parent().remove();
                }
            });

            //Submit Visual Uploads Images
            $("#pro-uploads").on("submit", function (event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.projects.editProjectUploads') }}",
                    method: 'post',
                    data: formData,
                    processData: false,
                    cache: false,
                    contentType: false,
                    beforeSend: function () {
                        $('.uploads-save').html('{{ __('shares.Please wait') }}' + '...');
                        $('.uploads-save').prop('disabled', true);
                    },
                    success: function (result) {
                        if (result.status == true) {
                            $('#pro-uploads_error').append(
                                '<div class="alert c_alert" role="alert">' + result
                                    .error + '</div>');
                            $('html, body').animate({
                                scrollTop: $("#pro-uploads_error").offset().top
                            }, 2);
                            setTimeout(function () {
                                $('#pro-uploads_error .alert').remove();
                            }, 2000);
                            $('.uploads-save').html('Save');
                            $('.uploads-save').prop('disabled', false);
                        } else {
                            $.each(result.error, function (k, v) {
                                console.log(k, v);
                            });
                        }
                    }
                });
            });

            //Add Sponsor
            var sr_number = {{ count($projects->projectSponsors) + 1}};
            $('.add-sponsor').on('click', function () {
                var number = 1 + Math.floor(Math.random() * 6);
                var div = '<div class="row">' +
                    '<div class="col-md-7 col-sm-7 col-12">' +
                    '<div class="row sponsor-sec-row">' +
                    '<div class="col-md-1 col-sm-1 col-12">' +
                    '<div class="company-info">' +
                    '<span>' + sr_number++ + '</span>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-5 col-sm-5 col-12">' +
                    '<div class="company-info">' +
                    '<input type="text" placeholder="Company Name" name="company_name[]">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-5 col-sm-5 col-12">' +
                    '<div class="company-info">' +
                    '<input type="text" placeholder="Title" name="company_title[]">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-1 col-sm-1 col-12">' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div class="col-md-1 col-sm-1 col-12">' +
                    '</div>' +
                    '<div class="col-md-10 col-sm-10 col-12">' +
                    '<div class="company-info">' +
                    '<textarea cols="4" rows="8" placeholder="Insert your text here.."name="company_info[]"></textarea>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-1 col-sm-1 col-12">' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-md-5 col-sm-5 col-12">' +
                    '<div class="jack-profile">' +
                    '<img src="https://via.placeholder.com/150" id="' + number +
                    '" class="img-fluid jack-1 mx-auto" width="200px">' +
                    '<i class="fa fa-times cross-sign remove-sponsor"></i>' +
                    '</div>' +
                    '<div class="jack-profile-buttons text-center">' +
                    '<div class="browse">' +
                    '<label class="dashboard-reset d-flex mx-auto"> Browse' +
                    '<input type="file" name="sponsor_upload[]" accept="image/jpeg, image/jpg, image/png" id="files" onchange="readURL(this, ' +
                    number + ')" class="input-upload">' +
                    '</label>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                $('.append-sponsor').append(div);
            });

            //Delete Sponsor
            $(document).on('click', '.remove-sponsor', function () {
                sr_number--;
                var id = $(this).data('id');
                if (id) {
                    $(this).parent().parent().parent().remove();
                    $.ajax({
                        url: "{{ route('admin.projects.removeProjectSponsor') }}",
                        method: 'post',
                        data: {
                            id: id
                        },
                        success: function (result) {
                            if (result.status == true) {
                            } else {
                                $.each(result.error, function (k, v) {
                                    console.log(k, v);
                                });
                            }
                        }
                    });
                } else {
                    $(this).parent().parent().parent().remove();
                }
            });

            //Submit Project Sponsor
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            //Submit Project Sponsor
            $("#pro-sponsor-info").on("submit", function (event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.projects.editProjectSponsor') }}",
                    method: 'post',
                    data: formData,
                    processData: false,
                    cache: false,
                    contentType: false,
                    beforeSend: function () {
                        $('.spons-uploads').html('{{ __('shares.Please wait') }}' + '...');
                        $('.spons-uploads').prop('disabled', true);
                    },
                    success: function (result) {
                        if (result.status == true) {
                            $('#pro-sponsor-info_error').append(
                                '<div class="alert c_alert" role="alert">' + result
                                    .error + '</div>');
                            $('html, body').animate({
                                scrollTop: $("#pro-sponsor-info_error").offset().top
                            }, 2);
                            setTimeout(function () {
                                $('#pro-sponsor-info_error .alert').remove();
                            }, 2000);
                            $('.spons-uploads').html('Save');
                            $('.spons-uploads').prop('disabled', true);
                        } else {
                            $.each(result.error, function (k, v) {
                                console.log(k, v);
                            });
                        }
                    }
                });
            });

            //Add Documents
            $('.add-doc').on('click', function () {
                var number = 1 + Math.floor(Math.random() * 6);
                var file_doc = number + '-doc';
                var file_file = number + '-file';
                var file_image = number + '-image';
                var div = '<tr>' +
                    '<td width="35%" class="visual-type-text">' +
                    '<div class="input-options">' +
                    '<label>Name</label>' +
                    '<input name="doc_name[]" type="text" placeholder="Project Prospectus" id="' + number +
                    '-doc">' +
                    '</div>' +
                    '</td>' +
                    '<td class="file-ext" width="36%">' +
                    '<label>File Type</label>' +
                    '<img src="https://via.placeholder.com/30" width="30px" id="' + number + '-image">' +
                    // '<span>.pdf (Acrobat Reader)</span>' +
                    '</td>' +
                    '<td class="tick-1 tb-button">' +
                    '<div class="jack-profile-buttons text-center">' +
                    '<div class="browse">' +
                    '<label class="dashboard-reset d-flex mx-auto"> Browse' +
                    '<input type="file" name="doc_upload[]" id="' + number +
                    '-file" class="input-upload" accept="application/pdf, application/doc, application/docx" onchange="readNameAndType(this, \'' + file_doc + '\', \'' +
                    file_file + '\', \'' + file_image + '\')">' +
                    '</label>' +
                    '</div>' +
                    '</div>' +
                    '</td>' +
                    '<td>' +
                    '<i class="fa fa-times cross-sign remove-doc"></i>' +
                    ' </td>' +
                    '</tr>';
                $('.append-doc tbody').append(div);
            });
            //Delete Document
            $(document).on('click', '.remove-doc', function () {
                var id = $(this).data('id');
                if (id) {
                    $(this).parent().parent().remove();
                    $.ajax({
                        url: "{{ route('admin.projects.removeProjectDoc') }}",
                        method: 'post',
                        data: {
                            id: id
                        },
                        success: function (result) {
                            if (result.status == true) {
                            } else {
                                $.each(result.error, function (k, v) {
                                    console.log(k, v);
                                });
                            }
                        }
                    });
                } else {
                    $(this).parent().parent().remove();
                }
            });

            //Submit Project Document
            $("#pro-document-attach").on("submit", function (event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.projects.editProjectDoc') }}",
                    method: 'post',
                    data: formData,
                    processData: false,
                    cache: false,
                    contentType: false,
                    beforeSend: function () {
                        $('.doc-uploads').html('{{ __('shares.Please wait') }}' + '...');
                        $('.doc-uploads').prop('disabled', true);
                    },
                    success: function (result) {
                        if (result.status == true) {
                            $('#pro-document-attach_error').append(
                                '<div class="alert c_alert" role="alert">' + result
                                    .error + '</div>');
                            $('html, body').animate({
                                scrollTop: $("#pro-document-attach_error").offset().top
                            }, 2);
                            setTimeout(function () {
                                $('#pro-document-attach_error .alert').remove();
                            }, 2000);
                            $('.doc-uploads').html('Save');
                            $('.doc-uploads').prop('disabled', true);
                        } else {
                            $.each(result.error, function (k, v) {
                                console.log(k, v);
                            });
                        }
                    }
                });
            });

            //Submit Project Info
            $("#proj_info").on("submit", function (event) {
                event.preventDefault();
                var formValues = $(this).serialize();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('admin.projects.editProjectInfo') }}",
                    method: 'post',
                    data: formValues,
                    success: function (result) {
                        if (result.status == true) {
                            $('.hidden-id').val(result.data);
                            $('#proj_info_error').append(
                                '<div class="alert c_alert" role="alert">' + result
                                    .error + '</div>');
                            $('html, body').animate({
                                scrollTop: $("#proj_info_error").offset().top
                            }, 2);
                            setTimeout(function () {
                                $('#proj_info_error .alert').remove();
                            }, 2000);
                        } else {
                            $.each(result.error, function (k, v) {
                                console.log(k, v);
                            });
                        }
                    }
                });
            });
            //Submit Project Info
            $("#proj_type").on("submit", function (event) {
                event.preventDefault();
                var formValues = $(this).serialize();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('admin.projects.editProjectDetails') }}",
                    method: 'post',
                    data: formValues,
                    success: function (result) {
                        if (result.status == true) {
                            $('#proj_type_error').append(
                                '<div class="alert c_alert" role="alert">' + result
                                    .error + '</div>');
                            $('html, body').animate({
                                scrollTop: $("#proj_type_error").offset().top
                            }, 2);
                            setTimeout(function () {
                                $('#proj_type_error .alert').remove();
                            }, 2000);
                        } else {
                            $.each(result.error, function (k, v) {
                                console.log(k, v);
                            });
                        }
                    }
                });
            });

            //Submit Project Location
            $("#pro-location").on("submit", function (event) {
                event.preventDefault();
                var formValues = $(this).serialize();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('admin.projects.addProjectLocation') }}",
                    method: 'post',
                    data: formValues,
                    success: function (result) {
                        if (result.status == true) {
                            $('#pro-location_error').append(
                                '<div class="alert c_alert" role="alert">' + result
                                    .error + '</div>');
                            $('html, body').animate({
                                scrollTop: $("#pro-location_error").offset().top
                            }, 2);
                            setTimeout(function () {
                                $('#pro-location_error .alert').remove();
                            }, 2000);
                        } else {
                            $.each(result.error, function (k, v) {
                                console.log(k, v);
                            });
                        }
                    }
                });
            });

            //Submit Project Funding
            $("#pro-funding-info").on("submit", function (event) {
                event.preventDefault();
                var formValues = $(this).serialize();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('admin.projects.editProjectFunding') }}",
                    method: 'post',
                    data: formValues,
                    success: function (result) {
                        if (result.status == true) {
                            $('#pro-funding-info_error').append(
                                '<div class="alert c_alert" role="alert">' + result
                                    .error + '</div>');
                            $('html, body').animate({
                                scrollTop: $("#pro-funding-info_error").offset().top
                            }, 2);
                            setTimeout(function () {
                                $('#pro-funding-info_error .alert').remove();
                            }, 2000);
                        } else {
                            $.each(result.error, function (k, v) {
                                console.log(k, v);
                            });
                        }
                    },
                    error: function (result) {
                        var errors = $.parseJSON(result.responseText);
                        $('#c-error').html('<div class="alert alert-danger">'+errors.error.min_investment[0]+'</div>');
                    }
                });
            });

            //Get City
            $('#country').on('change', function (e) {
                var country_id = $('#country').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('city') }}",
                    method: 'post',
                    data: {
                        country_id: country_id,
                    },
                    success: function (result) {
                        $('#city').empty();
                        $('#city').append(result.data);
                    }
                });
            });

            //Location
            function GetLocation(location) {
                $('#map').html(
                    '<iframe width="100%" height="245px" frameborder="0" style="border:0;margin-top: 10px;" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBOfpaMO_tMMsuvS2T4zx4llbtsFqMuT9Y&q=' +
                    $("#location").val() + '&language=de"></iframe>');
            }

            $("#location").keyup(function (event) {
                GetLocation();
            });

            //Project Info Form Validation
            $('#proj_info').validate({
                rules: {
                    project_name_en: {
                        required: true,
                    },
                    project_name_ar: {
                        required: true,
                    },
                    country: {
                        required: true,
                    },
                    company_id: {
                        required: true,
                    },
                    city: {
                        required: true,
                    },
                    category: {
                        required: true,
                    },
                }, messages: {
                    project_name_en: {
                        required: '{{ __('auth.required') }}',
                    },
                    project_name_ar: {
                        required: '{{ __('auth.required') }}',
                    },
                    country: {
                        required: '{{ __('auth.required') }}',
                    },
                    company_id: {
                        required: '{{ __('auth.required') }}',
                    },
                    city: {
                        required: '{{ __('auth.required') }}',
                    },
                    category: {
                        required: '{{ __('auth.required') }}',
                    },
                }
            });

            //Project Details Form Validation
            $('#proj_type').validate({
                rules: {
                    proj_type_en: {
                        required: true,
                    },
                    proj_type_ar: {
                        required: true,
                    },
                    asset_type_en: {
                        required: true,
                    },
                    asset_type_ar: {
                        required: true,
                    },
                    proj_intro_en: {
                        required: true,
                    },
                    proj_intro_ar: {
                        required: true,
                    }
                },
                messages: {
                    proj_type_en: {
                        required: '{{ __('auth.required') }}',
                    },
                    proj_type_ar: {
                        required: '{{ __('auth.required') }}',
                    },
                    asset_type_en: {
                        required: '{{ __('auth.required') }}',
                    },
                    asset_type_ar: {
                        required: '{{ __('auth.required') }}',
                    },
                    proj_intro_en: {
                        required: '{{ __('auth.required') }}',
                    },
                    proj_intro_ar: {
                        required: '{{ __('auth.required') }}',
                    }
                }
            });
            //Project Visual Uploads Form Validation
            $('#pro-uploads').validate({
                rules: {
                    "file_name[]": "required"
                },
                messages: {
                    "file_name[]": '{{ __('auth.required') }}',
                }
            });
            //Project Location Form Validation
            $('#pro-location').validate({
                rules: {
                    "location": "required"
                },
                messages: {
                    "location": '{{ __('auth.required') }}',
                }
            });

            //Project Funding Info Form Validation
            $('#pro-funding-info').validate({
                rules: {
                    funding_required: {
                        required: true,
                    },
                    min_investment: {
                        required: true,
                    },
                    no_of_shares: {
                        required: true,
                    },
                    price_per_share: {
                        required: true,
                    },
                    projected_roi: {
                        required: true,
                        integer: true
                    },
                    investment_period: {
                        required: true,
                    },
                    structure: {
                        required: true,
                    },
                    subscription_fee: {
                        required: true,
                    }
                },
                messages: {
                    funding_required: {
                        required: '{{ __('auth.required') }}',
                    },
                    min_investment: {
                        required: '{{ __('auth.required') }}',
                    },
                    no_of_shares: {
                        required: '{{ __('auth.required') }}',
                    },
                    price_per_share: {
                        required: '{{ __('auth.required') }}',
                    },
                    projected_roi: {
                        required: '{{ __('auth.required') }}',
                        integer: '{{ __('auth.integer') }}',
                    },
                    investment_period: {
                        required: '{{ __('auth.required') }}',
                    },
                    structure: {
                        required: '{{ __('auth.required') }}',
                    },
                    subscription_fee: {
                        required: '{{ __('auth.required') }}',
                    }
                }
            });


            //Project Sponsors Form Validation
            $('#pro-sponsor-info').validate({
                rules: {
                    "company_name[]": "required",
                    "company_title[]": "required",
                    "company_info[]": "required",
                },
                messages: {
                    "company_name[]": '{{ __('auth.required') }}',
                    "company_title[]": '{{ __('auth.required') }}',
                    "company_info[]": '{{ __('auth.required') }}',
                }
            });

            //Project Documents Form Validation
            $('#pro-document-attach').validate({
                rules: {
                    "doc_name[]": "required",
                },
                messages: {
                    "doc_name[]": '{{ __('auth.required') }}',
                }
            });
        });
    </script>
@endsection
