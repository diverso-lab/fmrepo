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
</head>

<body class="nk-body npc-default has-apps-sidebar has-sidebar ">
<div class="nk-app-root">
    <!-- main @s -->
    <div class="nk-main ">
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            <div class="nk-header nk-header-fixed is-light">
                <div class="container-fluid">
                    <div class="nk-header-wrap">
                        <div class="nk-menu-trigger d-xl-none ml-n1">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                        </div>
                        <div class="nk-header-app-name">
                            <div class="nk-header-app-logo">
                                <em class="icon ni ni-dashlite bg-purple-dim"></em>
                            </div>
                            <div class="nk-header-app-info">
                                <span class="sub-text">FM</span>
                                <span class="lead-text">REPO</span>
                            </div>
                        </div>
                        <div class="nk-header-menu is-light">
                            <div class="nk-header-menu-inner">
                                <!-- Menu -->
                                <ul class="nk-menu nk-menu-main">

                                    @if(!Auth::user()->has_role('RESEARCHER'))
                                    <li class="nk-menu-item">
                                        <a href="{{route('register.researcher')}}" class="nk-menu-link">
                                            <span class="nk-menu-text">Register as a researcher</span>
                                        </a>
                                    </li>
                                    @endif

                                    @if(!Auth::user()->has_role('DEVELOPER'))
                                        <li class="nk-menu-item">
                                            <a href="html/index.html" class="nk-menu-link">
                                                <span class="nk-menu-text">Register as a developer</span>
                                            </a>
                                        </li>
                                    @endif

                                </ul>
                                <!-- Menu -->
                            </div>
                        </div>
                        <div class="nk-header-tools">
                            <ul class="nk-quick-nav">
                                {{--
                                <li class="dropdown chats-dropdown hide-mb-xs">
                                    <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                                        <div class="icon-status icon-status-na"><em class="icon ni ni-comments"></em></div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right">
                                        <div class="dropdown-head">
                                            <span class="sub-title nk-dropdown-title">Recent Chats</span>
                                            <a href="#">Setting</a>
                                        </div>
                                        <div class="dropdown-body">
                                            <ul class="chat-list">
                                                <li class="chat-item">
                                                    <a class="chat-link" href="html/apps/chats.html">
                                                        <div class="chat-media user-avatar">
                                                            <span>IH</span>
                                                            <span class="status dot dot-lg dot-gray"></span>
                                                        </div>
                                                        <div class="chat-info">
                                                            <div class="chat-from">
                                                                <div class="name">Iliash Hossain</div>
                                                                <span class="time">Now</span>
                                                            </div>
                                                            <div class="chat-context">
                                                                <div class="text">You: Please confrim if you got my last messages.</div>
                                                                <div class="status delivered">
                                                                    <em class="icon ni ni-check-circle-fill"></em>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li><!-- .chat-item -->
                                                <li class="chat-item is-unread">
                                                    <a class="chat-link" href="html/apps/chats.html">
                                                        <div class="chat-media user-avatar bg-pink">
                                                            <span>AB</span>
                                                            <span class="status dot dot-lg dot-success"></span>
                                                        </div>
                                                        <div class="chat-info">
                                                            <div class="chat-from">
                                                                <div class="name">{{ Auth::user()->name  }}</div>
                                                                <span class="time">4:49 AM</span>
                                                            </div>
                                                            <div class="chat-context">
                                                                <div class="text">Hi, I am Ishtiyak, can you help me with this problem ?</div>
                                                                <div class="status unread">
                                                                    <em class="icon ni ni-bullet-fill"></em>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li><!-- .chat-item -->
                                                <li class="chat-item">
                                                    <a class="chat-link" href="html/apps/chats.html">
                                                        <div class="chat-media user-avatar">
                                                            <img src="./images/avatar/b-sm.jpg" alt="">
                                                        </div>
                                                        <div class="chat-info">
                                                            <div class="chat-from">
                                                                <div class="name">George Philips</div>
                                                                <span class="time">6 Apr</span>
                                                            </div>
                                                            <div class="chat-context">
                                                                <div class="text">Have you seens the claim from Rose?</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li><!-- .chat-item -->
                                                <li class="chat-item">
                                                    <a class="chat-link" href="html/apps/chats.html">
                                                        <div class="chat-media user-avatar user-avatar-multiple">
                                                            <div class="user-avatar">
                                                                <img src="./images/avatar/c-sm.jpg" alt="">
                                                            </div>
                                                            <div class="user-avatar">
                                                                <span>AB</span>
                                                            </div>
                                                        </div>
                                                        <div class="chat-info">
                                                            <div class="chat-from">
                                                                <div class="name">Softnio Group</div>
                                                                <span class="time">27 Mar</span>
                                                            </div>
                                                            <div class="chat-context">
                                                                <div class="text">You: I just bought a new computer but i am having some problem</div>
                                                                <div class="status sent">
                                                                    <em class="icon ni ni-check-circle"></em>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li><!-- .chat-item -->
                                                <li class="chat-item">
                                                    <a class="chat-link" href="html/apps/chats.html">
                                                        <div class="chat-media user-avatar">
                                                            <img src="./images/avatar/a-sm.jpg" alt="">
                                                            <span class="status dot dot-lg dot-success"></span>
                                                        </div>
                                                        <div class="chat-info">
                                                            <div class="chat-from">
                                                                <div class="name">Larry Hughes</div>
                                                                <span class="time">3 Apr</span>
                                                            </div>
                                                            <div class="chat-context">
                                                                <div class="text">Hi Frank! How is you doing?</div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li><!-- .chat-item -->
                                                <li class="chat-item">
                                                    <a class="chat-link" href="html/apps/chats.html">
                                                        <div class="chat-media user-avatar bg-purple">
                                                            <span>TW</span>
                                                        </div>
                                                        <div class="chat-info">
                                                            <div class="chat-from">
                                                                <div class="name">Tammy Wilson</div>
                                                                <span class="time">27 Mar</span>
                                                            </div>
                                                            <div class="chat-context">
                                                                <div class="text">You: I just bought a new computer but i am having some problem</div>
                                                                <div class="status sent">
                                                                    <em class="icon ni ni-check-circle"></em>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li><!-- .chat-item -->
                                            </ul><!-- .chat-list -->
                                        </div><!-- .nk-dropdown-body -->
                                        <div class="dropdown-foot center">
                                            <a href="html/chats.html">View All</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown notification-dropdown">
                                    <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                                        <div class="icon-status icon-status-info"><em class="icon ni ni-bell"></em></div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right">
                                        <div class="dropdown-head">
                                            <span class="sub-title nk-dropdown-title">Notifications</span>
                                            <a href="#">Mark All as Read</a>
                                        </div>
                                        <div class="dropdown-body">
                                            <div class="nk-notification">
                                                <div class="nk-notification-item dropdown-inner">
                                                    <div class="nk-notification-icon">
                                                        <em class="icon icon-circle bg-primary-dim ni ni-share"></em>
                                                    </div>
                                                    <div class="nk-notification-content">
                                                        <div class="nk-notification-text">Iliash shared <span>Dashlite-v2</span> with you.</div>
                                                        <div class="nk-notification-time">Just now</div>
                                                    </div>
                                                </div>
                                                <div class="nk-notification-item dropdown-inner">
                                                    <div class="nk-notification-icon">
                                                        <em class="icon icon-circle bg-info-dim ni ni-edit"></em>
                                                    </div>
                                                    <div class="nk-notification-content">
                                                        <div class="nk-notification-text">Iliash <span>invited</span> you to edit <span>DashLite</span> folder</div>
                                                        <div class="nk-notification-time">2 hrs ago</div>
                                                    </div>
                                                </div>
                                                <div class="nk-notification-item dropdown-inner">
                                                    <div class="nk-notification-icon">
                                                        <em class="icon icon-circle bg-primary-dim ni ni-share"></em>
                                                    </div>
                                                    <div class="nk-notification-content">
                                                        <div class="nk-notification-text">You have shared <span>project v2</span> with Parvez.</div>
                                                        <div class="nk-notification-time">7 days ago</div>
                                                    </div>
                                                </div>
                                                <div class="nk-notification-item dropdown-inner">
                                                    <div class="nk-notification-icon">
                                                        <em class="icon icon-circle bg-success-dim ni ni-spark"></em>
                                                    </div>
                                                    <div class="nk-notification-content">
                                                        <div class="nk-notification-text">Your <span>Subscription</span> renew successfully.</div>
                                                        <div class="nk-notification-time">2 month ago</div>
                                                    </div>
                                                </div>
                                            </div><!-- .nk-notification -->
                                        </div><!-- .nk-dropdown-body -->
                                        <div class="dropdown-foot center">
                                            <a href="#">View All</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown list-apps-dropdown d-lg-none">
                                    <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                                        <div class="icon-status icon-status-na"><em class="icon ni ni-menu-circled"></em></div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                        <div class="dropdown-body">
                                            <ul class="list-apps">
                                                <li>
                                                    <a href="html/index.html">
                                                        <span class="list-apps-media"><em class="icon ni ni-dashlite bg-primary text-white"></em></span>
                                                        <span class="list-apps-title">Dashboard</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="html/apps/chats.html">
                                                        <span class="list-apps-media"><em class="icon ni ni-chat-circle bg-info-dim"></em></span>
                                                        <span class="list-apps-title">Chats</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="html/apps/mailbox.html">
                                                        <span class="list-apps-media"><em class="icon ni ni-inbox bg-purple-dim"></em></span>
                                                        <span class="list-apps-title">Mailbox</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="html/apps/messages.html">
                                                        <span class="list-apps-media"><em class="icon ni ni-chat bg-success-dim"></em></span>
                                                        <span class="list-apps-title">Messages</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="html/apps/file-manager.html">
                                                        <span class="list-apps-media"><em class="icon ni ni-folder bg-purple-dim"></em></span>
                                                        <span class="list-apps-title">File Manager</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="html/components.html">
                                                        <span class="list-apps-media"><em class="icon ni ni-layers bg-secondary-dim"></em></span>
                                                        <span class="list-apps-title">Components</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <ul class="list-apps">
                                                <li>
                                                    <a href="/demo2/ecommerce/index.html">
                                                        <span class="list-apps-media"><em class="icon ni ni-cart bg-danger-dim"></em></span>
                                                        <span class="list-apps-title">Ecommerce Panel</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="/demo4/subscription/index.html">
                                                        <span class="list-apps-media"><em class="icon ni ni-calendar-booking bg-primary-dim"></em></span>
                                                        <span class="list-apps-title">Subscription Panel</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="/demo5/crypto/index.html">
                                                        <span class="list-apps-media"><em class="icon ni ni-bitcoin-cash bg-warning-dim"></em></span>
                                                        <span class="list-apps-title">Crypto Wallet Panel</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="/demo6/invest/index.html">
                                                        <span class="list-apps-media"><em class="icon ni ni-invest bg-blue-dim"></em></span>
                                                        <span class="list-apps-title">HYIP Invest Panel</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div><!-- .nk-dropdown-body -->
                                    </div>
                                </li>
                                --}}
                                <li class="dropdown user-dropdown">
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
                                                <div class="user-avatar">
                                                    <span>{{StringUtilities::get_acronym(Auth::user()->name." ".Auth::user()->surname)}}</span>
                                                </div>
                                                <div class="user-info">
                                                    <span class="lead-text"><div class="name">{{ Auth::user()->name  }} {{ Auth::user()->surname  }}</div></span>
                                                    <span class="sub-text">{{ Auth::user()->email  }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-inner">
                                            <ul class="link-list">
                                                <li><a href="html/user-profile-regular.html"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                                <li><a href="html/user-profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
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
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main header @e -->
            <div class="nk-sidebar" data-content="sidebarMenu">
                <div class="nk-sidebar-inner" data-simplebar>

                    <ul class="nk-menu nk-menu-md">
                        <li class="nk-menu-heading">
                            <h6 class="overline-title text-primary-alt">Menu</h6>
                        </li>

                        <x-li name="Home" route="home" icon="ni ni-home"/>

                        <x-menu_researcher/>

                    </ul>


                </div>
            </div>
            <!-- content @s -->
            <div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between">

                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title page-title">@yield('title')</h3>
                                        <div class="nk-block-des text-soft">
                                            <p>@yield('subtitle')</p>
                                        </div>
                                    </div>
                                    <!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div><!-- .nk-block-head -->

                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <!-- content @e -->
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

</body>

</html>
