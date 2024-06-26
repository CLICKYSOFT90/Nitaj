@extends('layouts.investor.investor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Edit Company</title>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="help_sec">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <ul class="tags-listing">
                        <li class="tags-list-item">
                            <a href="{{ route('admin.company') }}" class="tags-list-text">
                                <i class="fa fa-angle-left tag-icon" aria-hidden="true"></i>
                                Back
                            </a>
                        </li>
                        <li class="tags-list-item">
                            <a href="javascriptvoid:(0)" class="tags-list-text for-color">Category</a>
                        </li>
                        <li class="tags-list-item">
                            <a href="javascriptvoid:(0)" class="tags-list-text">
                                <i class="fa fa-angle-double-right tag-icon" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="tags-list-item">
                            <a href="javascriptvoid:(0)" class="tags-list-text">Edit Category</a>
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
                            <h2 class="pro-info">Edit Category</h2>
                        </div>
                    </div>
                    <form action="{{ route('admin.company.postEdit') }}" method="post" id="form">
                        @csrf
                        <input type="hidden" name="company_id" value="{{ $cat->id }}">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="input-options">
                                            <label>Company Name</label>
                                            <input type="text" placeholder="Name" value="{{ $cat->name_en }}" name="name_en" class="@error('name_en') is-invalid @enderror">
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
                                            <input type="text" placeholder="اسم التصنيف" value="{{ $cat->name_ar }}" name="name_ar" class="@error('name_ar') is-invalid @enderror">
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
                                                <option value="Property Management" {{ $cat->company_type_en == 'Property Management' ? 'selected' : '' }}>Property Management</option>
                                                <option value="Developer" {{ $cat->company_type_en == 'Developer' ? 'selected' : '' }}>Developer</option>
                                                <option value="Fund Manager" {{ $cat->company_type_en == 'Fund Manager' ? 'selected' : '' }}>Fund Manager</option>
                                                <option value="Custodian" {{ $cat->company_type_en == 'Custodian' ? 'selected' : '' }}>Custodian</option>
                                                <option value="Operator" {{ $cat->company_type_en == 'Operator' ? 'selected' : '' }}>Operator</option>
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
                                                <option value="إدارة الممتلكات" {{ $cat->company_type_ar == 'إدارة الممتلكات' ? 'selected' : '' }}>إدارة الممتلكات</option>
                                                <option value="مطور" {{ $cat->company_type_ar == 'مطور' ? 'selected' : '' }}>مطور</option>
                                                <option value="مدير صندوق" {{ $cat->company_type_ar == 'مدير صندوق' ? 'selected' : '' }}>مدير صندوق</option>
                                                <option value="وصي" {{ $cat->company_type_ar == 'وصي' ? 'selected' : '' }}>وصي</option>
                                                <option value="المشغل أو العامل" {{ $cat->company_type_ar == 'المشغل أو العامل' ? 'selected' : '' }}>المشغل أو العامل</option>
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
                                            <input type="text" name="location" value="{{ $cat->location }}" class="@error('location') is-invalid @enderror">
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
                    prop_type_en: {
                        required: true,
                    },
                    prop_type_ar: {
                        required: true,
                    },
                },messages: {
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
@endsection
