<!--begin::Header-->
<div id="kt_header" class="header header-fixed">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::Header Menu Wrapper-->
        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
            <!--begin::Header Menu-->

            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                <!--begin::Header Nav-->
                <ul class="menu-nav">
                    <li class="menu-item menu-item-open menu-item-here menu-item-submenu menu-item-rel menu-item-open menu-item-here menu-item-active"
                        data-menu-toggle="click" aria-haspopup="true">
                        <h1 class="mr_ahm">{{ __('dashboard.Welcome') }} {{ __('dashboard.Mr') }}
                            . {{ Auth::user()->fname }} <span class="ppng_lne"></span>
                            @if(auth()->user()->is_admin == 0)
                                <span class="ut_p"><a href="{{ route('investor.upgrade') }}">{{ __('dashboard.UPGRADE TO PRO') }}</a></span>
                            @endif
                            @php $steps = getUserRegistrationSteps(auth()->user()->id); @endphp
                            @if(count($steps) < 3)
                                @foreach($steps as $step)
                                    @if($step->step == 'id-verification')
                                        <span class="ut_p ml-3">
                                            <a href="{{ route('general-info') }}">{{ __('dashboard.Complete Profile') }} </a>
                                        </span>
                                    @elseif($step->step = 'general-info')
                                        <span class="ut_p ml-3">
                                            <a href="{{ route('financial-status') }}">{{ __('dashboard.Complete Profile') }} </a>
                                        </span>
                                    @endif
                                @endforeach
                            @endif
                        </h1>
                    </li>
                </ul>
                <!--end::Header Nav-->
            </div>
            <!--end::Header Menu-->
        </div>
        <!--end::Header Menu Wrapper-->
        <!--begin::Topbar-->
        <div class="topbar">
            <!--begin::Cart-->
            <div class="topbar-item">
{{--                <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1" id="kt_quick_cart_toggle">--}}
{{--                                    <span class="svg-icon svg-icon-xl svg-icon-primary">--}}
{{--                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Cart3.svg-->--}}
{{--                                        <a href="#"><img src="{{ asset('images/investor/support-icon.png') }}" alt=""--}}
{{--                                                         class="img-fluid"></a>--}}
{{--                                        <!--end::Svg Icon-->--}}
{{--                                    </span>--}}
{{--                </div>--}}
            </div>
        {{--            <div class="topbar-item">--}}
        {{--                <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1" id="kt_quick_cart_toggle">--}}
        {{--                                    <span class="svg-icon svg-icon-xl svg-icon-primary">--}}
        {{--                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Cart3.svg-->--}}
        {{--                                        <a href="#"><img src="{{ asset('images/investor/chat-icon.png') }}" alt="" class="img-fluid"></a>--}}
        {{--                                        <!--end::Svg Icon-->--}}
        {{--                                    </span>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        <!--end::Cart-->
            <div class="topbar-item for-notify-af ">
                <div class="btn btn-icon btn-clean btn-lg mr-1" id="kt_quick_panel_toggle">
                    <!-- <span class="svg-icon svg-icon-xl svg-icon-primary"> -->
                    <!-- <a href="#"><img src="./images/notifications.png" alt="" class="img-fluid"></a> -->
                    <div class="dropdown">
                        <!--begin::Toggle-->
                        <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                            <div
                                class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1 pulse pulse-primary">
                        <span class="svg-icon svg-icon-xl">
                          <!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/Code/Compiling.svg-->
                         <img src="{{ asset('images/investor/notifications.png') }}" alt="">
                            <!--end::Svg Icon-->
                        </span>

                            </div>
                        </div>
                        <!--end::Toggle-->
                        <!--begin::Dropdown-->
                        <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                            <form>
                                <!--begin::Header-->
                                <div class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top"
                                     style="background-image: linear-gradient(to bottom, #3ea99d, #2daf97, #22b48f, #23b983, #30bd74);">
                                    <!--begin::Title-->
                                    <h4 class="d-flex flex-center rounded-top">
                                        <span class="text-white">Notifications</span>
                                    </h4>
                                    <!--end::Title-->
                                    <!--begin::Tabs-->
                                    <ul
                                        class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-transparent-white nav-tabs-line-active-border-success mt-3 px-8"
                                        role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active show" data-toggle="tab"
                                               href="#topbar_notifications_events"></a>
                                        </li>
                                    </ul>
                                    <!--end::Tabs-->
                                </div>
                                <!--end::Header-->
                                <!--begin::Content-->
                                <div class="tab-content">
                                    <!--begin::Tabpane-->
                                    <div class="tab-pane active show p-8" id="topbar_notifications_events"
                                         role="tabpanel">
                                        <!--begin::Nav-->
                                        <div class="navi navi-hover scroll my-4 notification-list" data-scroll="true"
                                             data-height="300" data-mobile-height="200">
                                        </div>
                                        <!--end::Nav-->
                                    </div>
                                    <!--end::Tabpane-->
                                </div>
                                <!--end::Content-->
                            </form>
                        </div>
                        <!--end::Dropdown-->
                    </div>
                    <!--end::Notifications-->

                    <!-- </span> -->
                </div>
            </div>
            <!--begin::Languages-->
            <div class="dropdown">
                <!--begin::Toggle-->
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="dropdown">
                        <button class=" cstm_oper dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->fname }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">{{ __('auth.logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                        <a href="#" class="for_avtr"><img src="{{ asset('images/investor/avatar.png') }}" alt=""
                                                          class="img-fluid" width="45px"></a>
                    </div>
                    <!-- <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                        <img class="h-20px w-20px rounded-sm" src="assets/media/svg/flags/226-united-states.svg" alt="" />
                    </div> -->
                </div>

            </div>
            <!--end::Languages-->
            <!--begin::User-->
            <div class="topbar-item">

            </div>
            <!--end::User-->
        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>
<!--end::Header-->
