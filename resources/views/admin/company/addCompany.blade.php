@extends('layouts.investor.investor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Add Company</title>
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
                            <a href="javascriptvoid:(0)" class="tags-list-text for-color">Company</a>
                        </li>
                        <li class="tags-list-item">
                            <a href="javascriptvoid:(0)" class="tags-list-text">
                                <i class="fa fa-angle-double-right tag-icon" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="tags-list-item">
                            <a href="javascriptvoid:(0)" class="tags-list-text">Add New Company</a>
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
                                Add New Company
                                <span class="float-right">إضافة شركة جديدة</span>
                            </h2>
                        </div>
                    </div>
                    <form action="{{ route('admin.company.add') }}" method="post" id="form">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="input-options">
                                            <label>Company Name</label>
                                            <input type="text" placeholder="Name" value="{{ old('name_en') }}" name="name_en" class="@error('name_en') is-invalid @enderror">
                                            @error('name_en')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12 dir-rtl">
                                        <div class="input-options">
                                            <label class="text-right">اسم الشركة</label>
                                            <input type="text" placeholder="اسم التصنيف" value="{{ old('name_ar') }}" name="name_ar" class="@error('name_ar') is-invalid @enderror">
                                            @error('name_ar')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="input-options">
                                            <label>Company Type</label>
                                            <select name="company_type_en" class="@error('prop_type_en') is-invalid @enderror">
                                                <option value="" selected disabled>Select Company Type</option>
                                                <option value="Property Management">Property Management</option>
                                                <option value="Developer">Developer</option>
                                                <option value="Fund Manager">Fund Manager</option>
                                                <option value="Custodian">Custodian</option>
                                                <option value="Operator">Operator</option>
                                            </select>
                                            @error('prop_type_en')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12 dir-rtl">
                                        <div class="input-options">
                                            <label class="text-right">نوع الملكية</label>
                                            <select name="company_type_ar" class="@error('prop_type_ar') is-invalid @enderror">
                                                <option value="" selected disabled>حدد نوع الشركة</option>
                                                <option value="إدارة الممتلكات">إدارة الممتلكات</option>
                                                <option value="مطور">مطور</option>
                                                <option value="مدير صندوق">مدير صندوق</option>
                                                <option value="وصي">وصي</option>
                                                <option value="المشغل أو العامل">المشغل أو العامل</option>
                                            </select>
                                            @error('prop_type_ar')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-12">
                                        <div class="input-options">
                                            <label>Location</label>
                                            <input type="text" name="location" value="{{ old('location') }}" class="@error('location') is-invalid @enderror">
                                            @error('location')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-0 col-12">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="dashboard-buttons">
                                    <button type="button" class="dashboard-reset">Reset</button>
                                    <button type="submit" class="dashboard-save">Save</button>
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
        $(document).ready(function(){
            $('#form').validate({
                rules: {
                    name_en: {
                        required: true,
                    },
                    name_ar: {
                        required: true,
                    },
                    company_type_en: {
                        required: true,
                    },
                    company_type_ar: {
                        required: true,
                    },
                    location: {
                        required: true,
                    },
                },messages: {
                    name_en: {
                        required: '{{ __('auth.required') }}'
                    },
                    name_ar: {
                        required: '{{ __('auth.required') }}'
                    },
                    company_type_en: {
                        required: '{{ __('auth.required') }}'
                    },
                    company_type_ar: {
                        required: '{{ __('auth.required') }}'
                    },
                    location: {
                        required: '{{ __('auth.required') }}'
                    }
                }
            });
        });
    </script>
@endsection
