@extends('admin.layouts.admin')

@section('content')
<style>
    .table-custom { border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    .table-custom thead { background: #f9fafb; }
    .badge-pending { background: #fbbf24; color: #111827; font-weight: 600; }
    .badge-approved { background: #10b981; color: white; font-weight: 600; }
    .badge-rejected { background: #ef4444; color: white; font-weight: 600; }
    .btn-sm { padding: 6px 12px; font-size: 13px; border-radius: 6px; }
    .action-btns { display: flex; gap: 8px; }
</style>

<div class="page-inner">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h4 class="dashboard-title">Quản lý bài viết</h4>
        <div>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary btn-sm">+ Tạo bài viết</a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card table-custom">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 30%;">Tiêu đề</th>
                        <th style="width: 15%;">Tác giả</th>
                        <th style="width: 15%;">Danh mục</th>
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
                            <td>
                                {{ $post->user->ho_ten ?? 'N/A' }}
                                <br>
                                <small class="badge bg-secondary">{{ $post->user->vai_tro ?? 'N/A' }}</small>
                            </td>
                            <td>{{ $post->danhMuc->ten_danh_muc ?? 'N/A' }}</td>
                            <td>
                                @if ($post->trang_thai === 'Chờ duyệt')
                                    <span class="badge badge-pending">Chờ duyệt</span>
                                @elseif ($post->trang_thai === 'Đã duyệt')
                                    <span class="badge badge-approved">Đã duyệt</span>
                                @elseif ($post->trang_thai === 'Từ chối')
                                    <span class="badge badge-rejected">Từ chối</span>
                                @else
                                    <span class="badge bg-secondary">{{ $post->trang_thai }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-info btn-sm" title="Xem">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if ($post->trang_thai === 'Chờ duyệt')
                                        <form action="{{ route('admin.posts.approve', $post->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" title="Duyệt" onclick="return confirm('Xác nhận duyệt bài viết này?')">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.posts.reject', $post->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm" title="Từ chối" onclick="return confirm('Xác nhận từ chối bài viết này?')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-warning btn-sm" title="Sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Xóa" onclick="return confirm('Xác nhận xóa bài viết này?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="fas fa-inbox" style="font-size: 32px;"></i>
                                <p class="mt-2">Chưa có bài viết nào</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if ($posts->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $posts->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

@endsection
