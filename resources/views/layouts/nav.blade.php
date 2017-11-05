<nav class="navbar navbar-default navbar-fixed-top" style="border-bottom-width: 0px; height: 50px; padding-top: 5px; padding-bottom: 55px; z-index: 9999">
    <div class="container" style="width: 95%">
        <div class="navbar-header visible-xs-block">
            <div class="row">
                <div class="col-xs-2" style="margin: 0">
                    <a href="{{ url('/') }}">
                        <img src="https://s3-us-west-2.amazonaws.com/freerider/avatars/thumbnails/default_freerider_profile_pic.jpg" style="border-radius: 2px; margin-top: 7px" width="35px" height="35px">
                    </a>
                </div>
                <div class="col-xs-8" style="display: inline; margin-top: 7px; margin-left: -10px; margin-right: 10px">
                    <form action="{{ route('order.search') }}" method="GET">
                        <div class="row">
                            <div class="col-xs-7" style="width: 80%">
                                <div class="form-group">
                                    <input style="box-shadow: none; border-radius: 2px; font-weight: 300" name="name" type="text" class="form-control" placeholder="搜索">
                                </div>
                            </div>
                            <div class="col-xs-5" style="width: 70px; margin-left: -25px">
                                <button style="box-shadow: none; border-radius: 2px;" type="submit" class="btn btn-default form-control"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xs-2">
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse" style="background-color: white">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav hidden-xs">
                <li>
                    <a href="{{ url('/') }}" style="margin-right: -20px">
                        <img src="https://s3-us-west-2.amazonaws.com/freerider/avatars/thumbnails/default_freerider_profile_pic.jpg" style="border-radius: 2px; margin-top: -10px; margin-bottom: -8px" width="35px" height="35px">
                    </a>
                </li>
                <li>
                    <a style="font-size: 25px; font-weight: 300" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
                </li>
                <li>
                    <form class="navbar-form" action="{{ route('order.search') }}" method="GET">
                        <div class="form-group">
                            <input style="box-shadow: none; border-radius: 2px; font-weight: 300" name="name" type="text" class="form-control" placeholder="搜索">
                        </div>
                        <button style="box-shadow: none; border-radius: 2px;" type="submit" class="btn btn-default form-control"><i class="glyphicon glyphicon-search"></i></button>
                    </form>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ route('order.create') }}">落單</a></li>
                <!-- Authentication Links -->
                @guest
                    <li><a href="{{ route('login') }}">登入</a></li>
                    <li><a href="{{ route('register') }}">註冊</a></li>
                    <li><a href="/manual">指南</a></li>
                @else
                    <li><a href="{{ route('order.index') }}">我的訂單</a></li>
                    @if (auth()->user()->trans != '[]')
                        <li><a href="{{ route('tran.index') }}">我的接單</a></li>
                    @endif
                    <li>
                        <a href="{{ route('user.edit', ['user' => auth()->user()]) }}" style="padding-left: 13px; padding-right: 15px">
                            <img src="https://s3-us-west-2.amazonaws.com/freerider/avatars/thumbnails/{{ Auth::user()->avatar->filename }}.jpg" class="img-circle" style="margin-top: -10px; margin-bottom: -8px" width="35px" height="35px">&nbsp;
                            {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li><a href="/manual">指南</a></li>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            登出
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>