@inject('navigation', 'Learner\Services\Layouts\Navigation')

<header>
    <nav class="navbar navbar-default navbar-fixed-top learner-nav" role="navigation">
        <div class="container">
            <div class="row">
                <!-- logo -->
                <div class="col-md-2 pull-left">
                    <a href="{{ url('/') }}" class="logo-light learner-bread learner-bread--hover">
                        <p class="no-margin hidden-xs">L<span class="learner-bread--one">e</span><span class="learner-bread--two">a</span><span class="learner-bread--three">r</span><span class="learner-bread--four">n</span><span class="learner-bread--five">e</span><span class="learner-bread--six">r</span></p>

                        <img src="{{ asset('img/logo.png') }}" alt="logo" class="visible-xs logo">
                    </a>
                </div>
                <!-- end logo -->

                <!-- auth -->
                <div class="col-md-2 auth-header pull-right">
                    @if (Auth::guest())
                    <div class="register-header">
                        <a href="{{ route('auth.register') }}" title="注册">
                            注册
                        </a>
                    </div>
                    <div class="login-header">
                        <a href="{{ route('auth.login') }}" class="登陆">
                            登陆
                        </a>
                    </div>
                    @else
                    <div class="nav-avatar-header">
                        <div class="nav-avatar dropdown simple-dropdown">
                            <a href="#user" class="dropdown-toggle no-hover-decoration" data-toggle="collapse" data-hover="dropdown">
                                <img src="{{ asset(Auth::user()->avatar) }}" alt="{{ Auth::user()->username }}" class="avatar">
                                <span class="nav-username">{{ Auth::user()->displayName() }}</span>
                            </a>
                            <div id="user" class="dropdown-menu panel-collapse collapse learner-dropdown" role="menu">
                                <li>
                                    <a href="{{ route('user.profile') }}" title="{{ lang('navigation.user_center', 'User Center') }}">
                                        <i class="fa fa-user"></i>
                                        {{ lang('navigation.user_center', 'User Center') }}
                                    </a>
                                </li>

                                @role(['admin', 'boss'])
                                <li>
                                    <a href="{{ route('admin.dashboard') }}" title="{{ lang('navigation.dashboard', "Dashboard") }}">
                                        <i class="fa fa-dashboard"></i>
                                        {{ lang('navigation.dashboard', "Dashboard") }}
                                    </a>
                                </li>
                                @endrole
                                <li>
                                    <a href="{{ route('auth.logout') }}" title="{{ lang('navigation.logout', 'Logout') }}">
                                        <i class="fa fa-btn fa-sign-out"></i>
                                        {{ lang('navigation.logout', 'Logout') }}
                                    </a>
                                </li>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <!-- end auth -->

                <!-- toggle navigation -->
                <div class="navbar-header col-sm-8 col-xs-2 pull-right">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- toggle navigation end -->

                <!-- menu -->
                <div class="col-md-8 accordion-menu text-right">
                    <div class="navbar-collapse collapse">
                        <ul id="accordion" class="nav navbar-nav navbar-right panel-group no-margin">
                            @foreach ($navigation->menus as $menu)
                                <li class="{{ isActive($menu['route']) }}">
                                    <a href="{{ route($menu['route']) }}" title="{{ $menu['display_name'] }}">
                                        {{ $menu['display_name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- menu end -->
        </div> <!-- navbar -->
    </nav> <!-- nav -->
</header> <!-- header -->
