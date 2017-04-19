<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="{{ asset('backend/img/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('backend/img/favicon.ico') }}" type="image/x-icon">
    <title>@yield('title', 'Quiz')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('backend/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="{{ asset('backend/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    
    <!-- Pace -->
    <link href="{{ asset('backend/css/pace.css') }}" rel="stylesheet">
    
    <!-- Color box -->
    <link href="{{ asset('backend/css/colorbox/colorbox.css') }}" rel="stylesheet">
    
    <!-- Morris -->
    <link href="{{ asset('backend/css/morris.css') }}" rel="stylesheet"/>  
    
    <!-- Endless -->
    <link href="{{ asset('backend/css/endless.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/endless-skin.css') }}" rel="stylesheet">
    <style type="text/css">
        .disabled {
            pointer-events: none;
            cursor: default;
            opacity: 0.6;
        }
    </style>
    @yield('css')
    
  </head>

  <body class="overflow-hidden">

    <div id="wrapper" class="preload">
       @include('backend::partial.top_nav')
       @include('backend::partial.sidebar')

        <div id="main-container">
            <div id="breadcrumb">
                <ul class="breadcrumb">
                     <li><i class="fa fa-home"></i><a href="#"> @yield('type')</a></li>
                     <li class="active">@yield('title1')</li>   
                </ul>
            </div><!-- /breadcrumb-->
            <div class="main-header clearfix">
                <div class="page-title">
                    <h3 class="no-margin">@yield('title1')</h3>
                    
                </div><!-- /page-title -->
                
            </div><!-- /main-header -->
            @include('backend::block.success')
            @include('backend::block.errors')
            @yield('content')
            
        </div><!-- /main-container -->
        <!-- Footer
        ================================================== -->
        <footer>
            <div class="row">
                <div class="col-sm-6">
                    <span class="footer-brand">
                        <strong class="text-danger">Quiz</strong> Admin
                    </span>
                </div><!-- /.col -->
            </div><!-- /.row-->
        </footer>
        
       <!--Modal-->
        @yield('modal')
        <!-- /.modal --> 
        <!-- Logout confirmation -->
        <div class="custom-popup width-100" id="logoutConfirm">
            <div class="padding-md">
                <h4 class="m-top-none"> Do you want to logout?</h4>
            </div>

            <div class="text-center">
                <a class="btn btn-success m-right-sm" href="{{ url('logout') }}">Logout</a>
                <a class="btn btn-danger logoutConfirm_close">Cancel</a>
            </div>
        </div>

    </div><!-- /wrapper -->

    
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <!-- jQuery -->
    <script src="{{ asset('backend/js/jquery-1.10.2.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('backend/bootstrap/js/bootstrap.js') }}"></script>
   
    @yield('script')
    <!-- Morris -->
    <script src="{{ asset('backend/js/rapheal.min.js') }}"></script>   
    <script src="{{ asset('backend/js/morris.min.js') }}"></script>    
    
    <!-- Colorbox -->
    <script src="{{ asset('backend/js/jquery.colorbox.min.js') }}"></script>   

    <!-- Sparkline -->
    <script src="{{ asset('backend/js/jquery.sparkline.min.js') }}"></script>
    
    <!-- Pace -->
    <script src="{{ asset('backend/js/uncompressed/pace.js') }}"></script>
    
    <!-- Popup Overlay -->
    <script src="{{ asset('backend/js/jquery.popupoverlay.min.js') }}"></script>
    
    <!-- Slimscroll -->
    <script src="{{ asset('backend/js/jquery.slimscroll.min.js') }}"></script>
    
    <!-- Modernizr -->
    <script src="{{ asset('backend/js/modernizr.min.js') }}"></script>
    
    <!-- Cookie -->
    <script src="{{ asset('backend/js/jquery.cookie.min.js') }}"></script>
    
    <script src="{{ asset('backend/js/endless/endless.js') }}"></script>
    
    
  </body>
</html>
