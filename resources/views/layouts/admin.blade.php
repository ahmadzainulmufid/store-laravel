<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    @stack('prepend-style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="/style/main.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/v/bs5/dt-2.3.2/datatables.min.css" rel="stylesheet"
        integrity="sha384-nt2TuLL4RlRQ9x6VTFgp009QD7QLRCYX17dKj9bj51w2jtWUGFMVTveRXfdgrUdx" crossorigin="anonymous">
    @stack('addon-style')
</head>

<body>
    <div class="page-dashboard">
        <div class="d-flex" id="wrapper" data-aos="fade-right">
            <!-- Sidebar -->
            <div class="border-right" id="sidebar-wrapper">
                <div class="sidebar-heading text-center">
                    <img src="/images/admin.png" alt="adminLogo" class="my-4" style="max-width: 150px" />
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('admin.dashboard') }}"
                        class="list-group-item list-group-item-action {{ request()->is('admin') ? 'active' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.product.index') }}"
                        class="list-group-item list-group-item-action {{ request()->is('admin/product') ? 'active' : '' }}">
                        Products
                    </a>
                    <a href="{{ route('admin.product-gallery.index') }}"
                        class="list-group-item list-group-item-action {{ request()->is('admin/product-gallery*') ? 'active' : '' }}">
                        Gallery
                    </a>
                    <a href="{{ route('admin.category.index') }}"
                        class="list-group-item list-group-item-action {{ request()->is('admin/category*') ? 'active' : '' }}">
                        Categories
                    </a>
                    <a href="{{ route('admin.transaction.index') }}"
                        class="list-group-item list-group-item-action {{ request()->is('admin/transaction') ? 'active' : '' }}">
                        Transactions
                    </a>
                    <a href="{{ route('admin.user.index') }}"
                        class="list-group-item list-group-item-action {{ request()->is('admin/user*') ? 'active' : '' }}">
                        Users
                    </a>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="list-group-item list-group-item-action">
                        Sign Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top" data-aos="fade-down">
                    <div class="container-fluid">
                        <button class="btn btn-secondary d-md-none mr-auto mr-2" id="menu-toggle">
                            &laquo; Menu
                        </button>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupprotedContent">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupprotedContent">
                            <!-- Desktop Menu -->
                            <ul class="navbar-nav d-none d-lg-flex ml-auto">
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link" id="navbarDropdown" role="button"
                                        data-toggle="dropdown">
                                        <img src="/images/icon-user.png" alt="user"
                                            class="rounded-circle mr-2 profile-picture" />
                                        Hi, {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu">
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();"
                                            class="dropdown-item">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>

                            <!-- Mobile Menu -->
                            <ul class="navbar-nav d-block d-lg-none">
                                <li class="nav-item">
                                    <a href="#" class="nav-link"> Hi, {{ Auth::user()->name }} </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                {{-- content --}}
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    @stack('prepend-script')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.3.2/datatables.min.js"
        integrity="sha384-rL0MBj9uZEDNQEfrmF51TAYo90+AinpwWp2+duU1VDW/RG7flzbPjbqEI3hlSRUv" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    @stack('addon-script')
</body>

</html>
