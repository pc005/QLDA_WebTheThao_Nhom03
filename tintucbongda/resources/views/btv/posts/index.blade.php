@extends('btv.layouts.btv')

@section('title', 'Danh sách bài viết')

@section('content')
<style>
    .table-custom { border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    .table-custom thead { background: #f9fafb; }
    .badge-pending { background: #fbbf24; color: #111827; font-weight: 600; }
    .badge-approved { background: #10b981; color: white; font-weight: 600; }
    .badge-rejected { background: #ef4444; color: white; font-weight: 600; }
    .badge-draft { background: #6b7280; color: white; font-weight: 600; }
    .btn-sm { padding: 6px 12px; font-size: 13px; border-radius: 6px; }
    .action-btns { display: flex; gap: 6px; flex-wrap: wrap; }
</style>

<div class="page-inner">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h4 class="dashboard-title">Danh sách bài viết</h4>
        <a href="{{ route('btv.posts.create') }}" class="btn btn-primary btn-sm">+ Tạo bài viết</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card table-custom">
        <div class="table-responsive">
            <table class="table mb-0 table-hover">
                <thead>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 40%;">Tiêu đề</th>
                        <th style="width: 20%;">Danh mục</th>
                        <th style="width: 15%;">Trạng thái</th>
                        <th style="width: 20%;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <td class="text-muted">{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ substr($post->tieu_de, 0, 50) }}{{ strlen($post->tieu_de) > 50 ? '...' : '' }}</strong>
                                <br>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y H:i') }}</small>
                            </td>
                            <td>{{ $post->danhMuc->ten_danh_muc ?? 'N/A' }}</td>
                            <td>
                                @if ($post->trang_thai === 'Chờ duyệt')
                                    <span class="badge badge-pending">Chờ duyệt</span>
                                @elseif ($post->trang_thai === 'Đã duyệt')
                                    <span class="badge badge-approved">Đã duyệt</span>
                                @elseif ($post->trang_thai === 'Bị từ chối')
                                    <span class="badge badge-rejected">Bị từ chối</span>
                                    <br>
                                    <button type="button" class="mt-1 btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#reasonModal{{ $post->id }}">
                                        Xem lý do
                                    </button>
                                @elseif ($post->trang_thai === 'Nháp')
                                    <span class="badge badge-draft">Nháp</span>
                                @else
                                    <span class="badge bg-secondary">{{ $post->trang_thai }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('btv.posts.edit', $post->id) }}" class="btn btn-warning btn-sm" title="Sửa">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <form action="{{ route('btv.posts.delete', $post->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Xóa" onclick="return confirm('Xác nhận xóa bài viết này?')">
                                            <i class="fas fa-trash"></i> Xóa
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-muted">
                                <i class="fas fa-inbox" style="font-size: 32px;"></i>
                                <p class="mt-2">Bạn chưa tạo bài viết nào</p>
                                <a href="{{ route('btv.posts.create') }}" class="btn btn-primary btn-sm">Tạo bài viết ngay</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if ($posts->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $posts->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

<!-- Modals for rejection reasons -->
@foreach($posts as $post)
@if($post->trang_thai === 'Bị từ chối')
<div class="modal fade" id="reasonModal{{ $post->id }}" tabindex="-1" aria-labelledby="reasonModalLabel{{ $post->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reasonModalLabel{{ $post->id }}">Lý do từ chối: {{ $post->tieu_de }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{ $post->ly_do_tu_choi }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach

@endsection
