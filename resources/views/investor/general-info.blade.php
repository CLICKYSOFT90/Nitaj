@extends('layouts.app')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | General Info</title>
@endsection

@section('content')
    <section class="invest_growth invs-signup-3">
        <form action="{{ route('general-info') }}" method="post" id="form">
            @csrf
            <div class="container">
                <div class="row">
                    <!-- <div class="col-md-2 col-sm-2 col-12"></div> -->
                    <div class="col-md-12 col-sm-12 col-12">
                        <!--multisteps-form-->
                        <div class="multisteps-form">
                            <!--progress bar-->
                            <div class="row">
                                <div class="col-md-1 col-sm-0 col-12"></div>
                                <div class="col-md-10 col-sm-0 col-12">
                                    <div class="multisteps-form__progress">
                                        <button class="multisteps-form__progress-btn js-active" type="button" title="User Info">
                                            <span>{{ __('auth.id_verification') }}</span></button>
                                        <button class="multisteps-form__progress-btn js-active" type="button" title="Address"><span>{{ __('auth.national_address_verification') }}</span></button>
                                        <button class="multisteps-form__progress-btn js-active" type="button" title="Order Info"><span>{{ __('auth.general_info') }}</span></button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Order Info"><span>{{ __('auth.financial_status') }}</span></button>
                                    </div>
                                </div>
                                <div class="col-md-1 col-sm-0 col-12"></div>

                            </div>
                        </div>
                        <!--form panels-->
                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-12"></div>
                            <div class="col-md-8 col-sm-8  col-12">
                                    <!--single1 form panel-->
                                    <div class="invs_hdr ">
                                        <h2 class="text-left">{{ __('auth.general_info') }}</h2>
                                    </div>
                                    <div class="firm_sec">
                                        <form action="">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-12">
                                                    <div class="select-fields">
                                                        <label for="social_status">{{ __('auth.social_status') }}</label>
                                                        <select required name="social_status" id="social_status" class="@error('social_status') is-invalid @enderror">
                                                            <option value="" selected disabled>{{ __('auth.select_social_status') }}</option>
                                                            <option value="single">{{ __('auth.single') }}</option>
                                                            <option value="married">{{ __('auth.married') }}</option>
                                                            <option value="widow">{{ __('auth.widow') }}</option>
                                                            <option value="divorced">{{ __('auth.divorced') }}</option>
                                                        </select>
                                                        @error('social_status')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-12">
                                                    <div class="select-fields">
                                                        <label for="curr_occupation">{{ __('auth.curr_occ') }}</label>
                                                        <select required name="curr_occupation" id="curr_occupation" class="@error('curr_occupation') is-invalid @enderror">
                                                            <option value="" disabled selected>{{ __('auth.select_curr_occ') }}</option>
                                                            <option value="retired">{{ __('auth.retired') }}</option>
                                                            <option value="business owner">{{ __('auth.bussiness_owner') }}</option>
                                                            <option value="employee">{{ __('auth.employee') }}</option>
                                                            <option value="unemployed">{{ __('auth.unemployee') }}</option>
                                                            <option value="student">{{ __('auth.student') }}</option>
                                                            <option value="other">{{ __('auth.other') }}</option>
                                                        </select>
                                                        @error('curr_occupation')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-12">
                                                    <div class="select-fields">
                                                        <label for="edu_lvl">{{ __('auth.edu_lvl') }}</label>
                                                        <select required name="edu_lvl" id="edu_lvl" class="@error('edu_lvl') is-invalid @enderror">
                                                            <option value="" disabled selected>{{ __('auth.select_edu_lvl') }}</option>
                                                            <option value="post graduate">{{ __('auth.post_graduate') }}</option>
                                                            <option value="undergraduate">{{ __('auth.undergraduate') }}</option>
                                                            <option value="high school">{{ __('auth.high_school') }}</option>
                                                            <option value="other">{{ __('auth.other') }}</option>
                                                        </select>
                                                        @error('edu_lvl')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                <div class="row">
                                    <div class="col-md-8 col-sm-8 col-12">
                                        <div class="select-fields">
                                            <label for="worked_in_financial_sector">{{ __('auth.worked_in_financial_sector') }}
                                            </label>
                                            <select required name="worked_in_financial_sector" id="worked_in_financial_sector" class="@error('worked_in_financial_sector') is-invalid @enderror">
                                                <option value="" disabled selected>{{ __('auth.select_worked_in_financial_sector') }}</option>
                                                <option value="1">{{ __('auth.yes') }}</option>
                                                <option value="0">{{ __('auth.no') }}</option>
                                            </select>
                                            @error('worked_in_financial_sector')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="select-fields">
                                            <label for="practical_experience">{{ __('auth.practical_experience') }}

                                            </label>
                                            <select required name="practical_experience" id="practical_experience" class="@error('practical_experience') is-invalid @enderror">
                                                <option value="" disabled selected>{{ __('auth.select_practical_experience') }}</option>
                                                <option value="1">{{ __('auth.yes') }}</option>
                                                <option value="0">{{ __('auth.no') }}</option>
                                            </select>
                                            @error('practical_experience')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="select-fields">
                                            <label for="real_estate_investing_exp">{{ __('auth.real_estate_investing_exp') }}
                                            </label>
                                            <select required name="real_estate_investing_exp" id="real_estate_investing_exp" class="@error('real_estate_investing_exp') is-invalid @enderror">
                                                <option value="" disabled selected>{{ __('auth.select_real_estate_investing_exp') }}</option>
                                                <option value="no expereince">{{ __('auth.no_exp') }}</option>
                                                <option value="good">{{ __('auth.good') }}</option>
                                                <option value="extensive">{{ __('auth.extensive') }}</option>
                                            </select>
                                            @error('real_estate_investing_exp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="select-fields">
                                            <label for="board_director_audit_commitee">{{ __('auth.board_director_audit_commitee') }}

                                            </label>
                                            <select required name="board_director_audit_commitee" id="board_director_audit_commitee" class="@error('board_director_audit_commitee') is-invalid @enderror">
                                                <option value="" disabled selected>{{ __('auth.selects_board_director_audit_commitee') }}</option>
                                                <option value="1">{{ __('auth.yes') }}</option>
                                                <option value="0">{{ __('auth.no') }}</option>
                                            </select>
                                            @error('board_director_audit_commitee')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="select-fields">
                                            <label for="relationship">{{ __('auth.relationship_ques') }}
                                            </label>
                                            <select required name="relationship" id="relationship" class="@error('relationship') is-invalid @enderror">
                                                <option value="" disabled selected>{{ __('auth.select_relationship_ques') }}</option>
                                                <option value="1">{{ __('auth.yes') }}</option>
                                                <option value="0">{{ __('auth.no') }}</option>
                                            </select>
                                            @error('relationship')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="select-fields">
                                            <label for="beneficial_owner_business">{{ __('auth.beneficial_owner_business') }}
                                            </label>
                                            <select required name="beneficial_owner_business" id="beneficial_owner_business" class="@error('beneficial_owner_business') is-invalid @enderror">
                                                <option value="" disabled selected> {{ __('auth.select_beneficial_owner_business') }}</option>
                                                <option value="yes, I am the beneficiary"> {{ __('auth.yes_iam_beni') }}</option>
                                                <option value="no, I am not the direct beneficiary">{{ __('auth.no_iam_beni') }}</option>
                                            </select>
                                            @error('beneficial_owner_business')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-12"></div>

                        </div>
                    </div>
                </div>
                <div class="fix-positioned">
                    <div class="row ">
{{--                        <div class="col-md-6 col-sm-6 col-12">--}}
{{--                            <div class="back-1">--}}
{{--                                <a class="btn-16 js-btn-prev"--}}
{{--                                   href="{{ route('step','id-verification') }}">{{ __('auth.back') }}</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-md-6 col-sm-6 col-12">
                            <div class="next-1 text-center">
                                <input type="submit" class="btn btn-17" value="{{ __('auth.next') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('#form').validate({
                messages: {
                    social_status: {
                        required: '{{ __('auth.required') }}'
                    },
                    curr_occupation: {
                        required: '{{ __('auth.required') }}'
                    },
                    edu_lvl: {
                        required: '{{ __('auth.required') }}'
                    },
                    worked_in_financial_sector: {
                        required: '{{ __('auth.required') }}'
                    },
                    practical_experience: {
                        required: '{{ __('auth.required') }}'
                    },
                    real_estate_investing_exp: {
                        required: '{{ __('auth.required') }}'
                    },
                    board_director_audit_commitee: {
                        required: '{{ __('auth.required') }}'
                    },
                    relationship: {
                        required: '{{ __('auth.required') }}'
                    },
                    beneficial_owner_business: {
                        required: '{{ __('auth.required') }}'
                    }
                }
            });
        });
    </script>
@endsection
