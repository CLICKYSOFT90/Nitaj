@extends('layouts.investor.investor')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | {{ __('setting.settings') }}</title>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="profile_settings">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="settings-heading">
                    <h2>Settings</h2>
                </div>
                <div class="verified_sec">
                    <div class="fflt_fttp">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="for_profile_hd1 ">
                                    <h2>Profile Settings</h2>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-6">
                                <div class="for_btn_verify">
                                    <a  class="sbmt-btn">Verified</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{route('investor.profile-settings')}}" id="profile-settings" method="post">
                        @csrf
                        @method('put')
                        <div class="dash_verification_form_sec">
                            <div class="row">
                                <div class="col-md-8 col-sm-8 col-12">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="ip_fields1">
                                                <input type="text" class="gbr_blck disable"
                                                    placeholder="First Name" name="fname"
                                                    value="{{$investor->fname}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="ip_fields1">
                                                <input type="text" class="gbr_blck disable"
                                                    placeholder="Last Name" name="lname"
                                                    value="{{$investor->lname}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="ip_fields1">
                                                <input type="text" class="gbr_blck disable" name="national_id"
                                                    placeholder="National ID"
                                                    value="{{$investor->nationalIdVeriification[0]->national_id}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="ip_fields1">
                                                <input type="text" class="gbr_blck disable"
                                                    placeholder="Date of Birth" name="dob" id="dob"
                                                    value="{{ \Carbon\Carbon::parse($investor->nationalIdVeriification[0]->dob)->format('d/m/Y')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="ip_fields1">
                                                <input type="text" class="gbr_blck disable"
                                                    placeholder="Expiry Date" name="id_expire"
                                                     id="id_expire"
                                                    value="{{ \Carbon\Carbon::parse($investor->nationalIdVeriification[0]->id_expire)->format('d/m/Y')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="profile-sec-buttons">
                                    {{-- <a class="sbmt-btn edit">Edit</a>
                                    <button type="submit" class="sell-btn">Confirm</button> --}}
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="for_language1 national_address">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="verified_sec">
                    <div class="fflt_fttp">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="for_profile_hd1 ">
                                    <h2>National Address</h2>
                                    <div class="for_btn_verify">
                                        <a  class="sbmt-btn">Verified</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-6">
                                {{-- <div class="for_national_address">
                                    <a href="#" class="sell-btn disable">EDIT</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="dash_verification_form_sec">
                        <div class="row">
                            <div class="col-md-8 col-sm-8 col-12">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="ip_fields1">
                                            <input type="text" class="gbr_blck disable"
                                            placeholder="Building No."
                                            value="{{$investor->nationalIdVeriification[0]->building_number}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="ip_fields1">
                                            <input type="text" class="gbr_blck disable"
                                            placeholder="District"
                                            value="{{$investor->nationalIdVeriification[0]->district}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="ip_fields1">
                                            <form action="">
                                                <input type="text" class="gbr_blck disable"
                                                placeholder="Street Name"
                                                value="{{$investor->nationalIdVeriification[0]->street_name}}">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="ip_fields1">
                                            <form action="">
                                                <input type="text" class="gbr_blck disable"
                                                placeholder="Zipcode"
                                                value="{{$investor->nationalIdVeriification[0]->postal_code}}">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="ip_fields1">
                                            <form action="">
                                                <input type="text" class="gbr_blck disable"
                                                    placeholder="Country" value="Saudi Arabia">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="ip_fields1">
                                            <form action="">
                                                <input type="text" class="gbr_blck disable"
                                                placeholder="City"
                                                value="{{$investor->nationalIdVeriification[0]->city}}">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="profile-sec-buttons">
                                {{-- <a class="sbmt-btn">Edit</a>
                                <a class="sell-btn">Confirm</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="for_language1 mobile_sec">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="verified_sec">
                    <form action="{{route('investor.mobile')}}" id="mobile-form" method="post">
                        @csrf @method('put')
                        <div class="fflt_fttp">
                            <div class="row df_aic">
                                <div class="col-md-6 col-sm-6 col-6">
                                    <div class="for_profile_hd1">
                                        <h2>Mobile</h2>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-6">
                                    <div class="org_nation ">
                                        <a href="#" class="sell-btn edit">Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dash_verification_form_sec">
                            <div class="row">
                                <div class="col-md-8 col-sm-8 col-12">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-12">
                                            <div class="ip_fields1">
                                                <input type="text" class="gbr_blck f_width disable"         id="mobile"
                                                placeholder="+966 559774411" name="mobile"
                                                value="{{$investor->mobile}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-12">
                                            <div class="for_btn_verify">
                                                <a href="javascript:;" class="sbmt-btn">Verified</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="profile-sec-buttons">
                                        {{-- <a href="#" class="sbmt-btn" id="mobile-confirm">Confirm</a> --}}
                                        <button type="submit" class="sbmt-btn" id="mobile-confirm">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="for_language1 email_sec">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="verified_sec">
                    <div class="fflt_fttp">
                        <div class="row df_aic">
                            <div class="col-md-6 col-sm-6 col-6">
                                <div class="for_profile_hd1">
                                    <h2>Email</h2>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-6">
                                {{-- <div class="org_nation ">
                                    <a href="#" class="sell-btn">Edit</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="dash_verification_form_sec">
                        <div class="row">
                            <div class="col-md-8 col-sm-8 col-12">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-12">
                                        <div class="ip_fields1">
                                            <input type="text" class="gbr_blck f_width disable"
                                            placeholder="Ammarmazhar@hotmail.com" value="{{$investor->email}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-12">
                                        <div class="for_lg_ft">
                                            <a class="sell-btn">Verified</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                {{-- <div class="profile-sec-buttons">
                                    <a href="#" class="sbmt-btn">Confirm</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="for_language1 bank_sec">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="verified_sec">
                    <form action="{{ route('investor.back-account') }}"  id="bank-account" method="post">
                        @csrf @method('put')
                        <div class="fflt_fttp">
                                <div class="row df_aic">
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <div class="for_profile_hd1">
                                            <h2>Bank Account Info</h2>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <div class="org_nation ">
                                            <a href="#" class="sell-btn edit">Edit</a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="dash_verification_form_sec">
                            <div class="row">
                                <div class="col-md-8 col-sm-8 col-12">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="ip_fields1">
                                                <input type="text" class="gbr_blck disable" name="iban" placeholder="IBAN" value="{{ auth()->user()->iban }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-12">
                                            <div class="ip_fields1">
                                                <input type="text" class="gbr_blck" name="name" placeholder="Bank Name" value="{{ auth()->user()->bank_name }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="profile-sec-buttons">
                                            <!-- <a href="#" class="sbmt-btn">Edit</a> -->
                                        <button class="sbmt-btn">Confirm</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{--    <div class="for_language1 investment_power_of_attorney_sec">--}}
{{--        <div class="d-flex flex-column-fluid">--}}
{{--            <div class="container">--}}
{{--                <div class="verified_sec">--}}
{{--                    <div class="fflt_fttp">--}}
{{--                        <div class="row df_aic">--}}
{{--                            <div class="col-md-6 col-sm-6 col-6">--}}
{{--                                <div class="for_profile_hd1">--}}
{{--                                    <h2>Investment Power of Attorney</h2>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6 col-sm-12 col-6">--}}
{{--                                <div class="power-of-attorney-buttons">--}}
{{--                                    <a href="#" class="sell-btn">Edit</a>--}}
{{--                                    <a href="#" class="sbmt-btn">New Upload</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="dash_verification_form_sec">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-4 col-sm-6 col-12">--}}
{{--                                <div class="down_pdf for_famio">--}}
{{--                                    <a href="#" class="d_f1a for_famio"><span--}}
{{--                                            class="dl_f1">DOWNLOAD</span></a>--}}
{{--                                    <a href="#" class="p_f1a">--}}
{{--                                        <p class="pa_f1">Power of Attorney.pdf</p>--}}
{{--                                    </a>--}}
{{--                                    <a href="#" class="f_iac"><img src="./images/green-cross.png" alt=""--}}
{{--                                            class="img-fluid"></a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row mb-5">--}}
{{--                        </div>--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-12 col-sm-12 col-12">--}}
{{--                                <div class="org_nation">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
@endsection
@section('scripts')
<script>
    $(".disable").prop('disabled',true);
    $('#dob, #id_expire').datepicker({
        format: 'dd/mm/yyyy'
        // todayHighlight: true,
        // templates: {
        //     leftArrow: '<i class=\"la la-angle-left\"></i>',
        //     rightArrow: '<i class=\"la la-angle-right\"></i>'
        // }
    });

    // edit btn all forms
    $('.edit').click(function(e){
        e.preventDefault();
        var form = $(this).parents('form').attr('id');
        $('#'+form).find("input").prop('disabled',false);
    });

    //mobile-form submit
    $('#mobile-confirm').click(function(e){
        e.preventDefault();
        $('#mobile-form').find("input").prop('disabled',false);

        // var regex = /^((\+{1})([0-9]{3})(\s{1})([0-9]{9}))$/;
        var regex = /^((?:[+?0?0?966]+)(?:\s?\d{2})(?:\s?\d{7}))$/;
        if(regex.test($('#mobile').val())){
            $('#mobile-form').submit();
        }else{
            alert("mobile format is invalid");
        }
    });
//     $.validator.addMethod(
//         "regex",
//         function(value, element, regexp) {
//             var re = new RegExp(regexp);
//             return this.optional(element) || re.test(value);
//         },
//         "Please check your input."
//     );
//     $("#mobile-form").rules("add", { regex: /^((\+{1})([0-9]{3})(\s{1})([0-9]{9}))/ })

//     $('#mobile-form').validate({
//         rules: {
//             mobile: {
//                 required: true,
//                 regex:true
//             },
//         },
//         messages: {
//             mobile: {
//                 required: '{{ __('auth.required') }}',
//                 regex:"Mobile fromat is invalid."
//             },
//         }
//     });
    // $('#mobile-form').on('submit',function(e){
    //     e.preventDefault();
    //     $(this).find("input").prop('disabled',false);
    //     if($('#mobile-form').validate()){
    //         // $(this)[0].submit();
    //     }


    // })

</script>
@endsection
