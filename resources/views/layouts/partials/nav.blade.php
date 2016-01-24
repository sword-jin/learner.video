<header>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#learner-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="{{ url('/') }}" class="navbar-bread learner-bread learner-bread--hover">
                    L<span class="learner-bread--one">e</span><span class="learner-bread--two">a</span><span class="learner-bread--three">r</span><span class="learner-bread--four">n</span><span class="learner-bread--five">e</span><span class="learner-bread--six">r</span>
                </a>
            </div> <!-- navbar-header -->

            <div id="learner-toggle" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#">系列</a></li>
                    <li><a href="#">视频</a></li>
                    <li><a href="#">博客</a></li>
                    <li><a href="#">资源</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">登陆</a></li>
                    <li><a href="{{ url('/register') }}">注册</a></li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div> <!-- navbar -->
    </nav> <!-- nav -->
</header> <!-- header -->