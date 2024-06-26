@extends('layouts.investor.investor')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Project Detail</title>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('investor/assets/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('investor/assets/css/all.css') }}">
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <section class="invest_growth for-dashboard-equity">
            <div class="container">
                <div class="equity-spacious-main">
                    <div class="row tkn-set">
                        <div class="col-md-6 col-sm-6 col-12 ">
                            <!-- <div class="for_playpic" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500"> -->
                            <div class="for-playbutton ">
                                <img
                                    src="{{ asset('project-visual-uploads').'/'.$project->projectImages[0]->filename }}"
                                    alt=" " class="w-100 d-flex mx-auto">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-12 ">
                            <div class="equity_development ">
                                <h3>{{ ucwords(__('home.'.$project->projectFunding->structure) )}}
                                    , {{ App::getLocale() == 'en' ? ucwords($project->project_type_en) : ucwords($project->project_type_ar) }}
                                    <span class="after-line">|</span> <span
                                        class="equity-live">{{ date('Y-m-d', strtotime($funding_campaign->starting_period)) <= date('Y-m-d') ? __('home.LIVE') : __('home.COMING SOON') }}</span>
                                </h3>
                            </div>
                            <div class="spacous_town ">
                                <div class="spacious-town-heds ">
                                    <h2>{{ App::getLocale() == 'en' ? $project->project_name_en : $project->project_name_ar }}</h2>
                                    <span
                                        class="jed_sa ">{{ $project->projectCities->name }}, {{ $project->projectCountry->name }}</span>
                                </div>
                                <div class="row st-h ">
                                    <div class="col-md-6 col-sm-4 col-6 ">
                                        <div class="it_target_list ">
                                            <h4>{{ __('projects.Investment Target') }}</h4>
                                            <p>{{ $project->projectFunding->funding_required }} </p>
                                        </div>
                                        <div class="it_target_list ">
                                            <h4>{{ __('projects.Projected ROI') }}</h4>
                                            <p>{{ $project->projectFunding->project_roi }}%</p>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4 col-sm-4 col-12 "></div> -->
                                    <div class="col-md-6 col-sm-4 col-6 ">
                                        <div class="it_target_list ">
                                            <h4>{{ __('projects.Price per Share') }}</h4>
                                            <p>{{ $project->projectFunding->price_per_share }}</p>
                                            <h4>{{ __('projects.Minimum Investment') }}</h4>
                                            <p>{{ $project->projectFunding->min_investment }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="spacious_bn text-center ">
                                    <a href="{{ route('investor.project.invest',$project->id) }}"
                                       class="btn-009 ">{{ __('projects.INVEST') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="funding-progress">
                    <div class="row ">
                        <div class="col-md-12 col-sm-12 col-12 ">
                            <div class="for_pgrs ">
                                @php
                                    $starting_period = $funding_campaign->starting_period;
                                    $ending_period = $funding_campaign->ending_period;
                                    $datetime1 = new \DateTime();
                                    $datetime2 = new \DateTime($ending_period);
                                    $interval = $datetime1->diff($datetime2);
                                    $days = $interval->format('%a');
                                @endphp
                                <div class="progress r_mv1 ">
                                    <div class="progress-bar " role="progressbar " style="width: {{ $percent }}% "
                                         aria-valuenow="{{ $percent }}"
                                         aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                    <div class="funded-txt" style="{{ $percent > 53 ? 'color: #ffffff' : '' }}">
                                        <span>{{ $percent }}% {{ __('projects.funded') }} </span>
                                    </div>
                                    <div class="for-days">
                                        <span>{{ $days }} {{ __('projects.Days Remaining') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="project_over_sec ">
            <div class="container ">
                <div class="row ">
                    <div class="col-md-6 col-sm-6 col-12 ">
                        <div class="po_sh1 ">
                            <div class="property-overview">
                                <h2>{{ __('projects.Project Overview') }}</h2>
                                <h3>{{ __('projects.About the Property') }}</h3>
                            </div>
                            <p>
                                {{ App::getLocale() == 'en' ? $project->project_intro_en : $project->project_intro_ar }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12 ">
                        <div class="sldr_rsp" data-aos="fade-up" data-aos-duration="3000">
                            <div class="slider responsive">
                                @foreach($project->projectImages as $projectImage)
                                    <div>
                                        <a href="{{ asset('project-visual-uploads'.'/'.$projectImage->filename) }}"
                                           data-fancybox="gallery"><img
                                                src="{{ asset('project-visual-uploads'.'/'.$projectImage->filename) }}"
                                                alt="" class="img-fluid"></a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="invt-infokio">
            <div class="container ">
                <div class="inv_kyo ">
                    <h2>{{ __('projects.Invesment info') }}</h2>
                </div>
                <div class="row for_mgn ">
                    <div class="col-md-4 col-sm-12 col-12 ">
                        <div class="multi_clss ">
                            <h6>{{ __('projects.Projected ROI') }} <span class="power_1 ">{{ $project->projectFunding->project_roi }} %</span>
                            </h6>

                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-12 ">
                        <div class="multi_clss ">
                            <h6>{{ __('projects.Hold Period') }} <span class="power_1 ">{{ $project->projectFunding->investment_period }} <sup>Years</sup></span>
                            </h6>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-12 ">
                        <div class="multi_clss ">
                            <h6>{{ __('projects.Dividend Frequency') }} <span
                                    class="power_1 ">{{ !empty($project->projectFunding->dividend_frequency) ? ucfirst($project->projectFunding->dividend_frequency) : '-' }} </span>
                            </h6>

                        </div>
                    </div>

                </div>
                <div class="row for_mgn ">
                    <div class="col-md-4 col-sm-12 col-12 ">
                        <div class="multi_clss ">
                            <h6>{{ __('projects.No.of Investors') }} <span
                                    class="power_1 ">{{ $no_of_investors }}</span></h6>

                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-12 ">
                        <div class="multi_clss ">
                            <h6>{{ __('projects.Projected Dividend Yield') }} <span class="power_1 ">{{ $project->projectFunding->dividend_yield }} %</span>
                            </h6>

                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-12 ">
                        <div class="multi_clss ">
                            <h6>{{ __('projects.Price per Share') }} <span class="power_1 ">{{ $project->projectFunding->price_per_share }} <sup>SAR</sup></span>
                            </h6>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="map_section " data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
            <div class="container ">
                <div class="row ">
                    <div class="col-md-12 col-sm-12 col-12 ">
                        <div class="loc_hed ">
                            <h2>{{ __('projects.Location') }}</h2>
                        </div>
                        <iframe width="100%" height="245px" frameborder="0"
                                style="border:0;margin-top: 10px;"
                                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBOfpaMO_tMMsuvS2T4zx4llbtsFqMuT9Y&q=' + {{ $project->project_location }}"></iframe>

                    </div>
                </div>
            </div>

        </section>
        <section class="stake_holders " data-aos="fade-down" data-aos-easing="linear" data-aos-duration="1500">
            <div class="container ">
                <div class="for_stake ">
                    <h2>{{ __('projects.STAKE HOLDERS') }}</h2>
                </div>
                <div class="row ">
                    @foreach($project->projectSponsors as $sponsor)
                        <div class="col-md-12 col-sm-12 col-12 ">
                            <div class="aa_rate1 fio_rio for_mobile-sc ">
                                <div class=" ff_io d-flex ">
                                    <div class="lg_ok3 ">
                                        <img src="{{ asset('project-sponsors'.'/'.$sponsor->filename) }}" alt=" "
                                             class="img-fluid" width="150px">
                                    </div>
                                    <div class="for_side_para ">
                                        <h3>{{ $sponsor->company_name }}</h3>
                                        <p>{{ $sponsor->desc }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="investment_documents for_dash_investment">
            <div class="container">
                <div class="main_hid for_dsb_hid text-center ">
                    <h2>{{ __('projects.Investment Documents') }}</h2>
                </div>
                <div class="row for_brdr ">
                    @foreach($project->projectDocuments as $doc)
                        <div class="col-md-4 col-sm-12 col-12 ">
                            <div class="down_prop ">
                                <div class="dow_analytics for_dsb_dow ">
                                    <h6>{{ __('projects.DOWNLOAD') }}
                                        <span class="dow_icon">
                                        <a href="{{ asset('project-doc'.'/'.$doc->doc_name) }}" download>
                                            <img src="{{ asset('images/download.png') }}" alt="">
                                        </a>
                                    </span>
                                    </h6>
                                    <p>{{ $doc->doc_name }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <section class="copyright_sec1">
            <div class="container">
                <div class="row ">
                    <div class="col-md-12 col-sm-12 col-12 ">
                        <div class="footer_endline text-center ">
                            <p>© {{ date('Y') }} Nitaj Crowd Real Estate Crowdfunding LLC. | All Rights Reserved </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--end::Content-->
        <!--begin::Footer-->

        <!--end::Footer-->
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('investor/assets/js/slick.js') }}"></script>
    <script>
        $('.responsive').slick({
            dots: true,
            infinite: true,
            arrows: false,
            // autoplay: true,
            speed: 800,
            slidesToShow: 1,
            slidesToScroll: 1,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            }, {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }, {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }]
        });
    </script>
@endsection
