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
            <table class="table mb-0 table-hover">
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
                                @elseif ($post->trang_thai === 'Bị từ chối')
                                    <span class="badge badge-rejected">Bị từ chối</span>
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
                                        <button type="button" class="btn btn-success btn-sm" title="Duyệt" onclick="confirmApproveFromList({{ $post->id }})">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm" title="Từ chối" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $post->id }}">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    @endif
                                    @if ($post->trang_thai === 'Đã duyệt')
                                        @if ($post->noi_bat == 1)
                                            <button type="button" class="btn btn-secondary btn-sm" title="Bỏ nổi bật" onclick="toggleFeatured({{ $post->id }}, 0)">
                                                <i class="fas fa-star"></i>
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-warning btn-sm" title="Đánh dấu nổi bật" onclick="toggleFeatured({{ $post->id }}, 1)">
                                                <i class="far fa-star"></i>
                                            </button>
                                        @endif
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
                            <td colspan="6" class="py-4 text-center text-muted">
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
        <div class="mt-4 d-flex justify-content-center">
            {{ $posts->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

<!-- Modals for rejection -->
@foreach($posts as $post)
<div class="modal fade" id="rejectModal{{ $post->id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $post->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModalLabel{{ $post->id }}">Từ chối bài viết: {{ $post->tieu_de }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.posts.reject', $post->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="ly_do_tu_choi{{ $post->id }}" class="form-label">Lý do từ chối</label>
                        <textarea class="form-control" id="ly_do_tu_choi{{ $post->id }}" name="ly_do_tu_choi" rows="4" required placeholder="Nhập lý do từ chối bài viết..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-danger">Từ chối bài viết</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmApproveFromList(postId) {
    Swal.fire({
        title: 'Xác nhận duyệt bài viết?',
        text: "Bài viết sẽ được duyệt và xuất bản!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Duyệt',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the approve form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/posts/${postId}/approve`;
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);
            document.body.appendChild(form);
            form.submit();
        }
    });
}

function toggleFeatured(postId, featured) {
    const action = featured ? 'đánh dấu nổi bật' : 'bỏ nổi bật';
    const confirmText = featured ? 'Bài viết sẽ được hiển thị ở trang chủ!' : 'Bài viết sẽ bị xóa khỏi danh sách nổi bật!';

    Swal.fire({
        title: `Xác nhận ${action} bài viết?`,
        text: confirmText,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: featured ? '#ffc107' : '#6c757d',
        cancelButtonColor: '#6c757d',
        confirmButtonText: featured ? 'Đánh dấu nổi bật' : 'Bỏ nổi bật',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the toggle featured form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/posts/${postId}/toggle-featured`;
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            const featuredInput = document.createElement('input');
            featuredInput.type = 'hidden';
            featuredInput.name = 'featured';
            featuredInput.value = featured;
            form.appendChild(csrf);
            form.appendChild(featuredInput);
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>

@endsection
