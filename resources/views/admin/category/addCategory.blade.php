@extends('layouts.investor.investor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Add Category</title>
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
                            <a href="javascriptvoid:(0)" class="tags-list-text for-color">Category</a>
                        </li>
                        <li class="tags-list-item">
                            <a href="javascriptvoid:(0)" class="tags-list-text">
                                <i class="fa fa-angle-double-right tag-icon" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="tags-list-item">
                            <a href="javascriptvoid:(0)" class="tags-list-text">Add New Category</a>
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
                                Add New Category
                                <span class="float-right"> إضافة فئة جديدة</span>
                            </h2>
                        </div>
                    </div>
                    <form action="{{ route('admin.category.add') }}" method="post" id="form">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="input-options">
                                            <label>Category Name</label>
                                            <input type="text" placeholder="Name" name="name_en"
                                                class="@error('name_en') is-invalid @enderror">
                                            @error('name_en')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12 dir-rtl">
                                        <div class="input-options">
                                            <label class="text-right">اسم التصنيف</label>
                                            <input type="text" placeholder="اسم التصنيف" name="name_ar"
                                                class="@error('name_ar') is-invalid @enderror">
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
                                        <div class="input-options" >
                                            <label>Type</label>
                                            <select id="mySelect" name="prop_type_en" onSelect="do()" class="select" @error('prop_type_en') is-invalid @enderror">
                                                <option  value="" selected disabled>Select Type</option>
                                                <optgroup  label="Residential"></optgroup>
                                                <option  value="Villas">Villas</option>
                                                <option  value="Apartment">Apartment</option>
                                                <option  value="Studio">Studio</option>
                                                <option  value="Townhouse">Townhouse</option>
                                                <option  value="Apartment Building">Apartment Building</option>
                                                <option value="Compound">Compound</option>
                                                <optgroup  label="Commercial"></optgroup>
                                                <option  value="Apartment Complex">Apartment Complex</option>
                                                <option value="Villa Compound">Villa Compound</option>
                                                <option  value="Industrial">Industrial</option>
                                                <option  value="Office Building">Office Building</option>
                                                <option value="Hotels">Hotels</option>
                                                <option  value="Medical">Medical</option>
                                                <option  value="Vacation Home">Vacation Home</option>

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
                                            <select id="mySelect" name="prop_type_ar" class="select" class="@error('prop_type_ar') is-invalid @enderror">
                                                <option value="" selected disabled>اختر صنف</option>
                                                <optgroup  label="Residential"></optgroup>
                                                <option value="فلل">فلل</option>
                                                <option value="-شقة">-شقة</option>
                                                <option  value="ستوديو"> ستوديو</option>
                                                <option  value="تاون هاوس">تاون هاوس</option>
                                                <option  value="عمارة سكنية">عمارة سكنية</option>
                                                <option  value="مجمع فلل">مجمع فلل</option>
                                                <option  value="مجمع فلل">مجمع فلل</option>
                                                <optgroup  label="Commercial"></optgroup>
                                                <option  value="مجمع عمائر سكنية">مجمع عمائر سكنية</option>
                                                <option  value="مجمع فلل">مجمع فلل</option>
                                                <option value="مستودعات صناعية">مستودعات صناعية</option>
                                                <option value="برج مكاتب">برج مكاتب</option>
                                                <option  value="فنادق">فنادق</option>
                                                <option  value="مجمع طبي">مجمع طبي</option>
                                                <option  value="بيوت للعطلة">بيوت للعطلة</option>
                                            </select>
                                            @error('prop_type_ar')
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
                                    <button type="button" class="dashboard-reset"
                                        onclick="this.form.reset();">Reset</button>
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
        $(document).ready(function() {
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
        $('.select').on('change',function(){

            $("select option:selected").addClass('select-black')
        });


    </script>
@endsection
