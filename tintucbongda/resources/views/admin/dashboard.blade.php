@extends('admin.layouts.admin')

@section('content')
<style>
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .dashboard-title {
        font-size: 26px;
        font-weight: 700;
        color: #1f2937;
    }

    .breadcrumbs {
        font-size: 14px;
        color: #6b7280;
    }

    /* CARD đẹp */
    .stat-card {
        background: #ffffff;
        border-radius: 18px;
        padding: 25px;
        box-shadow: 0 8px 18px rgba(0,0,0,0.06);
        transition: 0.25s;
        cursor: pointer;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.10);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: #fff;
    }

    .icon-news { background: #3b82f6; }
    .icon-video { background: #f59e0b; }
    .icon-user { background: #10b981; }
    .icon-category { background: #ef4444; }

    .stat-label {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 4px;
        font-weight: 500;
    }

    .stat-value {
        font-size: 26px;
        font-weight: 700;
        color: #111827;
    }
</style>

<div class="page-inner">

    <!-- HEADER -->
    <div class="dashboard-header">
        <h4 class="dashboard-title">Dashboard</h4>

        <div class="breadcrumbs">
            <i class="fas fa-home"></i> / Dashboard
        </div>
    </div>

    <!-- STAT CARDS -->
    <div class="row g-4">

        <!-- Bài viết -->
        <div class="col-sm-6 col-md-3">
            <div class="stat-card">
                <div class="d-flex align-items-center">
                    <div class="stat-icon icon-news">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="ms-3">
                        <div class="stat-label">Bài viết</div>
                        <div class="stat-value">{{ $tongBaiViet ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Video -->
        <div class="col-sm-6 col-md-3">
            <div class="stat-card">
                <div class="d-flex align-items-center">
                    <div class="stat-icon icon-video">
                        <i class="fas fa-video"></i>
                    </div>
                    <div class="ms-3">
                        <div class="stat-label">Video</div>
                        <div class="stat-value">{{ $tongVideo ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Người dùng -->
        <div class="col-sm-6 col-md-3">
            <div class="stat-card">
                <div class="d-flex align-items-center">
                    <div class="stat-icon icon-user">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="ms-3">
                        <div class="stat-label">Người dùng</div>
                        <div class="stat-value">{{ $tongNguoiDung ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Danh mục -->
        <div class="col-sm-6 col-md-3">
            <div class="stat-card">
                <div class="d-flex align-items-center">
                    <div class="stat-icon icon-category">
                        <i class="fas fa-list"></i>
                    </div>
                    <div class="ms-3">
                        <div class="stat-label">Danh mục</div>
                        <div class="stat-value">{{ $tongDanhMuc ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
