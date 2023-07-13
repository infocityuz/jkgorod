<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <meta http-equiv="cache-control" content="max-age=604800" />
    <meta http-equiv="cache-control" content="cache" /> --}}
    {{-- <meta http-equiv="expires" content="0" /> --}}
    {{-- <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" /> --}}
    {{-- <meta http-equiv="pragma" content="cache" /> --}}
    <title>CRM @yield('title')</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('/backend-assets/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('/backend-assets/css/custom.css')}}">
    @yield('styles')
    @yield('css')

    <style>
        .display-none{
            display:none;
        }

        .content{
            background-color: #E8F0FF;
        }
        .modal-body{
            padding:20px 44px 44px 44px;
        }
        .house_status_value{
            color:black !important;
            transition: 1s;
            padding: 10px 14px;
            border-radius: 4px;
            width: 100%;
        }
        .house_status_flat{
            display: flex ;
            flex-direction: column;
            border: solid 1px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            width: 100%;
            padding: 14px 6px;
        }
        .personal_cabinet_modal{
            background-color: white;
            width: 94%;
            border-radius: 6px;
            z-index:14;
        }
        .personal_cabinet_modal a{
            padding:7px 7px;
        }
        .display_lang{
            display: flex;
            justify-content: space-around;
            margin-bottom: 7px;
        }
        .display_lang img{
            width:34px;
            height: 20px;
        }
        .house_status_value:hover{
            transform: scale(1.04);
        }
        .house-status a{
            color:black !important;
            transition: 1s;
            border-radius: 4px;
            padding: 0px 18px;
        }
        .metro_status_value{
            color:black !important;
            transition: 1s;
            padding: 10px 14px;
            border: solid 1px rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            width: 100%;
        }

        .metro_status_value:hover{
            transform: scale(1.01);
        }
        .display_absolute{
            position: absolute;
            width: 144px;
            background-color: rgba(255, 255, 255, 0.9);
            margin: 7px 0px 0px -39px;
            box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.3);
        }
        .house_status_flat a{
            color:black;
        }
        .house_status_flat a:hover{
            color:white;
        }
        .display_lang{
            transition: 1s;
        }
        .display_lang{
            border-radius: 7px;
        }
        .display_lang:hover{
            transform: scale(1.04);
            color:white;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .language_selected{
            height: 34px;
            width:44px;
            border-radius: 10%;
        }

    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
{{--        <form class="form-inline ml-30">--}}
{{--            <div class="input-group input-group-sm">--}}
{{--                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">--}}
{{--                <div class="input-group-append">--}}
{{--                    <button class="btn btn-navbar" type="submit">--}}
{{--                        <i class="fas fa-search"></i>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}

{{--        <div><a href="{{route('site.index')}}" target="_blank">Saytga o'tish</a></div>--}}
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge"><b>0</b></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                    <span class="dropdown-item dropdown-header">0 Notifications</span>
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a href="#" class="dropdown-item">--}}
{{--                        <i class="fas fa-envelope mr-2"></i> 4 new messages--}}
{{--                        <span class="float-right text-muted text-sm">3 mins</span>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a href="#" class="dropdown-item">--}}
{{--                        <i class="fas fa-users mr-2"></i> 8 friend requests--}}
{{--                        <span class="float-right text-muted text-sm">12 hours</span>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a href="#" class="dropdown-item">--}}
{{--                        <i class="fas fa-file mr-2"></i> 3 new reports--}}
{{--                        <span class="float-right text-muted text-sm">2 days</span>--}}
{{--                    </a>--}}
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>--}}
                </div>
            </li>
            <li class="nav-item dropdown">
                <div>
                    <div>
                        @if(app()->getLocale() == 'ru')
                            <a type="button" class="house_status_value" id="house-status-value">
                                <img class="language_selected" src="{{asset('uploads/flags/rus.jpg')}}" alt="" >
                            </a>
                        @elseif(app()->getLocale() == 'en')
                            <a type="button" class="house_status_value" id="house-status-value">
                                <img class="language_selected" src="{{asset('uploads/flags/us.webp')}}" alt="">
                            </a>
                        @else
                            <a type="button" class="house_status_value" id="house-status-value">
                                <img class="language_selected" src="{{asset('uploads/flags/uzb.png')}}" alt="">
                            </a>
                        @endif
                    </div>
                    <div class="display-none" id="FlatLanguage">
                        <div class="display_absolute">
                            <div class="house_status_flat">
                                @if(isset($model) && isset($model->id))
                                    <a type="button" id="free" href="{{route(Route::currentRouteName(), ['language'=>'en', 'id'=>$model->id])}}">
                                        <div class="display_lang">
                                            <span>EN</span>
                                            <img src="{{asset('uploads/flags/us.webp')}}" alt="" height="20px" width="34px">
                                        </div>
                                    </a>
                                    <a type="button" id="busy" href="{{route(Route::currentRouteName(), ['language'=>'ru', 'id'=>$model->id])}}">
                                        <div class="display_lang">
                                            <span>RU</span>
                                            <img src="{{asset('uploads/flags/rus.jpg')}}" alt="" height="20px" width="34px">
                                        </div>
                                    </a>
                                    <a type="button" id="sales" href="{{route(Route::currentRouteName(), ['language'=>'uz', 'id'=>$model->id])}}">
                                        <div class="display_lang">
                                            <span>UZ</span>
                                            <img src="{{asset('uploads/flags/uzb.png')}}" alt="" height="20px" width="34px">
                                        </div>
                                    </a>
                                @else
                                    <a type="button" id="free" href="{{route(Route::currentRouteName(), 'en')}}">
                                        <div class="display_lang">
                                            <span>EN</span>
                                            <img src="{{asset('uploads/flags/us.webp')}}" alt="" height="20px" width="34px">
                                        </div>
                                    </a>
                                    <a type="button" id="busy" href="{{route(Route::currentRouteName(), 'ru')}}">
                                        <div class="display_lang">
                                            <span>RU</span>
                                            <img src="{{asset('uploads/flags/rus.jpg')}}" alt="" height="20px" width="34px">
                                        </div>
                                    </a>
                                    <a type="button" id="sales" href="{{route(Route::currentRouteName(), 'uz')}}">
                                        <div class="display_lang">
                                            <span>UZ</span>
                                            <img src="{{asset('uploads/flags/uzb.png')}}" alt="" height="20px" width="34px">
                                        </div>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
{{--                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 200px;max-width: 200px;">--}}
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a href="{{route('fswitchLocale','uz')}}" class="dropdown-item">--}}
{{--                        <i class="fas fa-cog mr-2"></i> {{ __('Uz') }}--}}
{{--                    </a>--}}
{{--                    <span class="float-right text-muted text-sm"></span>--}}

{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a href="{{route('fswitchLocale','ru')}}" class="dropdown-item">--}}
{{--                        <i class="fas fa-cog mr-2"></i> {{ __('Ru') }}--}}
{{--                    </a>--}}
{{--                    <span class="float-right text-muted text-sm"></span>--}}
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a href="{{route('fswitchLocale','en')}}" class="dropdown-item">--}}
{{--                        <i class="fas fa-cog mr-2"></i> {{ __('En') }}--}}
{{--                    </a>--}}
{{--                    <span class="float-right text-muted text-sm"></span>--}}
{{--                </div>--}}
            </li>
            <li class="nav-item dropdown" style="margin-left: 20px">
                <a class="nav-link" id="avatar" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fas fa-user" style="margin-right: 5px"></i>{{ Auth::user()->email }}<i class="fas fa-angle-down"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 200px;max-width: 200px;">
                    <div class="dropdown-divider"></div>
                    <a href="{{route('user.edit', [Auth::user()->id, app()->getLocale()])}}" class="dropdown-item">
                        <i class="fas fa-cog mr-2"></i> {{ __('locale.settings') }}
                    </a>
                    <span class="float-right text-muted text-sm"></span>

                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        {{ __('locale.logout') }}
                    </a>
                    <span class="float-right text-muted text-sm">
                        <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </span>

                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar elevation-4">

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="user-panel mt-3 pb-2 mb-3 d-flex">
                <div class="image" id="profile_modal">
                    @if(!empty(Auth::user()->avatar))
                        <img src="{{ asset('/uploads/user/'.Auth::user()->id.'/s_'.Auth::user()->avatar)}}" class="img-circle elevation-2" style="margin-bottom: 0" alt="User Image">
                    @else
                        <img src="{{ asset('/backend-assets/img/custom/user-avatar-c.png')}}" class="img-circle elevation-2" style="margin-bottom: 0" alt="User Image">
                    @endif
                </div>
                <div class="nav-item dropdown info">
                    <a href="{{route('user.edit',[Auth::user()->id, app()->getLocale()])}}" data-toggle="dropdown" aria-expanded="false" class="d-block">{{ Auth::user()->first_name }}</a>
                </div>
            </div>
            <div id="personal_cabinet" class="display-none">
                <div class="position-absolute personal_cabinet_modal">
                    <a href="{{route('user.edit', [Auth::user()->id, app()->getLocale()])}}" class="dropdown-item">
                        <i class="fas fa-cog mr-2"></i> {{ __('locale.settings') }}
                    </a>
                    <span class="float-right text-muted text-sm"></span>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        {{ __('locale.logout') }}
                    </a>
                    <span class="float-right text-muted text-sm">
                        <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </span>
                </div>
            </div>
{{--            <hr style="background: #fff">--}}
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item ">
                        <a href="{{route('backend.index', app()->getLocale())}}" class="nav-link ">
                            <i class="fas fa-home"></i>
                            <p>
                                {{__('locale.home')}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-bars"></i>
                            <p>
                                {{ __('locale.objects') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item ">
                                <a href="{{route('apartment-sale.index', app()->getLocale())}}" class="nav-link">
                                    <i class="fas fa-building"></i>
                                    <p>{{__('locale.apartment_sale')}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('object.index', app()->getLocale())}}" class="nav-link">
                                    <i class="fas fa-university"></i>
                                    <p>{{__('locale.object')}}</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('parser.index', app()->getLocale())}}" class="nav-link">
                            <i class="fas fa-download"></i>
                            <p>{{__('locale.Parser')}}</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('request.index', app()->getLocale())}}" class="nav-link">
                            <i class="fas fa-user-tag"></i>
                            <p>{{__('locale.Request')}}</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('user.index', app()->getLocale())}}" class="nav-link ">
                            <i class="fas fa-users"></i>
                            <p>
                                {{__('locale.user')}}
                            </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route('action-logs.index', app()->getLocale())}}" class="nav-link ">
                            <i class="fa fa-history" aria-hidden="true"></i>
                            <p>
                                {{__('locale.action_logs')}}
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
              @yield('content')
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong> &copy; 2023 </strong>
        {{__('locale.All rights reserved.')}}
        <div class="float-right d-none d-sm-inline-block">
{{--            <b>Version</b> 1--}}
        </div>
{{--        <strong>Copyright &copy; 2014-2021 <a href="#">AdminLTE.io</a>.</strong>--}}
{{--        All rights reserved.--}}
{{--        <div class="float-right d-none d-sm-inline-block">--}}
{{--            <b>Version</b> 3.2.0--}}
{{--        </div>--}}
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<script src="{{asset('/backend-assets/plugins/jquery/jquery.min.js')}}"></script>

<script src="{{asset('/backend-assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{asset('/backend-assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/backend-assets/js/adminlte.js')}}"></script>

@yield('scripts')

<script src="{{asset('/backend-assets/js/custom.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#profile_modal').on('click', function (){
            if($('#personal_cabinet').hasClass('display-none')){
                $('#personal_cabinet').removeClass('display-none')
            }else{
                $('#personal_cabinet').addClass('display-none')
            }
        });
        function flatstatus(){
            if($('#FlatLanguage').hasClass('display-none')){
                $('#FlatLanguage').removeClass('display-none')
            }else{
                $('#FlatLanguage').addClass('display-none')
            }
        }
        $('#house-status-value').on('click', function (){
            flatstatus()
        });
        $('#busy').on('click', function (){
            flatstatus()
        });
        $('#sales').on('click', function (){
            flatstatus()
        });
        $('#free').on('click', function (){
            flatstatus()
        });
        $('.nav-item a').each(function(){
            let browserlocation = window.location.protocol + '//' + window.location.host + window.location.pathname;
            let alink = this.href;
            if (browserlocation == alink) {
                // $(this).parent().addClass('menu-open');
                $(this).addClass('active');
                $(this).parent().addClass('nav-item-menu-active');
                $('.nav-item-menu-active').parent().addClass('nav-menu-active');
                $('.nav-menu-active').parent().addClass('nav-nav-item-menu-active menu-open');
                $('.nav-nav-item-menu-active>a').addClass('active');

            }
        });
    });

</script>

</body>
</html>
