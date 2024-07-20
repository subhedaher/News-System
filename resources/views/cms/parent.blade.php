<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMS | @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
    @yield('style')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('home') }}" class="nav-link">{{ __('cms.hom') }}</a>
                </li>
                @canany(['Create-Role', 'Read-Roles', 'Update-Role', 'Delete-Role'])
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('roles.index') }}" class="nav-link">{{ __('cms.roles') }}</a>
                    </li>
                @endcanany
                @canany(['Create-Admin', 'Read-Admins', 'Update-Admin', 'Delete-Admin'])
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('admins.index') }}" class="nav-link">{{ __('cms.admins') }}</a>
                    </li>
                @endcanany
                @canany(['Create-Writer', 'Read-Writers', 'Update-Writer', 'Delete-Writer'])
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('writers.index') }}" class="nav-link">{{ __('cms.writers') }}</a>
                    </li>
                @endcanany
                @canany(['Create-Category', 'Read-Categories', 'Update-Category', 'Delete-Category'])
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('categories.index') }}" class="nav-link">{{ __('cms.categories') }}</a>
                    </li>
                @endcanany
                @canany(['Create-Article', 'Read-Articles', 'Update-Article', 'Delete-Article'])
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('articles.index') }}" class="nav-link">{{ __('cms.articles') }}</a>
                    </li>
                @endcanany
                @canany(['Read-Messages', 'Delete-Message'])
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('getMessages') }}" class="nav-link">{{ __('cms.messages') }}</a>
                    </li>
                @endcanany
                @canany(['Read-Comments', 'Delete-Comment'])
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="{{ route('getComments') }}" class="nav-link">{{ __('cms.comments') }}</a>
                    </li>
                @endcanany
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->
                @canany(['Read-Messages', 'Delete-Message'])
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-comments"></i>
                            <span class="badge badge-danger navbar-badge">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img src="{{ asset('assets/dist/img/user3-128x128.jpg') }}" alt="User Avatar"
                                        class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Nora Silvester
                                            <span class="float-right text-sm text-warning"><i
                                                    class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">The subject goes here</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>

                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img src="{{ asset('assets/dist/img/user3-128x128.jpg') }}" alt="User Avatar"
                                        class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Nora Silvester
                                            <span class="float-right text-sm text-warning"><i
                                                    class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">The subject goes here</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <div class="dropdown-divider"></div>

                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img src="{{ asset('assets/dist/img/user3-128x128.jpg') }}" alt="User Avatar"
                                        class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Nora Silvester
                                            <span class="float-right text-sm text-warning"><i
                                                    class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">The subject goes here</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                        </div>
                    </li>
                @endcanany
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        @if (auth()->user()->unreadNotifications()->count() > 0)
                            <span
                                class="badge badge-warning navbar-badge">{{ auth()->user()->unreadNotifications()->count() }}</span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        @foreach (auth()->user()->unreadNotifications as $unreadNotification)
                            <a href="{{ route('articles.show', $unreadNotification->data['article_slug']) }}"
                                class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img src="{{ asset('assets/dist/img/user1-128x128.jpg') }}" alt="User Avatar"
                                        class="img-size-50 mr-3 img-circle">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            {{ $unreadNotification->data['adminName'] }}
                                        </h3>
                                        <p class="text-sm">
                                            <b>The article
                                                {{ $unreadNotification->data['title'] . ' ' . $unreadNotification->data['notes'] }}</b>
                                        </p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                                            {{ $unreadNotification->data['created_at'] }}
                                        </p>
                                    </div>
                                </div>
                                <!-- Message End -->
                            </a>
                        @endforeach
                        <form action="{{ route('seeAll') }}" method="GET">
                            @csrf
                            <a href="{{ route('seeAll') }}" class="dropdown-item dropdown-footer">See All
                                Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-link">
                <img src="{{ asset('assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">News System</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('assets/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ auth()->user()->full_name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        @include('cms.components.nav-item', [
                            'routeName' => 'home',
                            'icon' => 'fas fa-home',
                            'label' => __('cms.hom'),
                        ])
                        @canany(['Create-Role', 'Read-Roles', 'Update-Role', 'Delete-Role'])
                            <li class="nav-header">{{ __('cms.role&permissions') }}</li>
                        @endcanany
                        @canany(['Create-Role', 'Read-Roles', 'Updte-Role', 'Delete-Role'])
                            @include('cms.components.nav-item-ul', [
                                'routMain' => 'roles',
                                'icon' => 'fas fa-user-shield',
                                'label' => __('cms.roles'),
                                'lis' => [
                                    [
                                        'label' => __('cms.create'),
                                        'route' => 'roles.create',
                                        'routTrash' => '',
                                        'routEdit' => '',
                                        'permission' => 'Create-Role',
                                    ],
                                    [
                                        'label' => __('cms.read'),
                                        'route' => 'roles.index',
                                        'routTrash' => '',
                                        'routEdit' => 'roles.edit',
                                        'permission' => 'Read-Roles',
                                    ],
                                ],
                            ])
                        @endcanany
                        @canany(['Create-Admin', 'Read-Admins', 'Update-Admin', 'Delete-Admin', 'Create-Writer',
                            'Read-Writers', 'Update-Writer', 'Delete-Writer'])
                            <li class="nav-header">{{ __('cms.users') }}</li>
                        @endcanany
                        @canany(['Create-Admin', 'Read-Admins', 'Update-Admin', 'Delete-Admin'])
                            @include('cms.components.nav-item-ul', [
                                'routMain' => 'admins',
                                'icon' => 'fas fa-user',
                                'label' => __('cms.admins'),
                                'lis' => [
                                    [
                                        'label' => __('cms.create'),
                                        'route' => 'admins.create',
                                        'routTrash' => '',
                                        'routEdit' => '',
                                        'permission' => 'Create-Admin',
                                    ],
                                    [
                                        'label' => __('cms.read'),
                                        'route' => 'admins.index',
                                        'routTrash' => '',
                                        'routEdit' => 'admins.edit',
                                        'permission' => 'Read-Admins',
                                    ],
                                ],
                            ])
                        @endcanany
                        @canany(['Create-Writer', 'Read-Writers', 'Update-Writer', 'Delete-Writer'])
                            @include('cms.components.nav-item-ul', [
                                'routMain' => 'writers',
                                'icon' => 'fas fa-user-edit',
                                'label' => __('cms.writers'),
                                'lis' => [
                                    [
                                        'label' => __('cms.create'),
                                        'route' => 'writers.create',
                                        'routTrash' => '',
                                        'routEdit' => '',
                                        'permission' => 'Create-Writer',
                                    ],
                                    [
                                        'label' => __('cms.read'),
                                        'route' => 'writers.index',
                                        'routTrash' => '',
                                        'routEdit' => 'writers.edit',
                                        'permission' => 'Read-Writers',
                                    ],
                                ],
                            ])
                        @endcanany
                        @canany(['Create-Category', 'Read-Categories', 'Update-Category', 'Delete-Category',
                            'Create-Article', 'Read-Articles', 'Update-Article', 'Delete-Article'])
                            <li class="nav-header">{{ __('cms.content') }}</li>
                        @endcanany
                        @canany(['Create-Category', 'Read-Categories', 'Update-Category'])
                            @include('cms.components.nav-item-ul', [
                                'routMain' => 'categories',
                                'icon' => 'fas fa-table',
                                'label' => __('cms.categories'),
                                'lis' => [
                                    [
                                        'label' => __('cms.create'),
                                        'route' => 'categories.create',
                                        'routTrash' => '',
                                        'routEdit' => '',
                                        'permission' => 'Create-Category',
                                    ],
                                    [
                                        'label' => __('cms.read'),
                                        'route' => 'categories.index',
                                        'routTrash' => 'categories.trash',
                                        'routEdit' => 'categories.edit',
                                        'permission' => 'Read-Categories',
                                    ],
                                ],
                            ])
                        @endcanany
                        @canany(['Create-Article', 'Read-Articles', 'Update-Article', 'Delete-Article'])
                            @include('cms.components.nav-item-ul', [
                                'routMain' => 'articles',
                                'icon' => 'fas fa-newspaper',
                                'label' => __('cms.articles'),
                                'lis' => [
                                    [
                                        'label' => __('cms.create'),
                                        'route' => 'articles.create',
                                        'routTrash' => '',
                                        'routEdit' => '',
                                        'permission' => 'Create-Article',
                                    ],
                                    [
                                        'label' => __('cms.read'),
                                        'route' => 'articles.index',
                                        'routTrash' => 'articles.trash',
                                        'routEdit' => 'articles.edit',
                                        'permission' => 'Read-Articles',
                                    ],
                                ],
                            ])
                        @endcanany
                        @canany(['Read-Comments', 'Delete-Comment'])
                            @include('cms.components.nav-item', [
                                'routeName' => 'getComments',
                                'icon' => 'fas fa-comment',
                                'label' => __('cms.comments'),
                            ])
                        @endcanany
                        @canany(['Read-Messages', 'Delete-Message'])
                            @include('cms.components.nav-item', [
                                'routeName' => 'getMessages',
                                'icon' => 'fas fa-envelope',
                                'label' => __('cms.messages'),
                            ])
                        @endcanany
                        <li class="nav-header">{{ __('cms.settins') }}</li>
                        @include('cms.components.nav-item', [
                            'routeName' => 'auth.editProfile',
                            'icon' => 'fas fa-user-edit',
                            'label' => __('cms.editProfile'),
                        ])
                        @include('cms.components.nav-item', [
                            'routeName' => 'auth.editPassword',
                            'icon' => 'fas fa-lock',
                            'label' => __('cms.editPassword'),
                        ])
                        @include('cms.components.nav-item', [
                            'routeName' => 'auth.logout',
                            'icon' => 'fas fa-sign-out-alt',
                            'label' => __('cms.logout'),
                        ])
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('main-title')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">@yield('breadcrumb-main')</a></li>
                                <li class="breadcrumb-item active">@yield('breadcrumb-sub')</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-{{ date('Y') }} <a href="https://adminlte.io">News Systm</a>.</strong>
            All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
    @yield('scripts')
</body>

</html>
