<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font + Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Bootstrap -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f5f6fa;
            display: flex;
            margin: 0;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: #1f2430;
            height: 100vh;
            color: #fff;
            padding: 25px 0;
            position: fixed;
            left: 0;
            top: 0;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.15);
            overflow-y: auto;
        }

        .sidebar h3 {
            text-align: center;
            font-weight: 700;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        .section-title {
            font-size: 13px;
            color: #9ca3af;
            text-transform: uppercase;
            margin-left: 20px;
            margin-top: 15px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .sidebar a {
            color: #c9c9c9;
            text-decoration: none;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            border-radius: 8px;
            margin: 2px 10px;
            transition: 0.25s;
        }

        .sidebar a:hover {
            background: #2c3242;
            color: #fff;
        }

        .sidebar .active {
            background: #3c4154;
            color: #fff;
        }

        /* Sub-item */
        .sub-item {
            padding-left: 55px;
            font-size: 14px;
            padding-top: 6px;
            padding-bottom: 6px;
            color: #bfbfbf;
        }

        .sub-item:hover {
            color: #fff;
        }

        /* HEADER */
        .header {
            height: 60px;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            position: fixed;
            left: 250px;
            right: 0;
            top: 0;
            display: flex;
            align-items: center;
            padding: 0 25px;
            z-index: 10;
        }

        .header h5 {
            margin: 0;
            font-weight: 600;
        }

        .header img {
            object-fit: cover;
        }

        /* CONTENT */
        .content {
            flex: 1;
            margin-left: 250px;
            padding: 90px 30px 30px;
            background: #f5f6fa;
            min-height: calc(100vh - 60px);
        }

        /* FOOTER */
        .footer {
            position: fixed;
            bottom: 0;
            left: 250px;
            right: 0;
            height: 50px;
            background: #ffffff;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: center; /* căn giữa chữ */
            align-items: center;
            padding: 0 30px;
            font-size: 14px;
            color: #555;
            box-shadow: 0 -2px 8px rgba(0,0,0,0.05);
            z-index: 5;
        }

        .shadow-top {
            box-shadow: 0 -2px 8px rgba(0,0,0,0.05);
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h3>Admin Panel</h3>

        <div class="section-title">Tổng quan</div>

        <a href="{{ route('admin.dashboard') }}"
            class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-pie"></i> Dashboard
        </a>

        <div class="section-title">Quản lý nội dung</div>

        <!-- Bài viết -->
        <a data-bs-toggle="collapse" href="#postsMenu">
            <i class="fa-solid fa-newspaper"></i> Bài viết
            <i class="fa-solid fa-chevron-down ms-auto"></i>
        </a>
        <div class="collapse" id="postsMenu">
            <a class="sub-item" href="#">Danh sách bài viết</a>
            <a class="sub-item" href="#">Thêm bài viết</a>
        </div>

        <!-- Danh mục -->
        <a data-bs-toggle="collapse" href="#categoryMenu">
            <i class="fa-solid fa-list"></i> Danh mục
            <i class="fa-solid fa-chevron-down ms-auto"></i>
        </a>
        <div class="collapse" id="categoryMenu">
            <a class="sub-item">Danh sách danh mục</a>
            <a class="sub-item">Thêm danh mục</a>
        </div>

        <!-- Video -->
        <a data-bs-toggle="collapse" href="#videoMenu">
            <i class="fa-solid fa-video"></i> Video
            <i class="fa-solid fa-chevron-down ms-auto"></i>
        </a>
        <div class="collapse" id="videoMenu">
            <a class="sub-item">Danh sách video</a>
            <a class="sub-item">Thêm video</a>
        </div>

        <!-- Banner -->
        <a data-bs-toggle="collapse" href="#bannerMenu">
            <i class="fa-solid fa-images"></i> Banner
            <i class="fa-solid fa-chevron-down ms-auto"></i>
        </a>
        <div class="collapse" id="bannerMenu">
            <a class="sub-item">Danh sách Banner</a>
            <a class="sub-item">Thêm Banner</a>
        </div>

        <div class="section-title">Quản lý tài khoản</div>

        <a data-bs-toggle="collapse" href="#userMenu">
            <i class="fa-solid fa-user"></i> Người dùng
            <i class="fa-solid fa-chevron-down ms-auto"></i>
        </a>
        <div class="collapse" id="userMenu">
            <a class="sub-item">Danh sách người dùng</a>
            <a class="sub-item">Thêm người dùng</a>
        </div>

    </div>

    <!-- HEADER -->
    <div class="px-4 shadow-sm header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Admin Dashboard</h5>

        <div class="d-flex align-items-center">
            <!-- Notification icon -->
            <button class="btn btn-light position-relative me-3">
                <i class="fa-solid fa-bell"></i>
                <span class="top-0 position-absolute start-100 translate-middle badge rounded-pill bg-danger">
                    3
                </span>
            </button>

            <!-- Avatar + Dropdown -->
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    @php $user = Auth::user(); @endphp
                    @if($user && $user->anh_dai_dien)
                        <img src="{{ asset($user->anh_dai_dien) }}" alt="Avatar" class="rounded-circle me-2" width="40" height="40">
                    @else
                        <img src="https://i.pravatar.cc/40?u={{ optional($user)->id ?? '' }}" alt="Avatar" class="rounded-circle me-2" width="40" height="40">
                    @endif
                    <span class="d-none d-sm-inline">{{ $user->ho_ten ?? ($user->email ?? 'Tài khoản') }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="#">Hồ sơ</a></li>
                    <li><a class="dropdown-item" href="#">Cài đặt</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">Đăng xuất</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

    <!-- FOOTER -->
    <div class="px-4 footer d-flex align-items-center shadow-top">
        <span>© 2025 - Admin Dashboard by Tân. All rights reserved.</span>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
