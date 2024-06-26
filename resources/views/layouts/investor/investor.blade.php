<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
    <base href="">
    <meta charset="utf-8" />
    <!-- <title>Metronic Live preview | Keenthemes</title> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <!-- <link rel="canonical" href="https://keenthemes.com/metronic" /> -->
    <!-- CSRF Token -->
    <meta name="_token" content="{{csrf_token()}}" />
    @yield('title')
    <!--begin::Fonts-->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!--end::Fonts-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ asset('investor/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!--begin::Layout Themes(used by all pages)-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{asset('investor/assets/css/themes/layout/header/base/light.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('investor/assets/css/themes/layout/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('investor/assets/css/themes/layout/brand/dark.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('investor/assets/css/themes/layout/aside/dark.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('investor/assets/css/rej.css') }}">
    <link rel="stylesheet" href="{{ asset('investor/assets/css/plugin.bundle.css') }}">
    @yield('styles')
    <!--end::Layout Themes-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="{{ App::getLocale() == "ar" ? 'ar-font' : 'en-font'}} header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading" >

<!--begin::Header Mobile-->
<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
    <!--begin::Logo-->
    <a href="{{ url('/') }}">
        <img alt="Logo" src="{{asset('images/nav-white-logo.png')}}" width="37px" />
    </a>
    <!--end::Logo-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
        <!--begin::Aside Mobile Toggle-->
        <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
            <span></span>
        </button>
        <!--end::Aside Mobile Toggle-->
        <!--begin::Header Menu Mobile Toggle-->
        <!-- <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
            <span></span>
        </button> -->
        <!--end::Header Menu Mobile Toggle-->
        <!--begin::Topbar Mobile Toggle-->

        <!--end::Topbar Mobile Toggle-->
    </div>
    <!--end::Toolbar-->
</div>
<!--end::Header Mobile-->

<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
        @include('layouts.investor.includes.aside')
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            @include('layouts.investor.includes.header')
            @yield('content')
        </div>
    </div>
</div>
<!-- preloader area start -->
<div class="preloader" id="preloader">
</div>
<!-- preloader area end -->

    <!--end::Demo Panel-->
    <script>
        var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>
    <script src="{{asset('investor/assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{asset('investor/assets/js/scripts.bundle.js')}}"></script>
    <!-- <script src="https://cdn2.hubspot.net/hubfs/476360/Chart.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.0/chart.min.js "></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>--}}


@if (session('success'))
    <script type="text/javascript">

        {{--Swal.fire(--}}
        {{--    'Success',--}}
        {{--    '{!! session('success') !!}',--}}
        {{--    'success'--}}
        {{--)--}}
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{!! session('success') !!}',
            timer: 2000,
            showCancelButton: false,
            showConfirmButton: false
        })
    </script>
@endif
@if (session('alert'))
    <script type="text/javascript">
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: '{!! session('alert') !!}',
            timer: 5000,
            showCancelButton: false,
            showConfirmButton: false
        })
    </script>
@endif

    <!--begin::Global Config(global config for global JS scripts)-->
    <script>

        getUsersNotification();
        // User's Notification
        $(document).ready(function() {
            setInterval(function() {
                getUsersNotification();
            }, 10000);
        });
        function getUsersNotification(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('investor.notifications') }}",
                method: 'get',
                success: function(result) {
                    if(result.status == true){
                        $('.notification-list').empty();
                        $('.notification-list').append(result.data);
                    } else{
                        $('.notification-list').empty();
                        $('.notification-list').html('<div class="d-flex flex-center text-center text-muted min-h-200px">All caught up! <br />No new notifications.</div>');
                    }
                }
            });
        }



        $(function () {
            $(".datepicker").datepicker({
                format: 'dd-mm-yyyy',
                orientation: 'bottom',
                startDate: new Date(),
            });
        });
        $(window).on('load',function(){
            //preloader
            var preLoder = $("#preloader");
            preLoder.addClass('hide');
        });

        var KTAppSettings = {
            "breakpoints": {
                "sm": 320,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };
        var ctx = document.getElementById('graph-2').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'doughnut',
            // The data for our dataset
            data: {
                labels: ['Red', 'Orange', 'Yellow', 'Green', 'Blue'],
                datasets: [{
                    label: "Din ledelsesstil",
                    backgroundColor: [
                        "#1ACEB3", "#F1C50F", "#FF0045", "#43076F"
                    ],
                    data: [54, 12, 9, 23],
                }]
            },

            // Configuration options go here
            options: {
                legend: {
                    display: false,
                },
                tooltips: {
                    enabled: true,
                    mode: 'index',
                    callbacks: {
                        label: function (tooltipItems, data) {
                            var i, label = [],
                                l = data.datasets.length;
                            for (i = 0; i < l; i += 1) {
                                label[i] = data.datasets[i].label + ': ' + data.datasets[i].data[tooltipItems.index] + '%';
                            }
                            return label;
                        }
                    }
                }
            }
        });


    </script>

@yield('scripts')
</body>
</html>
