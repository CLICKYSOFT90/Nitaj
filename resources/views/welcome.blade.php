@extends('layouts.home')

@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Home</title>
@endsection
@section('content')
    <!-- carousel slider -->
    <section class="invest-growth-home">
        <div class="container">
            <div class="carouselsetup">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row tkn-set">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="for_animation1" data-aos="fade-right" data-aos-duration="1000"
                                         data-aos-easing="linear">
                                        <div class="align-set">
                                            <h2 class="animate__animated animate__backInLeft"><span>{{ __('home.Invest') }}</span>, {{ __('home.EARN & GROW REAL ESTATE') }}
                                            </h2>
                                            <p>{{ __('home.Join the Saudis first regulated') }}
                                            </p>
                                        </div>
                                        <div class="signup-main">
                                            @auth
                                                <a href="{{ route('investor.home') }}" class="hov_btn">{{ __('nav.Dashboard') }}</a>
                                            @else
                                                <a href="{{ route('register') }}" class="hov_btn">{{ __('auth.signup') }}</a>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="for_animation2" data-aos="fade-left" data-aos-duration="1000"
                                         data-aos-easing="linear">
                                        <div class="side-pic">
                                            <img src="{{ asset('images/building.png') }}" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row tkn-set">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="for_animation1" data-aos="fade-right" data-aos-duration="1000"
                                         data-aos-easing="linear">
                                        <div class="align-set">
                                            <h2 class="animate__animated animate__backInLeft"><span>{{ __('home.Invest') }}</span>, {{ __('home.EARN & GROW REAL ESTATE') }}
                                            </h2>
                                            <p>{{ __('home.Join the Saudis first regulated') }}
                                            </p>
                                        </div>
                                        <div class="signup-main">
                                            @auth
                                                <a href="{{ route('investor.home') }}" class="hov_btn">{{ __('nav.Dashboard') }}</a>
                                            @else
                                                <a href="{{ route('register') }}" class="hov_btn">{{ __('auth.signup') }}</a>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="for_animation2" data-aos="fade-left" data-aos-duration="1000"
                                         data-aos-easing="linear">
                                        <div class="side-pic">
                                            <img src="{{ asset('images/building.png') }}" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row tkn-set">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="for_animation1" data-aos="fade-right" data-aos-duration="1000"
                                         data-aos-easing="linear">
                                        <div class="align-set">
                                            <h2 class="animate__animated animate__backInLeft"><span>{{ __('home.Invest') }}</span>, {{ __('home.EARN & GROW REAL ESTATE') }}
                                            </h2>
                                            <p>{{ __('home.Join the Saudis first regulated') }}
                                            </p>
                                        </div>
                                        <div class="signup-main">
                                            @auth
                                                <a href="{{ route('investor.home') }}" class="hov_btn">{{ __('nav.Dashboard') }}</a>
                                            @else
                                                <a href="{{ route('register') }}" class="hov_btn">{{ __('auth.signup') }}</a>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="for_animation2" data-aos="fade-left" data-aos-duration="1000"
                                         data-aos-easing="linear">
                                        <div class="side-pic">
                                            <img src="{{ asset('images/building.png') }}" alt="" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <!-- for testing -->
    <section class="laptop-sec" data-aos="fade-right" data-aos-duration="1000">
        <div class="container">
            <div class="row rk_sec">
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="for_animation">
                        <div class="hed_text">
                            <h2 class="animate__animated animate__rubberBand">{{ __('home.WHAT WE DO') }}</h2>
                            <p>{{ __('home.what we do para') }}</p>
                        </div>
                        <div class="learn-more">
                            <a href="#" class="btn4">{{ __('home.LEARN MORE') }}</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-12 ">
                    <!-- <div class="stp_ltp">
                        <img src="./images/laptopset.png" alt="">
                    </div> -->

                </div>
            </div>
        </div>
    </section>

    <section class="crd_sec">
        <div class="container ">
            <div class="row ">
                <div class="col-md-3 col-sm-3 col-12">

                    <div class="main" data-aos="fade-up" data-aos-duration="1000">
                        <div class="center-pic ">
                            <img src="{{ asset('images/resize.png') }}" alt=" " class="img-fluid ">
                        </div>
                        <div class="hed_txt ">
                            <h4>{{ __('home.Institutional Quality') }}</h4>
                            <p>{{ __('home.Institutional para') }}</p>
                        </div>

                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-12 ">
                    <div class="main" data-aos="fade-up" data-aos-duration="1000">
                        <div class="center-pic ">
                            <img src="{{ asset('images/shield.png') }}" alt=" " class="img-fluid">
                        </div>
                        <div class="hed_txt ">
                            <h4>{{ __('home.Low Minimums') }}</h4>
                            <p>{{ __('home.Low para') }}</p>
                        </div>

                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-12 ">
                    <div class="main" data-aos="fade-down" data-aos-duration="1000">
                        <div class="center-pic ">
                            <img src="{{ asset('images/scissor.png') }}" alt="#" class="img-fluid">
                        </div>
                        <div class="hed_txt ">
                            <h4>{{ __('home.No hidden Fees, ever.') }}</h4>
                            <p>{{ __('home.No hidden Fees para') }}</p>
                        </div>

                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-12 ">
                    <div class="main" data-aos="fade-down" data-aos-duration="1000">
                        <div class="center-pic ">
                            <img src="{{ asset('images/dollar.png') }}" alt=" " class="img-fluid ">
                        </div>
                        <div class="hed_txt ">
                            <h4>{{ __('home.Convenient Exits') }}</h4>
                            <p>{{ __('home.Convenient para') }}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="access_sec">
        <div class="container">
            <div class="row dfx_alc">
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="access_hedr" data-aos="fade-right" data-aos-duration="1000">
                        <h2>{{ __('home.ACCESS') }}</h2>
                        <p>{{ __('home.ACCESS para') }} </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="access_right" data-aos="fade-left" data-aos-duration="1000">
                        <img src="{{ asset('images/access.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="invest_sec">
        <div class="container">
            <div class="row dfx_alc">
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="house_left" data-aos="fade-right" data-aos-duration="1000">
                        <img src="{{ asset('images/house.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="invest_content" data-aos="fade-left" data-aos-duration="1000">
                        <h2>{{ __('home.Invest') }}</h2>
                        <p>{{ __('home.INVEST para') }} </p>
                    </div>
                </div>

            </div>
        </div>
    </section>



    <section class="diversify_sec">
        <div class="container">
            <div class="row dfx_alc">
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="diversify_content" data-aos="fade-right" data-aos-duration="1000">
                        <h2>{{ __('home.DIVERSIFY') }}</h2>
                        <p>{{ __('home.DIVERSIFY para') }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="diversify_right" data-aos="fade-left" data-aos-duration="1000">
                        <img src="{{ asset('images/diversify.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="track_sec">
        <div class="container">
            <div class="row dfx_alc">

                <div class="col-md-6 col-sm-6 col-12">
                    <div class="track_left" data-aos="fade-right" data-aos-duration="1000">
                        <img src="{{ asset('images/track.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-12">
                    <div class="track_content" data-aos="fade-left" data-aos-duration="1000">
                        <h2>{{ __('home.TRACK') }}</h2>
                        <p>{{ __('home.TRACK para') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="card2_sec">

        <div class="container ">

            <div class="row">
                <div class="col-md-12 col-sm-12 col-12">
                    <div class="money_work">
                        <div class="carousel for_carousel_bg" data-aos="fade-left" data-aos-duration="1000">
                            <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators2" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="row dfx_alc">
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="money_content">
                                                    <h2>{{ __('home.LET YOUR') }} <span>{{ __('home.MONEY') }}</span>
                                                        {{ __('home.WORK FOR YOU') }}</h2>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="money_right">
                                                    <img src="{{ asset('images/carousel-column.png') }}" alt="" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="row dfx_alc">
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="money_content">
                                                    <h2>{{ __('home.LET YOUR') }} <span>{{ __('home.MONEY') }}</span>
                                                        {{ __('home.WORK FOR YOU') }}</h2>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="money_right">
                                                    <img src="{{ asset('images/carousel-column.png') }}" alt="" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <div class="row dfx_alc">
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="money_content">
                                                    <h2>{{ __('home.LET YOUR') }} <span>{{ __('home.MONEY') }}</span>
                                                        {{ __('home.WORK FOR YOU') }}</h2>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="money_right">
                                                    <img src="{{ asset('images/carousel-column.png') }}" alt="" class="img-fluid">
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
            <div class="row">
                <div class="col-md-12 col-sm-12 col-12 ">
                    <div class="hed_4 text-center ">
                        <h2>{{ __('home.VIEW OUR INVESTMENT PROPERTIES') }}</h2>
                        <p>{{ __('home.Helping Investors Build Wealth, Brick By Brick') }}</p>
                    </div>
                </div>
                @foreach($projects as $project)
                <div class="col-md-4 col-sm-4 col-12 ">
                    <div class="re_card" data-aos="fade-up" data-aos-duration="1000">
                        <div class="forcd_pic ">
                            @php $image_name = count($project->projects->projectImages) > 0 ? $project->projects->projectImages[0]->filename : 'dummy.png'; @endphp
                            <img src="{{asset('project-visual-uploads'.'/'. $image_name)}}" alt=" " class="img-fluid ">
                            <div class="live_bar ">
                                <h6>{{ date('Y-m-d', strtotime($project->starting_period)) < date('Y-m-d') ? __('home.LIVE') : __('home.COMING SOON') }}</h6>
                            </div>
                        </div>
                        <div class="ft_hr akc_1">

                            <div class="cmplx_hd ">
                                <h4>{{ App::getLocale() == 'en' ? $project->projects->project_name_en : $project->projects->project_name_ar }}</h4>
                                <span>{{ $project->projects->projectCities->name }}, {{ $project->projects->projectCountry->name }}</span>
                            </div>
                            <div class="listing_pre">
                                <div class="row ">
                                    <div class="col-md-6 col-sm-6 col-12 ">
                                        <div class="listing">
                                            <ul>
                                                <h4>{{ __('home.Invesment Target') }}</h4>
                                                <li class="for_font ">0<sup>SAR</sup></li>
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
                                                <li>{{ $project->projects->projectFunding->project_roi }}%</li>
                                                <h4>{{ __('home.Dividend yield') }}</h4>
                                                <li class="for_font ">0%</li>
                                                <h4>{{ __('home.Hold Period') }}</h4>
                                                <li>{{ $project->projects->projectFunding->investment_period }}</li>
                                            </ul>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <!-- <span class="pull-right ">33%Funded</span> -->
                            @php $percent = checkRemainingFunding($project->projects->id) @endphp
                            <div class="progress position-relative">
                                <div class="progress-bar " role="progressbar " style="width: {{ $percent }}% "
                                     aria-valuenow="25 " aria-valuemin="0 " aria-valuemax="100 ">{{ $percent }}% {{ __('home.FUNDED') }}</div>

                            </div>
                            <div class="row dfx_alc ">
                                @foreach($project->projects->projectSponsors as $sponsors)
                                    <div class="col-md-4 col-sm-12 col-4 ">
                                        <div class="icons-set for_af">
                                            <img src="{{ asset('project-sponsors').'/'.@$sponsors->filename }}" alt=" " class="img-fluid ">
                                            <p class="cev_1">{{ @$sponsors->company_name }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="crd_bn text-center mt-5 ">
                                <a href="{{ route('investor.projects.detail', $project->projects->id) }}" class="btn5 ">{{ __('home.VIEW INVESTMENT') }}</a>

                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </section>
    <section class="fthr_gamb" data-aos="zoom-in-right" data-aos-duration="1000">
        <div class="container ">
            <div class="col-md-12 col-sm-12 col-12 ">
                <div class="hd_f8 text-center ">
                    <h2>{{ __('home.OUR PROUD PARTNERS') }}</h2>
                    <p class="for_grclr ">{{ __('home.Helping Investors Build Wealth, Brick By Brick') }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-12">
                    <div class="slider responsive1 sk_q">
                        <div>
                            <div class="ftr_forsld2 ">
                                <div class="icon-pic ">
                                    <img src="{{ asset('images/icon-pic1.png') }}" alt=" " class="img-fluid ">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="ftr_forsld2 ">
                                <div class="icon-pic ">
                                    <img src="{{ asset('images/icon-pic2.png') }}" alt=" " class="img-fluid ">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="ftr_forsld2 ">
                                <div class="icon-pic ">
                                    <img src="{{ asset('images/icon-pic3.png') }}" alt=" " class="img-fluid ">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="ftr_forsld2 ">
                                <div class="icon-pic ">
                                    <img src="{{ asset('images/icon3.png') }}" alt=" " class="img-fluid ">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="ftr_forsld2 ">
                                <div class="icon-pic ">
                                    <img src="{{ asset('images/icon-pic5.png') }}" alt=" " class="img-fluid ">
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="ftr_forsld2 ">
                                <div class="icon-pic ">
                                    <img src="{{ asset('images/icon-pic3.png') }}" alt=" " class="img-fluid ">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $('.responsive').slick({
            dots: false,
            infinite: true,
            autoplay: true,
            speed: 800,
            slidesToShow: 3,
            slidesToScroll: 1,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false,
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
            }, {
                breakpoint: 700,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick "
                // instead of a settings object
            ]
        });
    </script>
    <script>
        $('.responsive1').slick({
            dots: false,
            infinite: true,
            autoplay: true,
            speed: 800,
            slidesToShow: 5,
            arrows: false,
            slidesToScroll: 1,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false,
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
            }, {
                breakpoint: 700,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick "
                // instead of a settings object
            ]
        });
    </script>


    <script>
        $('.carousel').carousel({
            interval: false,
        });
    </script>

    <script>
        AOS.init();
    </script>
@endsection()
