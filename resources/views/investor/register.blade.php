@extends('layouts.app')

@section('content')
    <section class="investor-signup invest_growth invs-signup-3">
        <div class="container">
            <form method="POST" action="{{ route('register') }}">
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-12"></div>
                    <div class="col-md-8 col-sm-8 col-12">
                        <div class="inv_snup">
                            <div class="investor_info-1 text-center">
                                <h2>{{ __('auth.investor_info') }}</h2>
                                <p class="greetings_color">{{ __('auth.greetings') }}</p>
                            </div>
                        </div>
                        <div class="firm_sec text-center">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="ikr_inp">
                                        <input type="text" class="gbr_blck @error('fname') is-invalid @enderror"
                                               name="fname"
                                               value="{{ old('fname') }}" placeholder="{{ __('auth.first_name') }} *">
                                        @error('fname')
                                        <span class="invalid-feedback form-error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="ikr_inp">
                                        <input type="text" class="gbr_blck @error('lname') is-invalid @enderror"
                                               name="lname"
                                               value="{{ old('lname') }}" placeholder="{{ __('auth.last_name') }} *">
                                        @error('lname')
                                        <span class="invalid-feedback form-error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6  col-12">
                                    <div class="ikr_inp">
                                        <input type="email" class="gbr_blck @error('email') is-invalid @enderror"
                                               name="email" value="{{ old('email') }}"
                                               placeholder="{{ __('auth.email') }} *">
                                        @error('email')
                                        <span class="invalid-feedback form-error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="ikr_inp">
                                        <input type="password" class="gbr_blck @error('password') is-invalid @enderror"
                                               name="password" placeholder="{{ __('auth.password') }} *">
                                        @error('password')
                                        <span class="invalid-feedback form-error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="ikr_inp">
                                        <input type="text" class="gbr_blck @error('mobile') is-invalid @enderror"
                                               name="mobile"
                                               value="{{ old('mobile') }}" placeholder="{{ __('auth.mobile') }} *">
                                        @error('mobile')
                                        <span class="invalid-feedback form-error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
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
                                <input type="checkbox" name="accept_tnc">{{ __('auth.accept') }} <a href="#" class="terms_color">{{ __('auth.terms') }}</a>
                                {{ __('auth.and') }}
                                <a href="#" class="terms_color">{{ __('auth.privacy_policy') }}</a>
                            </p>
                            <p class="font_familia1">{{ __('auth.already_account') }} <a href="{{ route('login') }}" class="terms_color">{{ __('auth.click_here') }}</a>
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
            </form>
        </div>
    </section>
@endsection
