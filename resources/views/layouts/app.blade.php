<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="author" content="DiversoLab">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">

    <!-- Page Title  -->
    <title>@yield('title') | FMREPO</title>

    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('css/dashlite.css?ver=2.4.0')}}">
    <link rel="stylesheet" href="{{ asset('css/theme.css?ver=2.4.0')}}">

    <!-- Font awesome -->
    <link rel="stylesheet" href="{{ asset('css/libs/fontawesome-icons.css?ver=2.4.0')}}">

    <!-- Filepond -->
    <link rel="stylesheet" href="{{ asset('css/filepond.css') }}" >

    <!-- Summernote -->
    <link rel="stylesheet" href="{{ asset('css/editors/summernote.css') }}" >

    @livewireStyles

</head>

<body class="nk-body npc-default has-apps-sidebar has-sidebar ">
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- wrap @s -->
        <div class="nk-wrap ">

            <div class="nk-header nk-header-fixed is-light">
                <div class="container-fluid">
                    <div class="nk-header-wrap">
                        <div class="nk-menu-trigger d-xl-none ml-n1">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                        </div>
                        <div class="nk-header-app-name">
                            <div class="nk-header-app-info">
                                <span class="lead-text">FaMaREPO</span>
                            </div>
                        </div>
                        <div class="nk-header-menu is-light">
                            <div class="nk-header-menu-inner">
                                <!-- Menu -->
                                <ul class="nk-menu nk-menu-main">

                                    @if(Auth::guest())
                                        <li class="nk-menu-item">
                                            <a href="{{route('register')}}" class="nk-menu-link">
                                                <span class="nk-menu-text">Create an account</span>
                                            </a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{route('login')}}" class="nk-menu-link">
                                                <span class="nk-menu-text">Log in</span>
                                            </a>
                                        </li>
                                    @endif

                                    @if(Auth::check())

                                        @if(!Auth::user()->has_role('RESEARCHER'))
                                        <li class="nk-menu-item">
                                            <a href="{{route('register.researcher')}}" class="nk-menu-link">
                                                <span class="nk-menu-text">Register as a researcher</span>
                                            </a>
                                        </li>
                                        @endif

                                        @if(!Auth::user()->has_role('DEVELOPER'))
                                            <li class="nk-menu-item">
                                                <a href="{{route('register.developer')}}" class="nk-menu-link">
                                                    <span class="nk-menu-text">Register as a developer</span>
                                                </a>
                                            </li>
                                        @endif

                                    @endif

                                </ul>
                                <!-- Menu -->
                            </div>
                        </div>
                        <div class="nk-header-tools">
                            <ul class="nk-quick-nav">

                                <li class="dropdown user-dropdown">

                                    @if(Auth::guest())

                                        <a href="#" class="dropdown-toggle mr-n1" data-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                            </div>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    You are currently as a guest
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="html/user-profile-regular.html"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                                    <li><a href="html/user-profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                                    <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                                </ul>
                                            </div>
                                        </div>

                                    @endif

                                    @if(Auth::check())

                                    <a href="#" class="dropdown-toggle mr-n1" data-toggle="dropdown">
                                        <div class="user-toggle">
                                            <div class="user-avatar sm">
                                                <em class="icon ni ni-user-alt"></em>
                                            </div>

                                            <div class="user-info d-none d-md-block">
                                                <div class="user-name dropdown-indicator">{{Auth::user()->name}} {{Auth::user()->surname}}</div>
                                            </div>

                                        </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">

                                        <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                            <div class="user-card">
                                                <div class="user-avatar">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text">{{Auth::user()->name}} {{Auth::user()->surname}}</span>
                                                    <span class="sub-text">{{Auth::user()->email}}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="#"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                                <li><a href="#"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                                <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                            </ul>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">

                                                <li>
                                                    <a href="{{ route('logout') }}"  class="nav-link"
                                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        <em class="icon ni ni-signout"></em>
                                                        <p>
                                                            Sign out
                                                        </p>
                                                    </a>
                                                </li>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </ul>
                                        </div>
                                    </div>

                                    @endif

                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="nk-sidebar" data-content="sidebarMenu">
                <div class="nk-sidebar-inner" data-simplebar>

                    <ul class="nk-menu nk-menu-md">
                        <li class="nk-menu-heading">
                            <h6 class="overline-title text-primary-alt">Menu</h6>
                        </li>

                        <x-li name="Home" route="home" icon="ni ni-home"/>
                        <x-li name="Datasets" route="dataset.list" secondaries="dataset.view" icon="ni ni-network"/>
                        <x-li name="Upload dataset" route="dataset.upload" icon="ni ni-upload"/>
                        <x-li name="Communities" route="community.list" secondaries="community.view,researcher.community.dataset.add,researcher.community.join" icon="ni ni-users-fill"/>

                        @if(Auth::check())

                            <x-menu_researcher/>

                            <x-menu_developer/>

                            <x-menu_reviewer/>

                        @endif

                    </ul>


                </div>
            </div>

            <div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">



                                    <div class="nk-block-head-content">

                                        <div class="nk-block-head-sub">

                                            @yield('breadcrumb')

                                        </div>



                                        <h3 class="nk-block-title page-title">@yield('title')</h3>
                                        <div class="nk-block-des text-soft">
                                            <p>@yield('subtitle')</p>
                                        </div>
                                    </div>
                                    <!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div><!-- .nk-block-head -->


                            @if (session('success'))
                                <div class="alert alert-pro alert-success alert-dismissible">
                                    <div class="alert-text">
                                        <h6>Success!</h6>
                                        <p>{!!  session("success") !!}</p>
                                    </div>
                                    <button class="close" data-dismiss="alert"></button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-pro alert-danger alert-dismissible">
                                    <div class="alert-text">
                                        <h6>Error</h6>
                                        <p>{!!  session("error") !!}</p>
                                    </div>
                                    <button class="close" data-dismiss="alert"></button>
                                </div>
                            @endif


                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- wrap @e -->
    </div>
    <!-- main @e -->
</div>
<!-- app-root @e -->

<!-- JavaScript -->
<script src="{{ asset('js/bundle.js?ver=2.4.0') }}"></script>
<script src="{{ asset('js/scripts.js?ver=2.4.0') }}"></script>
<script src="{{ asset('js/charts/gd-analytics.js?ver=2.4.0') }}"></script>
<script src="{{ asset('js/libs/jqvmap.js?ver=2.4.0') }}"></script>

<script>


    $(document).ready(function() {

    });

</script>

<script src="{{asset('js/filepond-plugin-file-validate-size.js')}}"></script>
<script src="{{asset('js/filepond-plugin-file-validate-type.js')}}"></script>
<script src="{{asset('js/filepond.js')}}"></script>
<script src="{{asset('js/libs/editors/summernote.js')}}"></script>
<script src="{{asset('js/editors.js')}}"></script>

<script>
    $('#selectAll').click(function(e){
        console.log("llega");
        var table= $(e.target).closest('table');
        $('td input:checkbox',table).prop('checked',this.checked);
    });
</script>

@yield('scripts')

@livewireScripts

</body>

</html>
