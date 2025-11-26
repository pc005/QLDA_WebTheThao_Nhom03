@extends('btv.layouts.btv')

@section('title', 'BTV Dashboard')

@section('content')
<style>
    .stat-card { background: #ffffff; border-radius: 12px; padding: 20px; box-shadow: 0 8px 18px rgba(0,0,0,0.06); }
    .stat-icon { width: 52px; height: 52px; border-radius: 12px; display:flex; align-items:center; justify-content:center; color:#fff; }
    .icon-post { background:#3b82f6; }
    .icon-approved { background:#10b981; }
    .icon-pending { background:#f59e0b; }
</style>

<div class="page-inner">
    <div class="dashboard-header mb-4 d-flex justify-content-between align-items-center">
        <h4 class="dashboard-title">BTV Dashboard</h4>
        <div class="breadcrumbs"><i class="fas fa-home"></i> / BTV</div>
    </div>

    <div class="row g-4">
        <div class="col-sm-6 col-md-4">
            <div class="stat-card d-flex align-items-center gap-3">
                <div class="stat-icon icon-post"><i class="fas fa-newspaper fa-lg"></i></div>
                <div>
                    <div class="stat-label">Tổng bài viết</div>
                    <div class="stat-value h4 mb-0">{{ $totalPosts ?? 0 }}</div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="stat-card d-flex align-items-center gap-3">
                <div class="stat-icon icon-approved"><i class="fas fa-check fa-lg"></i></div>
                <div>
                    <div class="stat-label">Bài viết đã duyệt</div>
                    <div class="stat-value h4 mb-0">{{ $approved ?? 0 }}</div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="stat-card d-flex align-items-center gap-3">
                <div class="stat-icon icon-pending"><i class="fas fa-hourglass-half fa-lg"></i></div>
                <div>
                    <div class="stat-label">Bài chờ duyệt</div>
                    <div class="stat-value h4 mb-0">{{ $pending ?? 0 }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('btv.posts.create') }}" class="btn btn-primary">Tạo bài viết mới</a>
        <a href="{{ route('btv.posts.index') }}" class="btn btn-outline-secondary ms-2">Danh sách bài viết</a>
    </div>

</div>

@endsection
