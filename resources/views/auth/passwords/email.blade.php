@extends('layouts.app')

@section('content')
    <section class="investor-signup invest_growth invs-signup-3">
        <div class="container">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="row">
                    <div class="col-md-2 col-sm-2 col-12"></div>
                    <div class="col-md-8 col-sm-8 col-12">
                        <div class="inv_snup">
                            <div class="investor_info-1 text-center">
                                <h2>{{ __('Reset Password') }}</h2>
                            </div>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="firm_sec text-center">
                            <div class="row">
                                <div class="col-md-12">
                                    <input id="email" type="email"
                                           class="form-control gbr_blck @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="fix-positioned">
                        <div class="row ">
                            <div class="col-md-6 col-sm-6 col-12">
                            </div>
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="next-1 text-center">
                                    <input type="submit" class="btn-17 btn" value="{{ __('Send Password Reset Link') }}" style="float: unset">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
