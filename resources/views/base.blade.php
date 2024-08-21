<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kasir || Wiro Dhul</title>
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>


    {{-- BOOTSTRAP --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- CSS --}}
    <link href="{{ asset('css/admin-genosstyle.css') }}" rel="stylesheet"/>

    {{-- FONT --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,700&display=swap"
        rel="stylesheet">

    {{-- DATA TABLES --}}
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"/>
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css"/>


    {{-- ICON --}}
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>


    {{-- SWEEET ALERT --}}
    {{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.min.css" --}}
    {{--          integrity="sha256-h2Gkn+H33lnKlQTNntQyLXMWq7/9XI2rlPCsLsVcUBs=" crossorigin="anonymous"> --}}
    <script src="{{ asset('js/swal.js') }}"></script>
    {{--    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script> --}}
    <link href="{{ asset('js/dropify/css/dropify.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/sweetalert2.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/sweetalert2.min.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

    @yield('morecss')

</head>

<body>

<div class="d-flex admin ">
    {{-- SIDEBAR --}}
    <div class="sidebar ">
        <div class="logo-container">
            <img class="company-logos" src="{{ asset('images/local/logo-yousee-panjang.png') }}"/>
            <img class="company-logos-minimize" src="{{ asset('images/local/logo-yousee.png') }}"/>
        </div>
        <div class="menu-container">
            <ul>
                @if(auth()->user()->role === 'owner')
                    <li>
                        <a class=" menu {{ request()->is('admin/pengguna*') ? 'active' : '' }} tooltip"
                           href="{{ route('admin.user') }}"><span
                                class="material-symbols-outlined">
                                person
                            </span>
                            <span class="text-menu"> Pengguna</span>
                            <span class="tooltiptext">Pengguna</span>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->role === 'admin')
                    <li>
                        <a class="menu tooltip {{ request()->is('admin/kategori*') ? 'active' : '' }}"
                           href="{{ route('admin.category') }}">
                            <span class="material-symbols-outlined">
                                label
                            </span>
                            <span class="text-menu"> Kategori</span>
                            <span class="tooltiptext">Kategori</span>
                        </a>
                    </li>
                    <li>
                        <a class="menu tooltip {{ request()->is('admin/menu*') ? 'active' : '' }}"
                           href="{{ route('admin.menu') }}">
                            <span class="material-symbols-outlined">
                                inventory_2
                            </span>
                            <span class="text-menu"> Menu</span>
                            <span class="tooltiptext">Menu</span>
                        </a>
                    </li>
                    <li>
                        <a class="menu tooltip {{ request()->is('admin/setting-diskon*') ? 'active' : '' }}"
                           href="{{ route('admin.discount') }}">
                            <span class="material-symbols-outlined">
                                attach_money
                            </span>
                            <span class="text-menu"> Setting Diskon</span>
                            <span class="tooltiptext">Setting Diskon</span>
                        </a>
                    </li>
                @endif
                @if(auth()->user()->role === 'cashier')
                    <li>
                        <a class=" menu {{ Request::is('kasir') ? 'active' : '' }} tooltip" href="/kasir"><span
                                class="material-symbols-outlined">
                                point_of_sale
                            </span>
                            <span class="text-menu"> Kasir</span>
                            <span class="tooltiptext">Kasir</span>
                        </a>
                    </li>

                    <li>
                        <a class="menu tooltip {{ Request::is('kasir/member') ? 'active' : '' }}"
                           href="{{ route('cashier.member') }}">
                            <span class="material-symbols-outlined">
                                group
                            </span>
                            <span class="text-menu"> Members</span>
                            <span class="tooltiptext">Members</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->role === 'cashier')
                    <li>
                        <a class="menu tooltip {{ request()->is('kasir/penjualan*') ? 'active' : '' }}"
                           href="{{ route('cashier.transaction') }}">
                            <span class="material-symbols-outlined">
                                shopping_bag
                            </span>
                            <span class="text-menu"> Penjualan</span>
                            <span class="tooltiptext">Penjualan</span>
                        </a>
                    </li>
                @endif

                @if(auth()->user()->role === 'admin')
                    <li>
                        <a class="menu tooltip {{ request()->is('admin/penjualan*') ? 'active' : '' }}"
                           href="{{ route('admin.transaction') }}">
                            <span class="material-symbols-outlined">
                                shopping_bag
                            </span>
                            <span class="text-menu"> Penjualan</span>
                            <span class="tooltiptext">Penjualan</span>
                        </a>
                    </li>
                @endif

                {{--                @if(auth()->user()->role === 'cashier')--}}
                {{--                    <li>--}}
                {{--                        <a class="menu tooltip {{ Request::is('kasir/tambahmenu') ? 'active' : '' }}"--}}
                {{--                           href="/kasir/tambahmenu">--}}


                {{--                            <span class="material-symbols-outlined">--}}
                {{--                                menu_book--}}
                {{--                            </span>--}}
                {{--                            <span class="text-menu"> Tambah Menu</span>--}}
                {{--                            <span class="tooltiptext">Tambah Menu</span>--}}
                {{--                        </a>--}}
                {{--                    </li>--}}

                {{--                    <li>--}}
                {{--                        <a class=" menu {{ Request::is('kasir/pengeluaran') ? 'active' : '' }} tooltip"--}}
                {{--                           href="/kasir/pengeluaran"><span class="material-symbols-outlined">--}}
                {{--                                outbound--}}
                {{--                            </span>--}}
                {{--                            <span class="text-menu"> Pengeluaran</span>--}}
                {{--                            <span class="tooltiptext">Pengeluaran</span>--}}
                {{--                        </a>--}}
                {{--                    </li>--}}
                {{--                @endif--}}

                @if(auth()->user()->role !== 'cashier')
                    <li>
                        <a class="menu tooltip {{ Request::is('kasir/laporanpengeluaran') ? 'active' : '' }}"
                           href="/kasir/laporanpengeluaran"><span class="material-symbols-outlined">
                                summarize
                            </span>
                            <span class="text-menu"> Laporan Penjualan </span>
                            <span class="tooltiptext">Laporan Penjualan </span>
                        </a>
                    </li>
                @endif

            </ul>

            <div class="footer">
                <p class="top">Login Sebagai</p>
                <p class="bot">Admin</p>
            </div>
        </div>
    </div>


    {{-- BODY --}}
    <div class="gen-body  ">

        {{-- BOTTOMBAR --}}
        <div class="bottombar">
            <a href="/admin/dashboard" class="nav-button {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <span class="material-symbols-outlined ">
                        dashboard
                    </span>
                <span class="text-menu"> Beranda</span>
            </a>
            <a href="/admin/datatitik" class="nav-button {{ Request::is('admin/datatitik') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">
                        desktop_windows
                    </span>
                <span class="text-menu"> Data Titik</span>
            </a>

            <a href="/admin/profile" class="nav-button {{ Request::is('admin/profile') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">
                        account_circle
                    </span>
                <span class="text-menu"> Profile</span>
            </a>

        </div>

        {{-- NAVBAR --}}
        <div class="gen-nav">
            <div class="start">
                <a class="nav-button">
                        <span class="iconfwd material-symbols-outlined">
                            arrow_forward
                        </span>
                    <span class="iconback material-symbols-outlined">
                            arrow_back
                        </span>
                </a>
            </div>
            <div class="end">


                <div class="dropdown">
                    <div class="profile-button">
                        <div class="content">

                            <a id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('images/local/account.jpg') }}"/>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <p class="user">User</p>
                                <p class="email">user@gmail.com</p>
                                <hr>
                                <a class="logout" href="/logout">Logout</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="gen-content">
            @yield('content')
        </div>

        <div class="bottom-mobile">

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{--    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.4/dist/sweetalert2.all.min.js" --}}
{{--            integrity="sha256-SrfCZ78qS4YeGNB8awBuKLepMKtLR86uP4oomyg4pUc=" crossorigin="anonymous"></script> --}}
<script type="text/javascript" src="{{ asset('js/debounce.js') }}"></script>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="{{ asset('js/admin-genosstyle.js') }}"></script>
<script src="{{ asset('js/dialog.js') }}"></script>
<script src="{{ asset('js/datatable.js') }}"></script>
<script src="{{ asset('js/dropify/js/dropify.js') }}"></script>


@yield('morejs')
<script type="text/javascript" src="{{ asset('js/debounceDefault.js') }}"></script>

</body>

</html>
