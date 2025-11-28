{{-- @extends('admin.layouts.admin')

@section('content')
<div class="page-inner">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h4 class="dashboard-title">Xem bài viết</h4>
        <div>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">Quay lại</a>
        </div>
    </div>

    <div class="p-4 card">
        <h3>{{ $post->tieu_de }}</h3>
        <p class="text-muted">Tác giả: {{ $post->user->ho_ten ?? 'N/A' }} — Danh mục: {{ $post->danhMuc->ten_danh_muc ?? 'N/A' }}</p>
        <hr>
        <div>
            {!! nl2br(e($post->noi_dung)) !!}
        </div>

        <div class="gap-2 mt-4 d-flex">
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
@endsection --}}
@extends('admin.layouts.admin')

@section('content')
<div class="page-inner">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h4 class="dashboard-title">Xem bài viết</h4>
        <div>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">Quay lại</a>
        </div>
    </div>

    <div class="p-4 card">

        {{-- Tiêu đề --}}
        <h3>{{ $post->tieu_de }}</h3>

        {{-- Thông tin --}}
        <p class="text-muted">
            Tác giả: {{ $post->user->ho_ten ?? 'N/A' }} —
            Danh mục: {{ $post->danhMuc->ten_danh_muc ?? 'N/A' }}
        </p>

        {{-- HÌNH ẢNH ĐẠI DIỆN --}}
        @if ($post->anh_dai_dien)
            <div class="my-4 text-center">
                <img src="{{ asset($post->anh_dai_dien) }}"
                     class="rounded shadow img-fluid"
                     style="max-height: 350px; object-fit: cover;">
            </div>
        @endif

        <hr>

        {{-- Nội dung --}}
        <div>
            {!! nl2br(e($post->noi_dung)) !!}
        </div>

        {{-- Nút duyệt --}}
        <div class="gap-2 mt-4 d-flex">
            @if ($post->trang_thai === 'Chờ duyệt')
                <button type="button" class="btn btn-success" onclick="confirmApprove({{ $post->id }})">Duyệt</button>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#rejectModal">Từ chối</button>
            @endif
        </div>

        <!-- Modal Từ chối -->
        <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectModalLabel">Từ chối bài viết: {{ $post->tieu_de }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.posts.reject', $post->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="ly_do_tu_choi" class="form-label">Lý do từ chối</label>
                                <textarea class="form-control" id="ly_do_tu_choi" name="ly_do_tu_choi" rows="4" required placeholder="Nhập lý do từ chối..."></textarea>
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
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmApprove(postId) {
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
</script>

@endsection
