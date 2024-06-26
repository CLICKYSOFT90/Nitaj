@extends('layouts.investor.investor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Add Project</title>
@endsection

@section('content')
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
                        <li class="tags-list-item"><a href="javascriptvoid:(0)" class="tags-list-text">Add A New
                                Project</a>
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
                                <button class="multisteps-form__progress-btn details" type="button" title="Project Details">
                                    <span>Project Details</span>
                                </button>
                                <button class="multisteps-form__progress-btn intro" type="button" title="Project Intro">
                                    <span>Project Intro</span>
                                </button>
                                <button class="multisteps-form__progress-btn uploads" type="button" title="Project Uploads">
                                    <span>Project Uploads</span>
                                </button>
                                <button class="multisteps-form__progress-btn location" type="button" title="Location">
                                    <span>Location</span>
                                </button>
                                <button class="multisteps-form__progress-btn funding" type="button" title="Funding Info">
                                    <span>Funding Info</span>
                                </button>
                                <button class="multisteps-form__progress-btn sponsors" type="button" title="Sponsors">
                                    <span>Sponsors</span>
                                </button>
                                <button class="multisteps-form__progress-btn documents" type="button" title="Documents Attached">
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
                        <div class="row">
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="input-options">
                                            <label>Project Name</label>
                                            <input type="text" placeholder="Name" name="project_name_en"
                                                   id="project_name_en"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="input-options">
                                            <label>Country</label>
                                            <select name="country" id="country">
                                                <option value="">Select Country</option>
                                                @foreach($countries as $country)
                                                    <option
                                                        value="{{ $country->id }}" {{ $country->id == 194 ? 'selected': '' }}>{{ $country->name }}</option>
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
                                            <input type="text" placeholder="اسم المشروع" name="project_name_ar"
                                                   id="project_name" required>
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
                                            <select name="company_id" id="company_id">
                                                <option selected disabled value="">Select Company</option>
                                                @foreach($companies as $company)
                                                    <option value="{{ $company->id }}">{{ $company->name_en }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="input-options">
                                            <label>City</label>
                                            <select name="city" id="city">
                                                <option value="">Select City</option>
                                                @foreach($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
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
                                            <select name="category">
                                                <option value="" disabled selected>Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name_en }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                    </form>
                </div>
            </div>
        </div>
            <div class="pro-detail-sec" style="display: none;">
                <div class="d-flex flex-column-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="pro-detail">Project Details</h2>
                            </div>
                        </div>
                        <div id="proj_type_error"></div>
                        <form id="proj_type">
                            <input type="hidden" name="project_id" class="hidden-id">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>Project Type</label>
                                                <select name="proj_type_en" id="proj_type_en">
                                                    <option value=""> Select Project Type</option>
                                                    <option value="Development">Development</option>
                                                    <option value="Acquisition">Acquisition</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>Asset Type</label>
                                                <select name="asset_type_en" id="asset_type_en">
                                                    <option value="" selected disabled> Select Asset Type</option>
                                                    <optgroup label="Residential">
                                                        <option value="Villa">Villa</option>
                                                        <option value="Apartment">Apartment</option>
                                                        <option value="Studio">Studio</option>
                                                        <option value="Townhouse">Townhouse</option>
                                                        <option value="Apartment Building">Apartment Building</option>
                                                        <option value="Compound">Compound</option>
                                                    </optgroup>
                                                    <optgroup label="Commercial">
                                                        <option value="Apartment Complex">Apartment Complex</option>
                                                        <option value="Villa Compound">Villa Compound</option>
                                                        <option value="Industrial ">Industrial</option>
                                                        <option value="Office Building">Office Building</option>
                                                        <option value="Hotels">Hotels</option>
                                                        <option value="Medical ">Medical</option>
                                                        <option value="Vacation Home">Vacation Home</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-0 col-12">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-12 ">
                                            <div class="input-options">
                                                <label class="text-right">نوع الأصول</label>
                                                <select name="asset_type_ar" id="asset_type_ar" class="dir-rtl">
                                                    <option value="">حدد نوع المشروع</option>
                                                    <optgroup label="سكني">
                                                        <option value="فيلا">فيلا</option>
                                                        <option value="شقة">شقة</option>
                                                        <option value="ستوديو">ستوديو</option>
                                                        <option value="تاون هاوس">تاون هاوس</option>
                                                        <option value="مبنى سكني">مبنى سكني</option>
                                                        <option value="مُجَمَّع">مُجَمَّع</option>
                                                    </optgroup>
                                                    <optgroup label="تجاري">
                                                        <option value="مجمع سكني">مجمع سكني</option>
                                                        <option value="مجمع فيلات">مجمع فيلات</option>
                                                        <option value="صناعي ">صناعي</option>
                                                        <option value="مبنى إداري">مبنى إداري</option>
                                                        <option value="الفنادق">الفنادق</option>
                                                        <option value="طبي">طبي</option>
                                                        <option value="منزل الأجازة">منزل الأجازة</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label class="text-right">نوع المشروع</label>
                                                <select name="proj_type_ar" id="proj_type_ar" class="dir-rtl">
                                                    <option value="" disabled selected> حدد نوع المشروع</option>
                                                    <option value="التطور">التطور</option>
                                                    <option value="اكتساب">اكتساب</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="pro-detail">
                                        Project Introduction
                                        <span class="float-right"> مقدمة المشروع</span>
                                    </h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="text-area-box">
                                        <textarea cols="4" rows="8" name="proj_intro_en" id="proj_intro_en"
                                                  placeholder="Insert your text here"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12 dir-rtl">
                                    <div class="text-area-box">
                                        <textarea cols="4" rows="8" name="proj_intro_ar" id="proj_intro_ar"
                                                  placeholder="أدخل النص الخاص بك هنا"></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="dashboard-buttons">
                                        <button type="button" class="dashboard-reset"
                                                onclick="this.form.reset();">Reset
                                        </button>
                                        <button type="submit" class="dashboard-save">Save</button>
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
            <div class="pro-uploads" style="display: none;">
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
                                            <input type="hidden" name="project_id" class="hidden-id">
                                            <tr>
                                                <td width="30%"><img width="230px" id="first-img"
                                                                     src="https://via.placeholder.com/150"></td>
                                                <td width="36%" class="visual-type-text">
                                                    <label>File name</label>
                                                    <input type="text" name="file_name[]" placeholder="Name"
                                                           id="first-name">
                                                </td>
                                                <td width="30%">
                                                    <div class="browse">
                                                        <label class="dashboard-reset"> Browse
                                                            <input type="file" name="visual_upload[]" id="first-file"
                                                                   class="input-upload"
                                                                   accept="image/jpeg, image/jpg, image/png"
                                                                   onchange="uploadImage(this, 'first-img', 'first-name','first-file')">
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row df_aic">
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="for-adding-new-project-button">
                                                <a href="javascriptvoid:(0)" class="dashboard-save add-new">ADD NEW </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="funding-buttons for-alignment">
                                                <button type="submit" class="dashboard-save">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="pro-location" style="display: none;">
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
                                <input type="hidden" name="project_id" class="hidden-id">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label>Location</label>
                                        <input type="text" placeholder="Location" id="location" name="location">
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="google-map">
                                        <div id="map"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="location-buttons">
                                        <button type="button" class="dashboard-reset" onclick="this.form.reset();">
                                            Reset
                                        </button>
                                        <button type="submit" class="dashboard-save">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="pro-funding-info" style="display: none;">
                <div class="d-flex flex-column-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="pro-info">Funding Info</h2>
                            </div>
                        </div>
                        <div id="pro-funding-info_error"></div>
                        <form id="pro-funding-info">
                            <input type="hidden" name="project_id" class="hidden-id">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>Funding Required</label>
                                                <input type="number" placeholder="Amount" name="funding_required"
                                                       id="funding_required">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>Min Investment</label>
                                                <input type="number" placeholder="Amount" name="min_investment"
                                                       id="min_investment" onkeyup="calcNoOfShares(this)">
                                                <span id="c-error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>No. of Shares</label>
                                                <input type="text" placeholder="Insert no. of shares"
                                                       name="no_of_shares" id="no_of_shares"
                                                       readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>Unit Price</label>
                                                <input type="text" placeholder="Insert Value per share"
                                                       id="price_per_share" readonly
                                                       name="price_per_share">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>Projected ROI %</label>
                                                <input type="text" placeholder="Insert ROI" name="projected_roi">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>Investment Period</label>
                                                <select name="investment_period">
                                                    <option value="" disabled selected>Select Investment Period</option>
                                                    @php $i = 0; @endphp
                                                    @for ($i = 1; $i < 11; $i++)
                                                        <option value="{{ $i }}">{{ $i }} Years
                                                        </option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>Structure</label>
                                                <select name="structure">
                                                    <option value="" disabled="" selected="">Select Structure</option>
                                                    <option value="Equity">
                                                        Equity
                                                    </option>
                                                    <option value="Debt">
                                                        Debt
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>Fund Subscription</label>
                                                <input type="text" placeholder="Subscription Fee"
                                                       name="subscription_fee">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>Projected Dividend Yield %</label>
                                                <input type="text" placeholder="Inserted dividend yield"
                                                        name="dividend_yield">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-12">
                                            <div class="input-options">
                                                <label>Dividend Frequency</label>
                                                <select
                                                     name="dividend_frequency">
                                                    <option value="" disabled selected>Select Dividend Frequency</option>
                                                    <option value="monthly">
                                                        Monthly
                                                    </option>
                                                    <option value="Quarterly">
                                                        Quarterly
                                                    </option>
                                                    <option value="semi annually">
                                                        Semi Annually
                                                    </option>
                                                    <option value="yearly">
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
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="funding-buttons funding-buttons-reset">
                                        <button type="button" class="dashboard-reset" onclick="this.form.reset();">
                                            Reset
                                        </button>
                                        <button type="submit" class="dashboard-save">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="pro-sponsor-info" style="display: none;">
                <div class="d-flex flex-column-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="pro-sponsor">Sponsors</h2>
                                <div class="sponsor-buttons">
                                    {{-- <button type="button" class="dashboard-reset">Add new</button> --}}
                                    {{-- <button type="button" class="dashboard-save">Edit</button> --}}
                                </div>
                            </div>
                        </div>
                        <div id="pro-sponsor-info_error"></div>
                        <form id="pro-sponsor-info" enctype="multipart/form-data" accept-charset="utf-8">
                            <input type="hidden" name="project_id" class="hidden-id">
                            <div class="row mb-5">
                                <div class="col-md-7 col-sm-7 col-12">
                                    <div class="row">
                                        <div class="col-md-1 col-sm-1 col-12">
                                            <div class="company-info">
                                                <span>1</span>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-sm-5 col-12">
                                            <div class="company-info">
                                                <input type="text" placeholder="Company Name" name="company_name[]">
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-sm-5 col-12">
                                            <div class="company-info">
                                                <input type="text" placeholder="Title" name="company_title[]">
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
                                                <textarea cols="4" rows="8" placeholder="Insert your text here.."
                                                          name="company_info[]"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-sm-1 col-12">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-5 col-12">
                                    <div class="jack-profile">
                                        <img src="https://via.placeholder.com/150" id="first"
                                             class="img-fluid jack-1 mx-auto" width="200px">
                                        {{-- <i class="fa fa-times cross-sign"></i> --}}
                                    </div>
                                    <div class="jack-profile-buttons text-center">
                                        <div class="browse">
                                            <label class="dashboard-reset d-flex mx-auto"> Browse
                                                <input type="file" name="sponsor_upload[]" id="files"
                                                       accept="image/jpeg, image/jpg, image/png"
                                                       onchange="readURL(this, 'first')" class="input-upload">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="append-sponsor"></div>
                            <div class="row df_aic">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="for-adding-new-project-button">
                                        <a href="javascript:;" class="dashboard-save add-sponsor">ADD NEW </a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="funding-buttons for-alignment">
                                        <button type="submit" class="dashboard-save uploads-save">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="pro-document-attach" style="display: none;">
                <div class="d-flex flex-column-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="pro-document">Documents Attached</h2>
                            </div>
                        </div>
                        <div id="pro-document-attach_error"></div>
                        <form id="pro-document-attach" enctype="multipart/form-data">
                            <input type="hidden" name="project_id" class="hidden-id">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="table-responsive">
                                        <table class="table append-doc">
                                            <tbody>
                                            <tr>
                                                <td width="35%" class="visual-type-text">
                                                    <div class="input-options">
                                                        <label>Name</label>
                                                        <input name="doc_name[]" type="text"
                                                               placeholder="Project Prospectus" id="first-doc">
                                                    </div>
                                                </td>
                                                <td class="file-ext" width="36%">
                                                    <label>File Type</label>
                                                    <img src="https://via.placeholder.com/30" id="first-image"
                                                         width="30px">
                                                    {{-- <span>.pdf (Acrobat Reader)</span> --}}
                                                </td>
                                                <td class="tick-1 tb-button">
                                                    <div class="jack-profile-buttons text-center">
                                                        <div class="browse">
                                                            <label class="dashboard-reset d-flex mx-auto"> Browse
                                                                <input type="file" name="doc_upload[]"
                                                                       accept="application/pdf, application/doc, application/docx"
                                                                       id="first-file-doc"
                                                                       onchange="readNameAndType(this, 'first-doc', 'first-file-doc','first-image')"
                                                                       class="input-upload">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('scripts')
    <script>

        function checkMinInvestment(val) {
            var fund_required = $('#funding_required').val();
            var min_investment = val.value;
            if (min_investment > fund_required) {
                $('#c-error').html('<div class="alert alert-danger">Minimun investment should not be greater than fund required.</div>');
                $('#min_investment').val(min_investment.slice(0, -1));
            }
        }

        function calcNoOfShares(value){
            var fund_required = $('#funding_required').val();
            var no_of_shares = fund_required / value.value;
            $('#price_per_share').val(value.value);
            $('#no_of_shares').val(no_of_shares);

        }

        function calcPricePerShare() {
            var fund_required = $('#funding_required').val();
            var no_of_shares = $('#no_of_shares').val();
            var price_per_share = fund_required / no_of_shares;
            console.log(fund_required, "asdasd", no_of_shares, "zxczxc", price_per_share)
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
                $(this).parent().parent().remove();
            });


            //Add Sponsor
            var sr_number = 2;
            $('.add-sponsor').on('click', function () {
                var number = 1 + Math.floor(Math.random() * 6);
                var div = '<div class="row mb-5">' +
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
                    '<input type="file" name="sponsor_upload[]" id="files" accept="image/jpeg, image/jpg, image/png" onchange="readURL(this, ' +
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
                $(this).parent().parent().parent().remove();
            });

            //Submit Project Sponsor
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
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
                    url: "{{ route('admin.projects.addProjectInfo') }}",
                    method: 'post',
                    data: formValues,
                    success: function (result) {
                        if (result.status == true) {
                            $('.pro-detail-sec').show();
                            $('.details').addClass('js-active')
                            $('.hidden-id').val(result.data);
                            $('#proj_info .dashboard-buttons button').prop('disabled',
                                'disabled');
                            $('#proj_info_error').append(
                                '<div class="alert c_alert" role="alert">' + result
                                    .error + '</div>');
                            $('html, body').animate({
                                scrollTop: $("#proj_info_error").offset().top
                            }, 2);
                            setTimeout(function () {
                                $('#proj_info_error .alert').remove();
                            }, 5000);
                        } else {
                            $.each(result.error, function (k, v) {
                                console.log(k, v);
                            });
                        }
                    }
                });
            });

            //Submit Project Type
            $("#proj_type").on("submit", function (event) {
                event.preventDefault();
                var formValues = $(this).serialize();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('admin.projects.addProjectDetails') }}",
                    method: 'post',
                    data: formValues,
                    success: function (result) {
                        if (result.status == true) {
                            $('.pro-uploads').show();
                            $('#proj_type .dashboard-buttons button').prop('disabled',
                                'disabled');
                            $('#proj_type_error').append(
                                '<div class="alert c_alert" role="alert">' + result
                                    .error + '</div>');
                            $('html, body').animate({
                                scrollTop: $("#proj_type_error").offset().top
                            }, 2);
                            setTimeout(function () {
                                $('#proj_type_error .alert').remove();
                            }, 5000);
                            $('.intro').addClass('js-active');
                        } else {
                            $.each(result.error, function (k, v) {
                                console.log(k, v);
                            });
                        }
                    }
                });
            });

            //Submit Visual Uploads Images
            $("#pro-uploads").on("submit", function (event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.projects.addProjectUploads') }}",
                    method: 'post',
                    data: formData,
                    processData: false,
                    cache: false,
                    contentType: false,
                    success: function (result) {
                        if (result.status == true) {
                            $('.pro-location').show();
                            $('#pro-uploads .funding-buttons button').prop('disabled', 'disabled')
                            $('#pro-uploads .add-new').prop('disabled', 'disabled')
                            $('#pro-uploads_error').append(
                                '<div class="alert c_alert" role="alert">' + result
                                    .error + '</div>');
                            $('html, body').animate({
                                scrollTop: $("#pro-uploads_error").offset().top
                            }, 2);
                            setTimeout(function () {
                                $('#pro-uploads_error .alert').remove();
                            }, 5000);
                            $('.uploads').addClass('js-active')
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
                            $('.pro-funding-info').show();
                            $('#pro-location .dashboard-buttons button').prop('disabled',
                                'disabled');
                            $('#pro-location_error').append(
                                '<div class="alert c_alert" role="alert">' + result
                                    .error + '</div>');
                            $('html, body').animate({
                                scrollTop: $("#pro-location_error").offset().top
                            }, 2);
                            setTimeout(function () {
                                $('#pro-location_error .alert').remove();
                            }, 5000);
                            $('.location').addClass('js-active')
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
                    url: "{{ route('admin.projects.addProjectFunding') }}",
                    method: 'post',
                    data: formValues,
                    success: function (result) {
                        if (result.status == true) {
                            $('.pro-sponsor-info').show();
                            $('#pro-funding-info .funding-buttons button').prop('disabled',
                                'disabled');
                            $('#pro-funding-info_error').append(
                                '<div class="alert c_alert" role="alert">' + result
                                    .error + '</div>');
                            $('html, body').animate({
                                scrollTop: $("#pro-funding-info_error").offset().top
                            }, 2);
                            setTimeout(function () {
                                $('#pro-funding-info_error .alert').remove();
                            }, 5000);
                            $('.funding').addClass('js-active')
                        } else {
                            $.each(result.error, function (k, v) {
                                console.log(k, v);
                            });
                        }
                    },
                    error: function (result) {
                        var errors = $.parseJSON(result.responseText);
                        $('#c-error').html('<div class="alert alert-danger">' + errors.error.min_investment[0] + '</div>');
                    }
                });
            });

            //Submit Project Sponsor
            $("#pro-sponsor-info").on("submit", function (event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.projects.addProjectSponsor') }}",
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
                            $('.pro-document-attach').show();
                            $('#pro-sponsor-info .funding-buttons button').prop('disabled',
                                'disabled');
                            $('#pro-sponsor-info_error').append(
                                '<div class="alert c_alert" role="alert">' + result
                                    .error + '</div>');
                            $('html, body').animate({
                                scrollTop: $("#pro-sponsor-info_error").offset().top
                            }, 2);
                            setTimeout(function () {
                                $('#pro-sponsor-info_error .alert').remove();
                            }, 5000);
                            $('.uploads-save').html('Save');
                            $('.sponsors').addClass('js-active')
                        } else {
                            $.each(result.error, function (k, v) {
                                console.log(k, v);
                            });
                        }
                    }
                });
            });

            //Submit Project Document
            $("#pro-document-attach").on("submit", function (event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('admin.projects.addProjectDoc') }}",
                    method: 'post',
                    data: formData,
                    processData: false,
                    cache: false,
                    contentType: false,
                    success: function (result) {
                        if (result.status == true) {
                            $('#pro-document-attach .funding-buttons button').prop('disabled',
                                'disabled');
                            $('#pro-document-attach_error').append(
                                '<div class="alert c_alert" role="alert">' + result
                                    .error + '</div>');
                            $('html, body').animate({
                                scrollTop: $("#pro-document-attach_error").offset().top
                            }, 2);
                            $('.documents').addClass('js-active')
                            setTimeout(function () {
                                $('#pro-document-attach_error .alert').remove();
                                window.location.href = result.redirect;
                            }, 5000);
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
                $(this).parent().parent().remove();
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
                if (location !== '') {
                    $('#map').html(
                        '<iframe width="100%" height="245px" frameborder="0" style="border:0;margin-top: 10px;" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBOfpaMO_tMMsuvS2T4zx4llbtsFqMuT9Y&q=' +
                        $("#location").val() + '&language=de"></iframe>');
                } else {
                    $('#map').html('');
                }
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
                    },
                    dividend_yield: {
                        required: true,
                    },
                    dividend_frequency: {
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
                    },
                    dividend_yield: {
                       required: '{{ __('auth.required') }}',
                    },
                    dividend_frequency: {
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
