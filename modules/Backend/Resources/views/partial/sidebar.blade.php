<aside class="fixed skin-6">
            <div class="sidebar-inner scrollable-sidebar">
                <div class="size-toggle">
                    <a class="btn btn-sm" id="sizeToggle">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="btn btn-sm pull-right logoutConfirm_open"  href="#logoutConfirm">
                        <i class="fa fa-power-off"></i>
                    </a>
                </div><!-- /size-toggle --> 
                <div class="user-block clearfix">
                    <img src="{{  asset('backend/img/icon40-person.png') }}" alt="User Avatar">
                    <div class="detail">
                        <strong>{{ Auth::user()->name }}</strong>
                            <span class="badge badge-danger m-left-xs bounceIn animation-delay4">4</span>
                    </div>
                </div><!-- /user-block -->
                <div class="search-block">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm" placeholder="search here...">
                        <span class="input-group-btn">
                            <button class="btn btn-default btn-sm" type="button"><i class="fa fa-search"></i></button>
                        </span>
                    </div><!-- /input-group -->
                </div><!-- /search-block -->
                <div class="main-menu">
                    <ul>
                        <li class="active">
                            <a href="{{ url('') }}">
                                <span class="menu-icon">
                                    <i class="fa fa-desktop fa-lg"></i> 
                                </span>
                                <span class="text">
                                    Dashboard
                                </span>
                                <span class="menu-hover"></span>
                            </a>
                        </li>
                        @if(Auth::user()->isAdmin() == true)
                            <li>
                                <a href="{{ Route('backend.mon-hoc.admin') }}">
                                    <span class="menu-icon">
                                        <i class="fa fa-file-text fa-lg"></i> 
                                    </span>
                                    <span class="text"> 
                                        Môn học
                                    </span>
                                    <span class="menu-hover"></span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ Route('user.list') }}">
                                    <span class="menu-icon">
                                        <i class="fa fa-user fa-lg"></i> 
                                    </span>
                                    <span class="text"> 
                                        Người dùng
                                    </span>
                                </a>
                            </li>
                        @elseif(Auth::user()->isTeacher() == true)
                        <li>
                            <a href="{{ Route('backend.mon-hoc') }}">
                                <span class="menu-icon">
                                    <i class="fa fa-file-text fa-lg"></i> 
                                </span>
                                <span class="text">
                                    Môn học
                                </span>
                                <span class="menu-hover"></span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ Route('backend.bai-thi') }}">
                                <span class="menu-icon">
                                    <i class="fa fa-list fa-lg"></i> 
                                </span>
                                <span class="text">
                                    Bài thi
                                </span>
                                <span class="menu-hover"></span>
                            </a>
                        </li>
                        <li class="openable open">
                            <a href="#">
                                <span class="menu-icon">
                                    <i class="fa fa-question-circle-o fa-lg"></i> 
                                </span>
                                <span class="text">
                                    Câu hỏi
                                </span>
                                <span class="menu-hover"></span>
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ Route('backend.new-cau-hoi') }}"><span class="submenu-label">Thêm mới</span></a></li>
                                <li><a href="{{ Route('backend.cau-hoi') }}"><span class="submenu-label">Danh sách</span></a></li>
                            </ul>
                        </li>
                        @endif
                        
                    </ul>
                </div><!-- /main-menu -->
            </div><!-- /sidebar-inner -->
        </aside>