@extends('admin.layouts.admin')

@section('content')
<style>
    .table-custom { border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    .table-custom thead { background: #f9fafb; }
    .badge-approved { background: #10b981; color: white; font-weight: 600; }
    .btn-sm { padding: 6px 12px; font-size: 13px; border-radius: 6px; }
    .action-btns { display: flex; gap: 8px; }
</style>

<div class="page-inner">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h4 class="dashboard-title">Danh sách bài viết nổi bật</h4>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">Quay lại</a>
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
                                @if ($post->trang_thai === 'Đã duyệt')
                                    <span class="badge badge-approved">Đã duyệt</span>
                                @else
                                    <span class="badge bg-secondary">{{ $post->trang_thai }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-info btn-sm" title="Xem">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-secondary btn-sm" title="Bỏ nổi bật" onclick="removeFeatured({{ $post->id }})">
                                        <i class="fas fa-star"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 text-center text-muted">
                                <i class="fas fa-star" style="font-size: 32px;"></i>
                                <p class="mt-2">Chưa có bài viết nổi bật nào</p>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function removeFeatured(postId) {
    Swal.fire({
        title: 'Xác nhận bỏ nổi bật?',
        text: "Bài viết sẽ bị xóa khỏi danh sách nổi bật và không hiển thị ở trang chủ!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#6c757d',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Bỏ nổi bật',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the remove featured form
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
            featuredInput.value = 0;
            form.appendChild(csrf);
            form.appendChild(featuredInput);
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>

@endsection
