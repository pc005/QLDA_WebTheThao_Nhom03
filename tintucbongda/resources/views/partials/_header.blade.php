<!DOCTYPE html>
<html lang="en">

<head>
    <title>Trang Tin Tức Bóng Đá</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
</head>

<body class="animsition">

    <!-- Header -->
    <header>
        <!-- Header desktop -->
        <div class="container-menu-desktop">
            <div class="topbar">
                <div class="container content-topbar h-100">
                    <div class="left-topbar">
                        <span class="left-topbar-item flex-wr-s-c">
                            <span>
                                {{-- New York, NY --}}
                            </span>

                            {{-- <img class="m-b-1 m-rl-8" src="images/icons/icon-night.png" alt="IMG"> --}}

                            <span>
                                {{-- HI 58° LO 56° --}}
                            </span>
                        </span>

                        <a href="#" class="left-topbar-item">
                            Về Chúng Tôi
                        </a>

                        <a href="#" class="left-topbar-item">
                            Liên Hệ
                        </a>
                        @if (Auth::check())
                            <span class="left-topbar-item">
                                Xin chào, {{ Auth::user()->ho_ten }}
                            </span>

                            <a href="{{ route('logout') }}" class="left-topbar-item"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Đăng xuất
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                            <a href="{{ route('login.show') }}" class="left-topbar-item">Đăng Nhập</a>
                            <a href="{{ route('register.show') }}" class="left-topbar-item">Đăng Kí</a>
                        @endif


                    </div>

                    <div class="right-topbar">
                        <a href="#">
                            <span class="fab fa-facebook-f"></span>
                        </a>

                        <a href="#">
                            <span class="fab fa-twitter"></span>
                        </a>

                        <a href="#">
                            <span class="fab fa-pinterest-p"></span>
                        </a>

                        <a href="#">
                            <span class="fab fa-vimeo-v"></span>
                        </a>

                        <a href="#">
                            <span class="fab fa-youtube"></span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="container wrap-logo">
                <!-- Logo desktop -->
                <div class="logo">
                    {{-- <a href="#"><img src="images/icons/logo-01.png" alt="LOGO"></a> --}}
                    <a href="/home"><img src="{{ asset('images/icons/logo-01.png') }}" alt="LOGO"></a>
                </div>

                <!-- Banner -->
                <div class="banner-header">
                    <a href="/home"><img src="{{ asset('images/banner-01.jpg') }}" alt="IMG"></a>
                </div>
            </div>

            <!--  -->
            <div class="wrap-main-nav">
                <div class="main-nav">
                    <!-- Menu desktop -->
                    <nav class="menu-desktop">
                        <a class="logo-stick" href="/home">
                            <img src="{{ asset('images/icons/logo-01.png') }}" alt="LOGO">
                        </a>

                        <ul class="main-menu">
                            <li>
                                <a href="/home">Home</a>
                                <ul class="sub-menu">
                                    <li><a href="/home">Homepage v1</a></li>
                                    <li><a href="home-02.html">Homepage v2</a></li>
                                    <li><a href="home-03.html">Homepage v3</a></li>
                                </ul>
                            </li>

                            @php
                                $categories = \App\Models\DanhMuc::all();
                            @endphp
                            @foreach ($categories as $category)
                                <li>
                                    <a href="#">{{ $category->ten_danh_muc }}</a>
                                </li>
                            @endforeach

                            <li class="mega-menu-item">
                                <a href="/videos">Video</a>
                                <div class="sub-mega-menu">
                                </div>
                            </li>





                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- Breadcrumb -->
    <div class="container">
        <div class="headline bg0 flex-wr-sb-c p-rl-20 p-tb-8">
            <div class="f2-s-1 p-r-30 m-tb-6">
                {{-- <a href="/home" class="breadcrumb-item f1-s-3 cl9">
                    Home
                </a>

                <a href="blog-list-01.html" class="breadcrumb-item f1-s-3 cl9">
                    Blog
                </a>

                <span class="breadcrumb-item f1-s-3 cl9">
                    Nulla non interdum metus non laoreet nisi tellus eget aliquam lorem pellentesque
                </span> --}}
            </div>

            <div class="pos-relative size-a-2 bo-1-rad-22 of-hidden bocl11 m-tb-6">
                <input class="f1-s-1 cl6 plh9 s-full p-l-25 p-r-45" type="text" name="search" placeholder="Search">
                <button class="flex-c-c size-a-1 ab-t-r fs-20 cl2 hov-cl10 trans-03">
                    <i class="zmdi zmdi-search"></i>
                </button>
            </div>
        </div>
    </div>
