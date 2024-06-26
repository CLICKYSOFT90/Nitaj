@extends('layouts.app')

@section('content')
    <section class="investor-signup invest_growth invs-signup-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="bg-light p-5 rounded">

                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('auth.verification_heading') }}
                        </div>
                    @endif

                    {{ __('auth.verification_msg') }}
                    <form action="{{ route('verification.resend') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="d-inline btn btn-link p-0">
                            {{ __('auth.verification_link') }}
                        </button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection
