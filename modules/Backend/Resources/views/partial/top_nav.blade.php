<div id="top-nav" class="fixed skin-6">
            <a href="#" class="brand">
                <span>Quiz</span>
                <span class="text-toggle"> Admin</span>
            </a><!-- /brand -->                 
            <button type="button" class="navbar-toggle pull-left" id="sidebarToggle">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <button type="button" class="navbar-toggle pull-left hide-menu" id="menuToggle">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <ul class="nav-notification clearfix">
                <li class="profile dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <strong>{{ Auth::user()->name }}</strong>
                        <span><i class="fa fa-chevron-down"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="clearfix" href="#">
                                <img src="{{  asset('backend/img/icon40-person.png') }}" alt="User Avatar">
                                <div class="detail">
                                    <strong>{{ Auth::user()->name }}</strong>
                                    <p class="grey">{{ Auth::user()->email }}</p> 
                                </div>
                            </a>
                        </li>
                        <li><a tabindex="-1" href="{{ Route('user.doimatkhau') }}" class="theme-setting"><i class="fa fa-cog fa-lg"></i> Đổi mật khẩu</a></li>
                        <li class="divider"></li>
                        <li><a tabindex="-1" class="main-link logoutConfirm_open" href="#logoutConfirm"><i class="fa fa-lock fa-lg"></i> Đăng xuất</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /top-nav-->