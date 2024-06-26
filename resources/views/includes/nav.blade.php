<section class="amcrowd-fd">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-12 p-0 mt-3">

                <nav class="navbar navbar-expand-lg navbar-light">
                    <a href="{{ url('/') }}" class="navbar-brand ml-15">
                        <img src="{{ asset('images/nav-logo.png') }}" height="28" class="img-fluid">
                    </a>
                    <button type="button" class="navbar-toggler mr-15" data-toggle="collapse"
                            data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse for_mobs" id="navbarCollapse">
                        <div class="navbar-nav ls_impt mx-auto">
                            <a href="#" class="nav-item nav-link">{{ __('nav.Invest') }}</a>
                            <a href="{{ route('fund-raising-request') }}" class="nav-item nav-link">{{ __('nav.GET FINANCING') }}</a>
                            <a href="#" class="nav-item nav-link">{{ __('nav.RESOURCES') }}</a>
                            <a href="#" class="nav-item nav-link">{{ __('nav.FAQ') }}</a>
                        </div>
                        <div class="navbar_nav">
                            @auth
                            <div class="for_bn">
                                <a href="{{ auth()->user()->is_admin == 1 ? route('admin.home') : route('investor.home') }}" class="btn1">{{ __('nav.Dashboard') }}</a>
                                <a class="btn1" href="#"
                                   onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                    {{ __('auth.logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                            @else
                            <div class="for_bn">
                                <a href="{{ route('register') }}" class="btn1">{{ __('auth.signup') }}</a>
                                <a href="{{ route('login') }}" class="hov_btn">{{ __('auth.login') }}</a>
                            </div>
                            @endauth
                        </div>
                        <div class="language-select">
                            <select class="selectpicker" data-width="fit" id="select-lang">
                                <option data-lang="ar" {{App::getLocale() == 'ar' ? 'selected' : ''}}>عربي </option>
                                <option data-lang="en" {{ App::getLocale() == 'en' ? 'selected' : '' }}>English</option>
                            </select>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</section>
