@extends('admin.layouts.admin')

@section('content')
<div class="page-inner">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h4 class="dashboard-title">Xem bài viết</h4>
        <div>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">Quay lại</a>
        </div>
    </div>

    <div class="card p-4">
        <h3>{{ $post->tieu_de }}</h3>
        <p class="text-muted">Tác giả: {{ $post->user->ho_ten ?? 'N/A' }} — Danh mục: {{ $post->danhMuc->ten_danh_muc ?? 'N/A' }}</p>
        <hr>
        <div>
            {!! nl2br(e($post->noi_dung)) !!}
        </div>

        <div class="mt-4 d-flex gap-2">
            @if ($post->trang_thai === 'Chờ duyệt')
                <form action="{{ route('admin.posts.approve', $post->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-success">Duyệt</button>
                </form>
                <form action="{{ route('admin.posts.reject', $post->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-warning">Từ chối</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
