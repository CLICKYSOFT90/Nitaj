@extends('layouts.investor.investor')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | {{ __('dashboard.UPGRADE TO PRO') }}</title>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="wd-3">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <form action="{{ route('investor.upgrade.post') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <h3>
                                    To Invest more than 200,000 SAR, one of the following conditions must be met to
                                    Upgrade your account to a Professional Investor as per the CMA requirements.
                                </h3>
                                <br>
                                <h4>
                                    Please select from the following options and upload your supporting document:
                                </h4>
                            </div>
                            <div class="col-md-12">
                                <div class="input-options">
                                    <label class="@error('made_transactions') is-invalid @enderror">Made transactions in the stock markets with a total value of not less than
                                        forty million Saudi riyals and not less than ten transactions in each quarter
                                        during the past twelve months.</label>
                                    <input type="file" name="made_transactions" id="made_transactions" accept="application/pdf,image/png,image/jpg,image/jpeg">
                                    @error('made_transactions')
                                        <span class="invalid-feedback form-error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-options">
                                    <label class="@error('net_assets') is-invalid @enderror">Net assets shall not be less than five million Saudi riyals.</label>
                                    <input type="file" name="net_assets" id="net_assets" accept="application/pdf,image/png,image/jpg,image/jpeg">
                                    @error('net_assets')
                                    <span class="invalid-feedback form-error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-options">
                                    <label class="@error('worked_previously') is-invalid @enderror">Worked or have previously worked in any investment or financial institutions
                                        for a period not less than 3 years.</label>
                                    <input type="file" name="worked_previously" id="worked_previously" accept="application/pdf,image/png,image/jpg,image/jpeg">
                                    @error('worked_previously')
                                        <span class="invalid-feedback form-error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-options">
                                    <label class="@error('pro_certificate') is-invalid @enderror">To be carrying a professional certificates that are internationally approved
                                        in the investments or financial sector</label>
                                    <input type="file" name="pro_certificate" id="pro_certificate" accept="application/pdf,image/png,image/jpg,image/jpeg">
                                    @error('pro_certificate')
                                        <span class="invalid-feedback form-error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-options">
                                    <label class="@error('trading_certificate') is-invalid @enderror">He shall be holding a Certificate for Trading Securities that is approved by
                                        the Authority, and providing that his annual income is not less than six hundred
                                        thousand Saudi riyals in the past two years.</label>
                                    <input type="file" name="trading_certificate" id="trading_certificate" accept="application/pdf,image/png,image/jpg,image/jpeg">
                                    @error('trading_certificate')
                                        <span class="invalid-feedback form-error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-options mt-10">
                                    <button type="submit" class="dashboard-save">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
