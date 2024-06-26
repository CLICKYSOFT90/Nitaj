@extends('layouts.login')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Login</title>
@endsection

@section('content')
    <section class="logn_section">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-12 k_pr">
                            <div class="building_pic">
                                <img src="{{ asset('images/building.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-12 p-0">
                            <form action="{{ route('login') }}" method="post">
                                @csrf
                                <div class="welcome_sec">
                                    <div class="ntaj_logo text-center">
                                        <img src="{{ asset('images/nav-logo.png') }}" width="80px" alt="" class="img-fluid">
                                        <p class="ntj_text">{{ __('auth.welcome') }}</p>
                                    </div>
                                    @if(session()->has('blocked'))
                                        <div class="alert alert-danger">
                                            <strong>{{ session()->get('blocked') }}</strong>
                                        </div>
                                    @endif
                                    <div class="form-sec">
                                        <div class="mb-4">
                                            <input type="text"
                                                   class="input1 @error('email') is-invalid @enderror {{ session()->has('error') ? 'is-invalid' : '' }}"
                                                   placeholder="{{ __('auth.email') }}" name="email"
                                                   value="{{ old('email') }}" required>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            @if(session()->has('error'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ session()->get('error') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <input type="password"
                                                   class="input2 @error('password') is-invalid @enderror {{ session()->has('error') ? 'is-invalid' : '' }}"
                                                   placeholder="{{ __('auth.password') }}" name="password" required>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            @if(session()->has('error'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ session()->get('error') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="row tkn-set ">
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="for-remember">
                                                    <div class="checkbox checkbox_allow_div">
                                                        <label class="label_300">
                                                            <input type="checkbox" name="remember" value="1"
                                                                   class="allow_checkbox">
                                                            <p>{{ __('auth.remember_me') }}</p>
                                                        </label>

                                                    </div>
                                                </div>
                                            </div>
                                            @if (Route::has('password.request'))
                                                <div class="col-md-6 col-sm-6 col-12">
                                                    <div class="for-under-forgot">
                                                        <a href="{{ route('password.request') }}">{{ __('auth.forgot_password') }}</a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="lgn_signup text-center">
                                        <button type="submit" class="hov_btn">{{ __('auth.login') }}</button>
                                        <a href="{{ route('register') }}" class="btn11">{{ __('auth.signup') }}</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
