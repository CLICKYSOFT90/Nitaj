@extends('layouts.investor.investor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Edit Category</title>
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
                    <form action="{{ route('admin.category.postEdit') }}" method="post" id="form">
                        @csrf
                        <input type="hidden" value="{{ $cat->id }}" name="cat_id">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="input-options">
                                            <label>Category Name</label>
                                            <input type="text" placeholder="Name" name="name_en" value="{{ $cat->name_en }}" class="@error('name_en') is-invalid @enderror">
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
                                            <input type="text" placeholder="اسم التصنيف" name="name_ar" value="{{ $cat->name_ar }}" class="@error('name_ar') is-invalid @enderror">
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
                                            <label>Type</label>
                                            <select name="prop_type_en" class="@error('prop_type_en') is-invalid @enderror">
                                                <option value="" selected disabled>Select Type</option>
                                                <optgroup label="Residential"></optgroup>
                                                <option value="Villas" {{ $cat->property_type_en == 'Villas' ? 'selected' : '' }}>Villas</option>
                                                <option value="Apartment" {{ $cat->property_type_en == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                                                <option value="Studio" {{ $cat->property_type_en == 'Studio' ? 'selected' : '' }}>Studio</option>
                                                <option value="Townhouse" {{ $cat->property_type_en == 'Townhouse' ? 'selected' : '' }}>Townhouse</option>
                                                <option value="Apartment Building" {{ $cat->property_type_en == 'Apartment Building' ? 'selected' : '' }}>Apartment Building</option>
                                                <option value="Compound"{{ $cat->property_type_en == 'Compound' ? 'selected' : '' }}>Compound</option>
                                                <optgroup label="Commercial"{{ $cat->property_type_en == 'Commercial' ? 'selected' : '' }}></optgroup>
                                                <option value="Apartment Complex"{{ $cat->property_type_en == 'Apartment Complex' ? 'selected' : '' }}">Apartment Complex</option>
                                                <option value="Villa Compound"{{ $cat->property_type_en == 'Villa Compound' ? 'selected' : '' }}>Villa Compound</option>
                                                <option value="Industrial"{{ $cat->property_type_en == 'Industrial' ? 'selected' : '' }}>Industrial</option>
                                                <option value="Office Building" {{ $cat->property_type_en == 'Office Building' ? 'selected' : '' }}>Office Building</option>
                                                <option value="Hotels" {{ $cat->property_type_en == 'Hotels' ? 'selected' : '' }}>Hotels</option>
                                                <option value="Medical" {{ $cat->property_type_en == 'Medical' ? 'selected' : '' }}>Medical</option>
                                                <option value="Vacation Home" {{ $cat->property_type_en == 'Vacation Home' ? 'selected' : '' }}>Vacation Home</option>

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
                                            <select name="prop_type_ar" class="@error('prop_type_ar') is-invalid @enderror">
                                                <option value="" selected disabled>اختر صنف</option>
                                                <optgroup label="Residential"></optgroup>
                                                <option value="فلل" {{ $cat->property_type_ar == 'فلل' ? 'selected' : '' }}>فلل</option>
                                                <option value="شقة" {{ $cat->property_type_ar == 'شقة' ? 'selected' : '' }}>-شقة</option>
                                                <option value="ستوديو" {{ $cat->property_type_ar == 'ستوديو' ? 'selected' : '' }}> ستوديو</option>
                                                <option value="تاون هاوس" {{ $cat->property_type_ar == 'تاون هاوس' ? 'selected' : '' }}>تاون هاوس</option>
                                                <option value="عمارة سكنية" {{ $cat->property_type_ar == 'عمارة سكنية' ? 'selected' : '' }}>عمارة سكنية</option>
                                                <option value="مجمع فلل" {{ $cat->property_type_ar == 'مجمع فلل' ? 'selected' : '' }}>مجمع فلل</option>
                                                <option value="مجمع فلل" {{ $cat->property_type_ar == 'مجمع فلل' ? 'selected' : '' }}>مجمع فلل</option>
                                                <optgroup label="Commercial"></optgroup>
                                                <option value="مجمع عمائر سكنية" {{ $cat->property_type_ar == 'مجمع عمائر سكنية' ? 'selected' : '' }}>مجمع عمائر سكنية</option>
                                                <option value="مجمع فلل" {{ $cat->property_type_ar == 'مجمع فلل' ? 'selected' : '' }}>مجمع فلل</option>
                                                <option value="مستودعات صناعية" {{ $cat->property_type_ar == 'مستودعات صناعية' ? 'selected' : '' }}>مستودعات صناعية</option>
                                                <option value="برج مكاتب" {{ $cat->property_type_ar == 'برج مكاتب' ? 'selected' : '' }}>برج مكاتب</option>
                                                <option value="فنادق" {{ $cat->property_type_ar == 'فنادق' ? 'selected' : '' }}>فنادق</option>
                                                <option value="مجمع طبي" {{ $cat->property_type_ar == 'مجمع طبي' ? 'selected' : '' }}>مجمع طبي</option>
                                                <option value="بيوت للعطلة" {{ $cat->property_type_ar == 'بيوت للعطلة' ? 'selected' : '' }}>بيوت للعطلة</option>
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
                                    <button type="button" class="dashboard-reset" onclick="this.form.reset();">Reset</button>
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
