@extends('layouts.investor.investor')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Vote</title>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="wd-3">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <div class="row ff_s">
                        <div class="col-md-12 col-sm-12 col-12">
                            <ul class="tags-listing">
                                <li class="tags-list-item"><a href="javascriptvoid:(0)"
                                                              class="tags-list-text"><i
                                            class="fa fa-angle-left tag-icon"
                                            aria-hidden="true"></i> {{ __('vote.Back') }}</a></li>
                                <li class="tags-list-item"><a href="javascriptvoid:(0)"
                                                              class="tags-list-text crumb-color">{{ __('vote.Voting') }}</a></li>
                                <li class="tags-list-item"><a href="javascriptvoid:(0)"
                                                              class="tags-list-text"><i
                                            class="fa fa-angle-double-right tag-icon"
                                            aria-hidden="true"></i></a></li>
                                <li class="tags-list-item"><a href="javascriptvoid:(0)"
                                                              class="tags-list-text">{{ __('vote.Vote Campaigns') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <div class="share-hd">
                        <div class="row df_aic">
                            <div class="col-md-12 col-sm-12 col-12">
                                <h4 class="campaign-text">{{ __('vote.Vote Campaigns') }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="share-listed-sec">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="investor-main-2">
                                    <div class="listed-box mb-5">
                                        <div class="listed-image">
                                            <img
                                                src="{{ asset('project-visual-uploads'.'/'.$vote_campaign->project->projectImages[0]->filename) }}"
                                                alt="" class="img-fluid">
                                        </div>

                                        <div class="shed-content">
                                            <!-- <h4>BS 0001</h4> -->
                                            <h3>{{ App::getLocale() == 'en' ? $vote_campaign->project->project_name_en : $vote_campaign->project->project_name_ar }}</h3>
                                            <p>{{ App::getLocale() == 'en' ? $vote_campaign->project->projectCompany->name_en : $vote_campaign->project->projectCompany->name_ar }}</p>
                                            <span>12/07/2020 To 12/09/2020</span>
                                        </div>
                                        <div class="valid-vt-button">
                                            <button class="vdt-btn">{{ __('vote.Valid Until') }}: {{ date('d M Y', strtotime($vote_campaign->ending_period)) }}</button>
                                        </div>


                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-4 col-sm-4 col-12">
                                            <div class="asset-list">
                                                <h4>{{ __('vote.Asset Type') }}</h4>
                                                <h3>{{ App::getLocale() == 'en' ? $vote_campaign->project->asset_type_en : $vote_campaign->project->asset_type_ar }}</h3>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-12">
                                            <div class="asset-list">
                                                <h4>{{ __('vote.Amount Funded') }}</h4>
                                                <h3>{{ getProjectTotalInvestments($vote_campaign->project->id) }}</h3>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-12">
                                            <div class="asset-list">
                                                <h4>{{ __('vote.Equity Share') }}</h4>
                                                <h3>0%</h3>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-4 col-sm-4 col-12">
                                            <div class="asset-list">
                                                <h4>{{ __('vote.Location') }}</h4>
                                                <h3>{{ $vote_campaign->project->project_location }}</h3>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-12">
                                            <div class="asset-list">
                                                <h4>{{ __('vote.Project Type') }}</h4>
                                                <h3>{{ App::getLocale() == 'en' ? $vote_campaign->project->project_type_en : $vote_campaign->project->project_type_ar }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-md-12">
                                            <div class="down-report-head">
                                                <h4>{{ __('vote.Investment Documents') }}</h4>
                                            </div>
                                        </div>
                                        @foreach($vote_campaign->project->projectDocuments as $doc)
                                            <div class="col-md-4 col-sm-4 col-12">

                                                <div class="down-report">
                                                    <h6>
                                                        {{ __('vote.DOWNLOAD') }}
                                                        <span class="dow_icon">
                                                            <a href="{{ asset('project-doc'.'/'.$doc->doc_name) }}"
                                                               download class="pull-right">
                                                                <img src="{{asset('images/download.png')}}" alt="">
                                                            </a>
                                                        </span>
                                                    </h6>
                                                    <p>{{ $doc->doc_name }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-12">
                                            <div class="vote-now-button">
                                                <button class="vot-btn" data-toggle="modal"
                                                        data-target="#voteModal">
                                                    {{ __('vote.Vote Now') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade wdraw-modal " id="voteModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideout modal-wd" role="document">
            <div class="modal-content buy-modal-content">

                <div class="vote-body">
                    <form id="cast-vote">
                        @csrf
                        <input type="hidden" value="{{ auth()->user()->id }}" name="user_id">
                        <input type="hidden" value="{{ $vote_campaign->id }}" name="vote_campaign_id">
                        <div class="vot-md-head">
                            <div class="vote-head">
                                <h3>Vote</h3>
                                <p>AM city Scraper investment period has ended Please vote for
                                    either extending the investment period or vote to sell.</p>
                            </div>
                            @if($vote_campaign->vote_type == 'Extend or Sell')
                                <input type="hidden" value="extend_or_sell" name="vote_cat">
                                <div class="sell-extend-button">
                                    <div class="form-check check-button">
                                        <input type="radio" class="form-check-input" checked id="check50"
                                               name="vote_type"
                                               value="Extend"/>
                                        <label class="form-check-label" for="check50">{{ __('vote.Extend') }}</label>
                                    </div>
                                    <div class="form-check check-button m-0">
                                        <input type="radio" class="form-check-input" id="check51" name="vote_type"
                                               value="Sell"/>
                                        <label class="form-check-label" for="check51">{{ __('vote.Sell') }}</label>
                                    </div>
                                </div>
                            @elseif($vote_campaign->vote_type == 'Agree or Disagree')
                                <input type="hidden" value="agree_or_disagree" name="vote_cat">
                                <div class="sell-extend-button">
                                    <div class="form-check check-button">
                                        <input type="checkbox" class="form-check-input" checked id="check50"
                                               name="vote_type"
                                               value="Agree"/>
                                        <label class="form-check-label" for="check50">{{ __('vote.Agree') }}</label>
                                    </div>
                                    <div class="form-check check-button m-0">
                                        <input type="checkbox" class="form-check-input" id="check51" name="vote_type"
                                               value="Disagree"/>
                                        <label class="form-check-label" for="check51">{{ __('vote.Disagree') }}</label>
                                    </div>
                                </div>
                            @else
                                <input type="hidden" value="accept_or_reject" name="vote_cat">
                                <div class="sell-extend-button">
                                    <div class="form-check check-button">
                                        <input type="checkbox" class="form-check-input" checked id="check50"
                                               name="vote_type"
                                               value="Accept"/>
                                        <label class="form-check-label" for="check50">{{ __('vote.Accept') }}</label>
                                    </div>
                                    <div class="form-check check-button m-0">
                                        <input type="checkbox" class="form-check-input" id="check51" name="vote_type"
                                               value="Reject"/>
                                        <label class="form-check-label" for="check51">{{ __('vote.Reject') }}</label>
                                    </div>
                                </div>
                            @endif
                            <div class="voting-terms">
                                <input type="checkbox" name="chk-box" id="chk-box">
                                <label for="">{{ __('vote.I have read and understood') }} <a href="#" class="vot-conditions">{{ __('vote.voting terms & conditions') }}</a></label>
                            </div>
                        </div>
                        <div class="vote-submit">
                            <button type="submit" class="vot-btn">{{ __('vote.SUBMIT') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.ok-modal-btn').click(function () {
            $('#exampleModal').modal('hide');
            $('#exampleModal1').modal('show');
        });

        $("#cast-vote").on("submit", function (event) {
            event.preventDefault();
            var formValues = $(this).serialize();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('investor.vote.investor') }}",
                method: 'post',
                data: formValues,
                success: function (result) {
                    if (result.status == true) {
                        $('#voteModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: result.error,
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                    } else {
                        $('#voteModal').modal('hide');
                        Swal.fire({
                            icon: 'warning',
                            title: 'Warning',
                            text: result.error,
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                    }
                }
            });
        });

        $('#cast-vote').validate({
            rules: {
                "extendorsell": "required",
                "chk-box": "required"
            },
            messages: {
                "extendorsell": '{{ __('auth.required') }}',
                "chk-box": '{{ __('auth.required') }}',
            }
        });
    </script>
@endsection
