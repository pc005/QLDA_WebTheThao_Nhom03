<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap + FontAwesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 260px;
            background: #1a2035;
            color: #fff;
            padding-top: 20px;
        }
        .sidebar a {
            color: #d1d1d1;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
        }
        .sidebar a:hover, .sidebar .active {
            background: #2a3355;
            color: #fff;
        }
        .content {
            width: 100%;
            background: #f1f1f1;
            padding: 20px;
        }
        .sidebar .nav .nav-item > a {
            cursor: pointer;
        }
        .sub-item { padding-left: 20px; display: block; }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h4 class="mb-4 text-center">- Admin -</h4>

        <ul class="nav flex-column nav-secondary">

            <!-- Dashboard -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#dashboard">
                    <i class="fas fa-home"></i>
                    <span> Dashboard</span>
                </a>

                <div class="collapse {{ request()->routeIs('admin.dashboard') ? 'show' : '' }}" id="dashboard">
                    <a class="sub-item" href="{{ route('admin.dashboard') }}">Thống kê chung</a>
                </div>
            </li>

            <!-- Bài viết -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#post">
                    <i class="fas fa-newspaper"></i>
                    <span> Bài viết</span>
                </a>

                <div class="collapse {{ request()->routeIs('admin.posts.*') ? 'show' : '' }}" id="post">
                    <a class="sub-item" href="{{ route('admin.posts.index') }}">Danh sách bài viết</a>
                    <a class="sub-item" href="{{ route('admin.posts.create') }}">Thêm bài viết</a>
                </div>
            </li>

            <!-- Danh mục -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#category">
                    <i class="fas fa-list"></i>
                    <span> Danh mục bài viết</span>
                </a>

                <div class="collapse {{ request()->routeIs('admin.categories.*') ? 'show' : '' }}" id="category">
                    <a class="sub-item" href="{{ route('admin.categories.index') }}">Danh sách danh mục</a>
                    <a class="sub-item" href="{{ route('admin.categories.create') }}">Thêm danh mục</a>
                </div>
            </li>

            <!-- Video -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#video">
                    <i class="fas fa-video"></i>
                    <span> Video</span>
                </a>

                <div class="collapse {{ request()->routeIs('admin.videos.*') ? 'show' : '' }}" id="video">
                    <a class="sub-item" href="{{ route('admin.videos.index') }}">Danh sách video</a>
                    <a class="sub-item" href="{{ route('admin.videos.create') }}">Thêm video</a>
                </div>
            </li>

            <!-- Banner -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#banner">
                    <i class="fas fa-image"></i>
                    <span> Banner</span>
                </a>

                <div class="collapse {{ request()->routeIs('admin.banners.*') ? 'show' : '' }}" id="banner">
                    <a class="sub-item" href="{{ route('admin.banners.index') }}">Danh sách Banner</a>
                    <a class="sub-item" href="{{ route('admin.banners.create') }}">Thêm Banner</a>
                </div>
            </li>

            <!-- Người dùng -->
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#user">
                    <i class="fas fa-user"></i>
                    <span> Người dùng</span>
                </a>

                <div class="collapse {{ request()->routeIs('admin.users.*') ? 'show' : '' }}" id="user">
                    <a class="sub-item" href="{{ route('admin.users.index') }}">Danh sách người dùng</a>
                    <a class="sub-item" href="{{ route('admin.users.create') }}">Thêm người dùng</a>
                </div>
            </li>

        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div class="content">
        <div class="container">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
