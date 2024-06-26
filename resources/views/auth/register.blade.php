@extends('layouts.app')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Register</title>
@endsection

@section('content')
    <section class="investor-signup invest_growth invs-signup-3">
        <div class="container">
            <form method="POST" action="{{ route('register') }}" id="form" autocomplete="off">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-12"></div>
                    <div class="col-md-8 col-sm-8 col-12">
                        <div class="inv_snup">
                            <div class="investor_info-1 text-center">
                                <h2>{{ __('auth.signup') }}</h2>
                                <p class="greetings_color">{{ __('auth.greetings') }}</p>
                            </div>
                        </div>
                        <div class="firm_sec text-center">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="select-fields for-drop-width">
                                        <label for="investor_type"
                                               class="investor-label @error('investor_type') is-invalid @enderror"
                                               style="margin-left: 52px;">{{ __('auth.reg_type') }}</label>
                                        <select name="investor_type" id="investor_type" required>
                                            <option value="" selected>{{ __('auth.select_reg_type') }}</option>
                                            <option value="real_estate">{{ __('auth.invest_real_estate') }}</option>
                                            <option value="raise_funds">{{ __('auth.raise_funds') }}</option>
                                        </select>
                                        @error('investor_type')
                                        <span class="invalid-feedback form-error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="first">What is your name?</label>
                                        <input id="first" class="form-input" type="text" />
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="ikr_inp">
                                        <div class="form-group {{ old('fname') ? 'focused' : '' }}">
                                            <label class="form-label" for="first">{{ __('auth.first_name') }}
                                                *</label>
                                            <input id="fname" class="form-input @error('fname') is-invalid @enderror"
                                                   value="{{ old('fname') }}" name="fname" type="text"/>
                                            @error('fname')
                                            <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="ikr_inp">
                                        <div class="form-group {{ old('lname') ? 'focused' : '' }}">
                                            <label class="form-label" for="last">{{ __('auth.last_name') }}
                                                *</label>
                                            <input required type="text" id="last"
                                                   class="form-input @error('lname') is-invalid @enderror" name="lname"
                                                   value="{{ old('lname') }}"/>
                                            @error('lname')
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
                                        <div class="form-group {{ old('email') ? 'focused' : '' }}">
                                            <label class="form-label" for="email">{{ __('auth.email') }}
                                                *</label>
                                            <input required type="text" id="email"
                                                   class="form-input @error('email') is-invalid @enderror" name="email"
                                                   value="{{ old('email') }}" autocomplete="off"/>
                                            @error('email')
                                            <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- <input required type="email" class="gbr_blck @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}"
                                            placeholder="{{ __('auth.email') }} *">
                                        @error('email')
                                            <span class="invalid-feedback form-error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="ikr_inp position-relative">
                                        <div class="form-group">
                                            <label class="form-label" for="password">{{ __('auth.password') }}
                                                *</label>
                                            <input required type="password" id="password"
                                                   class="form-input @error('password') is-invalid @enderror change-pass-attr"
                                                   autocomplete="off" name="password"/>
                                            <span id="showPass">
                                                <i class="fa fa-eye"
                                                   style="cursor: pointer; position: absolute; top: 5px; right: 62px; font-size: 17px;"></i>
                                            </span>
                                            @error('password')
                                            <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- <input required type="password"
                                            class="gbr_blck @error('password') is-invalid @enderror change-pass-attr"
                                            name="password" placeholder="{{ __('auth.password') }} *" id="password">
                                        <span id="showPass">
                                            <i class="fa fa-eye"
                                                style="cursor: pointer; position: absolute; top: 5px; right: 62px; font-size: 17px;"></i>
                                        </span>
                                        @error('password')
                                            <span class="invalid-feedback form-error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row reg-align">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="intl-tel-input allow-dropdown separate-dial-code iti-sdc-4 mb-2">
                                        <div class="flag-container">
                                            <div class="selected-flag" tabindex="0"
                                                 title="Saudi Arabia (‫المملكة العربية السعودية‬‎): +966">
                                                <div class="iti-flag sa"></div>
                                                <div class="selected-dial-code">+966</div>
                                                <div class="iti-arrow"></div>
                                            </div>
                                        </div>
                                        <input name="mobile" id="phone" type="tel"
                                               onkeyup="this.value=this.value.replace(/[^0-9]/g, '');" maxlength="9"
                                               autocomplete="off" placeholder="51 234 5678" aria-invalid="false" value="{{ old('mobile') }}"></div>
                                    @error('mobile')
                                    <span class="invalid-feedback form-error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                    <div id="error-msg" class="hide error">Invalid number</div>
                                    {{--                                    <div class="ikr_inp">--}}
                                    {{--                                        <input required type="text" maxlength="13"--}}
                                    {{--                                            class="gbr_blck @error('mobile') is-invalid @enderror" name="mobile"--}}
                                    {{--                                            onkeyup="this.value=this.value.replace(/[^0-9]/g, '');"--}}
                                    {{--                                            value="{{ old('mobile') }}" placeholder="+966 - xxxxxxxxx *">--}}
                                    {{--                                        @error('mobile')--}}
                                    {{--                                            <span class="invalid-feedback form-error" role="alert">--}}
                                    {{--                                                <strong>{{ $message }}</strong>--}}
                                    {{--                                            </span>--}}
                                    {{--                                        @enderror--}}
                                    {{--                                    </div>--}}
                                </div>
                                <div class="col-md-6 col-sm-6 col-12 mt-4">
                                    <div class="ikr_inp position-relative">
                                        <div class="form-group">
                                            <label class="form-label" for="confirm-password">{{ __('auth.c_password') }}
                                                *</label>
                                            <input required type="password" id="confirm-password"
                                                   class="form-input  @error('password') is-invalid @enderror change-confirm-pass-attr"
                                                   autocomplete="off" name="password_confirmation"/>
                                            <span id="showConfirmPass">
                                                <i class="fa fa-eye"
                                                   style="cursor: pointer; position: absolute; top: 5px; right: 62px; font-size: 17px;"></i>
                                            </span>
                                            @error('password')
                                            <span class="invalid-feedback form-error" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- <input required type="password"
                                            class="gbr_blck @error('password') is-invalid @enderror change-confirm-pass-attr"
                                            name="password_confirmation" placeholder="{{ __('auth.c_password') }} *">
                                        <span id="showConfirmPass">
                                            <i class="fa fa-eye"
                                                style="cursor: pointer; position: absolute; top: 5px; right: 62px; font-size: 17px;"></i>
                                        </span>
                                        @error('password')
                                            <span class="invalid-feedback form-error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror --}}
                                    </div>
                                </div>
                            </div>
                            <div class="for_chkbx text-center">
                                <p>
                                    @error('accept_tnc')
                                    <span class="invalid-feedback form-error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </p>
                                <p class="font_familia">
                                    <input type="checkbox" name="accept_tnc" required>{{ __('auth.accept') }} <a
                                        href="#"
                                        class="terms_color">{{ __('auth.terms') }}</a>
                                    {{ __('auth.and') }}
                                    <a href="#" class="terms_color">{{ __('auth.privacy_policy') }}</a>
                                </p>
                                <p class="font_familia1">{{ __('auth.already_account') }} <a
                                        href="{{ route('login') }}"
                                        class="terms_color">{{ __('auth.click_here') }}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="fix-positioned">
                        <div class="row ">
                            <div class="col-md-6 col-sm-6 col-12">
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="next-1 text-center">
                                    <input type="submit" class="btn-17 btn" value="{{ __('auth.next') }}">
                                </div>
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
        $(document).ready(function () {
            $('#showPass').on('click', function () {
                var passInput = $(".change-pass-attr");
                if (passInput.attr('type') === 'password') {
                    passInput.attr('type', 'text');
                    $('#showPass i').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
                } else {
                    passInput.attr('type', 'password');
                    $('#showPass i').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
                }
            })
            $('#showConfirmPass').on('click', function () {
                var passConfirmInput = $(".change-confirm-pass-attr");
                if (passConfirmInput.attr('type') === 'password') {
                    passConfirmInput.attr('type', 'text');
                    $('#showConfirmPass i').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
                } else {
                    passConfirmInput.attr('type', 'password');
                    $('#showConfirmPass i').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
                }
            })
        })

        jQuery.validator.addMethod("password", function (value, element) {
                var result = this.optional(element) || value.length >= 8 && /\d/.test(value) && /[A-Z]/.test(value) &&
                    /[a-z]/.test(value);
                return result;
            },
            "Password must be at least 8 characters long.<br> Password must have one number.<br> Password must have one special character.<br> Password must have one uppercase letter.<br> Password must have one lowercase letter."
        )
        {{-- }, "{{ __('auth.pass_contains') }}") --}}
        jQuery.validator.addMethod("hasUppercase", function (value, element) {
            if (this.optional(element)) {
                return true;
            }
            return /[A-Z]/.test(value);
        }, "{{ __('auth.upper_case') }}");

        jQuery.validator.addMethod("hasLowercase", function (value, element) {
            if (this.optional(element)) {
                return true;
            }
            return /[a-z]/.test(value);
        }, "{{ __('auth.lower_case') }}");
        $(document).ready(function () {
            $('#form').validate({
                rules: {
                    password: {
                        password: true,
                    },
                    mobile: {
                        required: true,
                    },
                    fname: {
                        required: true
                    },
                },
                messages: {
                    fname: {
                        required: '{{ __('auth.required') }}'
                    },
                    lname: {
                        required: '{{ __('auth.required') }}'
                    },
                    mobile: {
                        required: '{{ __('auth.required') }}'
                    },
                    password: {
                        required: '{{ __('auth.required') }}'
                    },
                    password_confirmation: {
                        required: '{{ __('auth.required') }}'
                    },
                    investor_type: {
                        required: '{{ __('auth.required') }}'
                    },
                    accept_tnc: {
                        required: '{{ __('auth.required') }}'
                    },
                    email: {
                        required: "{{ __('auth.required') }}",
                        email: "{{ __('auth.email_format') }}"
                    }
                }
            });
        });
    </script>
@endsection
