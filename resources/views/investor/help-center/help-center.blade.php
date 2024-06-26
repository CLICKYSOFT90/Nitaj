@extends('layouts.investor.investor')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | {{ __('help-center.help-center') }}</title>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="help_sec">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="help_ssc_sec p-0">
                    <div class="for_hlp_cntr">
                        <h2>Help Centre</h2>
                    </div>
                    <form action="{{route('investor.submit')}}" method="POST" id="complaint-form">
                    @csrf
                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                    <div class="row mb-5">
                        <div class="col-md-8 col-sm-8 col-12">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="input-options">
                                        <input type="text" name="subject" placeholder="Subject" value="{{ old('subject') }}" id="subject" class=" @error('subject') is-invalid @enderror {{ session()->has('error') ? 'is-invalid' : '' }}" required>
                                        @error('subject')
                                            <span class="invalid-feedback form-error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="input-options">
                                        <select class="@error('importance') is-invalid @enderror" name="importance" id="importance" required>
                                            <option value="">Select</option>
                                            <option value="high" {{ (old('importance') == 'high') ? 'selected':'' }}>high</option>
                                            <option value="low" {{ (old('importance') == 'low') ? 'selected':'' }}>low</option>
                                            <option value="medium" {{ (old('importance') == 'medium') ? 'selected':'' }}>medium</option>
                                        </select>
                                        @error('importance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5 for-end">
                        <div class="col-md-8 col-sm-8 col-12">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12">
                                    <div class="for_text_area">
                                        <textarea class=" @error('description') is-invalid @enderror {{ session()->has('error') ? 'is-invalid' : '' }}" name="description" id="description" cols="30" rows="10" required>{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback form-error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-12">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="for_hlp_btn">
                                {{-- <a href="#" class="sbmt-btn">SEND</a> --}}
                                <button class="dashboard-save" type="submit">SEND</button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="complain_sec">
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="tb_14_sec p-0">
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-12">
                            <div class="compln_hf1">
                                <h2>Complaints</h2>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" class="t_hd1 for-td-radius">ID</th>
                                            <th scope="col" class="t_hd1">Subject</th>
                                            <th scope="col" class="t_hd1 for-right-td">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        @foreach ($complaints as $complaint)
                                        <tr>
                                            <td>{{$complaint->id}}</td>
                                            <td>{{$complaint->subject}}</td>
                                            <td>{{$complaint->status}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
$('#complaint-form').validate({
    rules: {
        subject: {
            required: true,
        },
        importance: {
            required: true,
        },
        description: {
            required: true,
        },
    },
    messages: {
        subject: {
            required: '{{ __('auth.required') }}',
        },
        importance: {
            required: '{{ __('auth.required') }}',
        },
        description: {
            required: '{{ __('auth.required') }}',
        },

    }
});
</script>
@endsection
