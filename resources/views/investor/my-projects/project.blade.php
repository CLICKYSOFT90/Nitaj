@extends('layouts.investor.investor')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Projects</title>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection

@section('content')
    <!--begin::Content-->

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="">
            <div class="container-fluid">
                <div class="dsb_view p-0">
                    <div class="row ff_s">
                        <div class="col-md-4 col-sm-4 col-12">
                            <div class="pro_cons hg_kio">
                                <h4>{{ __('projects.Projects') }}</h4>
                            </div>
                            <div class="for_fil_sort">
                                <select name="" id="">
                                    <option value="">{{ __('projects.Filters') }}</option>
                                    <option value="2">{{ __('projects.sorts') }}</option>
                                    <option value="3">{{ __('projects.Owned') }}</option>
                                </select>
                                <select name="" id="">
                                    <option value="">{{ __('projects.Sort by') }}</option>
                                    <option value="2">{{ __('projects.Assets') }}</option>
                                    <option value="3">{{ __('projects.Owned') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-12">
                            <div class="for_tabs_1">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tabs-1"
                                           role="tab">{{ __('projects.Live Project') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">
                                            {{ __('projects.Funded') }}
                                        </a>
                                    </li>

                                </ul><!-- Tab panes -->
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-12">
                            <div class="form-89 hg_rbt">
                                <form action="{{ route('investor.projects') }}">
                                    <input type="search" placeholder="{{ __('projects.Type in to Search') }}..."
                                           name="search" value="{{ @$_GET['search'] }}">

                                    <div class="search-icon">
                                        <i class="fa fa-search"></i>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card_sc3">
            <div class="container-fluid">
                <div class="tab-content">
                    <div class="tab-pane active" id="tabs-1" role="tabpanel">
                        <div class="row">
                            @if(count($projects) > 0)
                                @foreach($projects as $key => $project)
                                    @php
                                        $is_exists = \App\Models\InvestorInvestments::select('*')
                                        ->addSelect(DB::raw("sum(investor_investments.no_of_shares - investor_investments.sold_shares) as total_shares,
                                                sum(investor_investments.no_of_shares - investor_investments.sold_shares) * project_fundings.price_per_share as total_amount"))
                                        ->join('project_fundings', 'project_fundings.project_id', '=', 'investor_investments.project_id')
                                        ->with('projects')
                                        ->where('investor_investments.project_id', $project->project_id)
                                        ->first();
                                    @endphp
                                    @if($project->projects->projectFunding->funding_required > $is_exists->total_amount)
                                        <div class="col-md-4 col-sm-4 col-12 mb-60">
                                            <div class="re_card" data-aos="fade-up" data-aos-duration="3000">
                                                <div class="forcd_pic ">
                                                    @php $image_name = count($project->projects->projectImages) > 0 ? $project->projects->projectImages[0]->filename : 'dummy.png'; @endphp
                                                    <img src="{{asset('project-visual-uploads'.'/'. $image_name)}}"
                                                         alt=" "
                                                         class="d-flex mx-auto pt-37">
                                                    <div class="live_bar ">
                                                        <h6>{{ date('Y-m-d', strtotime($project->projects->fundingCampaigns->starting_period)) <= date('Y-m-d') ? __('home.LIVE') : __('home.COMING SOON') }}</h6>
                                                    </div>
                                                </div>
                                                <div class="ft_hr akc_1">
                                                    <div class="cmplx_hd ">
                                                        <h4>{{ App::getLocale() == 'en' ? $project->projects->project_name_en : $project->projects->project_name_ar }}</h4>
                                                        <span>{{ $project->projects->projectCities->name }}, {{ $project->projects->projectCountry->name }}</span>
                                                    </div>
                                                    <div class="listing_pre">
                                                        <div class="row ">
                                                            <div class="col-md-6 col-sm-6 col-12">
                                                                <div class="listing">
                                                                    <ul>
                                                                        <h4>{{ __('home.Invesment Target') }}</h4>
                                                                        <li class="for_font ">{{ number_format($project->projects->projectFunding->funding_required) }}
                                                                            <sup>SAR</sup>
                                                                        </li>
                                                                        <h4>{{ __('home.Structure') }}</h4>
                                                                        <li class="for_font ">{{ __('home.'.$project->projects->projectFunding->structure) }}</li>
                                                                        <h4>{{ __('home.Type') }}</h4>
                                                                        <li>{{ App::getLocale() == 'en' ? $project->projects->project_type_en : $project->projects->project_type_ar }}</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-12 ">
                                                                <div class="listing">
                                                                    <ul>
                                                                        <h4>{{ __('home.Expected ROI') }}</h4>
                                                                        <li>{{ $project->projects->projectFunding->project_roi }}
                                                                            %
                                                                        </li>
                                                                        <h4>{{ __('home.Dividend yield') }}</h4>
                                                                        <li class="for_font ">{{ $project->projects->projectFunding->dividend_yield }}%</li>
                                                                        <h4>{{ __('home.Hold Period') }}</h4>
                                                                        <li>{{ $project->projects->projectFunding->investment_period }}</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <span class="pull-right ">33%Funded</span> -->
                                                    @php $percent = checkRemainingFunding($project->project_id) @endphp
                                                    <div class="progress position-relative">
                                                        <div class="progress-bar " role="progressbar "
                                                             style="width: {{ $percent }}% " aria-valuenow=""
                                                             aria-valuemin="0 "
                                                             aria-valuemax="100 "></div>
                                                        <div class="funded-txt"
                                                             style="{{ $percent > 53 ? 'color: #ffffff' : '' }}">
                                                            <span>{{ $percent }}% {{ __('projects.funded') }} </span>
                                                        </div>
                                                    </div>
                                                    <div class="row dfx_alc ">
                                                        @foreach($project->projects->projectSponsors as $sponsors)
                                                            <div class="col-md-4 col-sm-12 col-4 ">
                                                                <div class="icons-set for_af">
                                                                    <img
                                                                        src="{{ asset('project-sponsors').'/'.@$sponsors->filename }}"
                                                                        alt=" " class="img-fluid ">
                                                                    <p class="cev_1">{{ @$sponsors->company_name }}</p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="crd_bn text-center mt-5 ">
                                                        <a href="{{ route('investor.projects.detail', $project->projects->id) }}"
                                                           class="btn5 ">{{ __('home.VIEW INVESTMENT') }}</a>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="col-md-4 col-sm-4 col-12 mb-60">
                                    {{ __('home.NO Project Found') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    {{--                    <h6>{{ __('home.FUNDED') }}</h6>--}}
                    <div class="tab-pane" id="tabs-2" role="tabpanel">
                        <div class="row">
                            @if(count($funded_projects) > 0)
                                @foreach($funded_projects as $investor_project)
                                    @if($investor_project->projects->projectFunding->no_of_shares == $investor_project->total_shares)
                                        <div class="col-md-4 col-sm-4 col-12 mb-60">
                                            <div class="re_card" data-aos="fade-up" data-aos-duration="3000">
                                                <div class="forcd_pic ">
                                                    <img
                                                        src="{{asset('project-visual-uploads'.'/'. $investor_project->projects->projectImages[0]->filename)}}"
                                                        alt=" " class="img-fluid d-flex mx-auto pt-37">
                                                    <div class="live_bar ">
                                                        {{--                                                    <h6>{{ date('Y-m-d', strtotime($investor_project->projects->fundingCampaigns->starting_period)) < date('Y-m-d') ? __('home.LIVE') : __('home.COMING SOON') }}</h6>--}}
                                                        <h6>{{ __('home.FUNDED') }}</h6>
                                                    </div>
                                                </div>
                                                <div class="ft_hr akc_1">
                                                    <div class="cmplx_hd ">
                                                        <h4>{{ App::getLocale() == 'en' ? $investor_project->projects->project_name_en : $investor_project->projects->project_name_ar }}</h4>
                                                        <span>{{ $investor_project->projects->projectCities->name }}, {{ $investor_project->projects->projectCountry->name }}</span>
                                                    </div>
                                                    <div class="listing_pre">
                                                        <div class="row ">
                                                            <div class="col-md-6 col-sm-6 col-12 ">
                                                                <div class="listing">
                                                                    <ul>
                                                                        <h4>{{ __('home.Invesment Target') }}</h4>
                                                                        <li class="for_font ">{{ number_format($investor_project->projects->projectFunding->funding_required) }}
                                                                            <sup>SAR</sup>
                                                                        </li>
                                                                        <h4>{{ __('home.Structure') }}</h4>
                                                                        <li class="for_font ">{{ __('home.'.$investor_project->projects->projectFunding->structure) }}</li>
                                                                        <h4>{{ __('home.Type') }}</h4>
                                                                        <li>{{ App::getLocale() == 'en' ? $investor_project->projects->project_type_en : $investor_project->projects->project_type_ar }}</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 col-12 ">
                                                                <div class="listing">
                                                                    <ul>
                                                                        <h4>{{ __('home.Expected ROI') }}</h4>
                                                                        <li>{{ $investor_project->projects->projectFunding->project_roi }}</li>
                                                                        <h4>{{ __('home.Dividend yield') }}</h4>
                                                                        <li class="for_font ">{{ $project->projects->projectFunding->dividend_yield }}%</li>
                                                                        <h4>{{ __('home.Hold Period') }}</h4>
                                                                        <li>{{ $investor_project->projects->projectFunding->investment_period }}</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <span class="pull-right ">33%Funded</span> -->
                                                    @php $percent = checkRemainingFunding($investor_project->projects->id) @endphp
                                                    <div class="progress ">
                                                        <div class="progress-bar " role="progressbar "
                                                             style="width: {{ $percent }}% " aria-valuenow=""
                                                             aria-valuemin="0 "
                                                             aria-valuemax="100 ">{{ $percent }}
                                                            % {{ __('home.FUNDED') }}</div>

                                                    </div>
                                                    <div class="crd_bn text-center mt-5 ">
                                                        <a href="{{ route('investor.projects.detail', $investor_project->projects->id) }}"
                                                           class="btn5 ">{{ __('home.VIEW INVESTMENT') }}</a>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="col-md-4 col-sm-4 col-12 mb-60">
                                    No Projects Found
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Content-->
@endsection
