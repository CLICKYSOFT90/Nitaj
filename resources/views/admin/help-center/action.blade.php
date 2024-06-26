@extends('layouts.investor.investor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection
@section('title')
    <title>{{ config('app.name', 'Laravel') }} |Complaint</title>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="help_sec">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <ul class="tags-listing">
                        <li class="tags-list-item">
                            <a href="{{ route('admin.help-center') }}" class="tags-list-text">
                                <i class="fa fa-angle-left tag-icon" aria-hidden="true"></i>
                                Back
                            </a>
                        </li>
                        <li class="tags-list-item">
                            <a href="javascriptvoid:(0)" class="tags-list-text for-color">Complaint</a>
                        </li>
                        <li class="tags-list-item">
                            <a href="javascriptvoid:(0)" class="tags-list-text">
                                <i class="fa fa-angle-double-right tag-icon" aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="tags-list-item">
                            <a href="javascriptvoid:(0)" class="tags-list-text">Complaint</a>
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
                            <h2 class="pro-info">Complaint</h2>
                        </div>
                    </div>
                    <form action="{{ route('admin.help-center.update') }}" method="post" id="form">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{ $complaint->id }}">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <div class="input-options">
                                            <label>First Name</label>
                                            <input type="text" placeholder="First Name"
                                                value="{{ $complaint->user->fname }}" name="fname" class="@error('fname') is-invalid @enderror disable">
                                                @error('fname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-6">
                                        <div class="input-options">
                                            <label>Last Name</label>
                                            <input type="text" placeholder="Last Name"
                                                value="{{ $complaint->user->fname }}" name="lname" class="@error('lname') is-invalid @enderror disable">
                                                @error('lname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="input-options">
                                            <label>Complaint Subject</label>
                                            <input type="text" placeholder="Name" value="{{ $complaint->subject }}" name="subject" class="@error('subject') is-invalid @enderror disable">
                                            @error('subject')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-12">
                                        <div class="input-options">
                                            <label>Complaint Importance</label>
                                            <input type="text" placeholder="Name" value="{{ $complaint->importance }}" name="importance" class="@error('importance') is-invalid @enderror disable">
                                            @error('importance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-12">
                                        <div class="input-options">
                                            <label>Complaint Description</label>
                                            <p value="{{ $complaint->subject }}" name="description" class="@error('description') is-invalid @enderror disable">{{ $complaint->subject }}</p>
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-0 col-12">
                                <div class="input-options">
                                    <label>Complaint Status</label>
                                    <select name="status" class="@error('status') is-invalid @enderror">
                                        <option value="" selected disabled>Select Status</option>
                                        <option value="open" {{ $complaint->status == 'open' ? 'selected' : '' }}
                                        {{old('status') == 'open' ? 'selected' : ''}}>open</option>
                                        <option value="resolved" {{ $complaint->status == 'resolved' ? 'selected' : '' }}
                                        {{old('status') == 'resolved' ? 'selected' : ''}}>resolved</option>
                                        <option value="closed" {{ $complaint->status == 'closed' ? 'selected' : '' }}
                                        {{old('status') == 'closed' ? 'selected' : ''}}>closed</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="dashboard-buttons">
                                    {{-- <button type="button" class="dashboard-reset">Reset</button> --}}
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
            $(".disable").prop('disabled',true);
            $('#form').validate({
                rules: {
                    status: {
                        required: true,
                    },
                },messages: {
                    status: {
                        required: '{{ __('auth.required') }}'
                    },
                }
            });
        });
    </script>
@endsection
