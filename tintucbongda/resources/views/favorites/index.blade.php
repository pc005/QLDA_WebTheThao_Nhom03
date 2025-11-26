<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mục Yêu Thích Của Tôi - Tin Đã Lưu</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        body {
            background-color: #f8f8f8; /* Nền xám nhẹ */
        }
        .header-top {
            background-color: #ffffff;
            border-bottom: 1px solid #eee;
            padding: 10px 0;
            margin-bottom: 20px;
        }
        .sidebar-card {
            border-radius: 0;
            border: none;
            box-shadow: 0 1px 3px rgba(0,0,0,.1);
        }
        .avatar-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #e0e0e0;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        .list-group-flush .list-group-item {
            border-left: 3px solid transparent; /* Tạo không gian cho thanh màu */
        }
        .active-vnexpress-style {
            background-color: #f3f3f3 !important;
            border-left: 3px solid #007bff !important;
            color: #007bff !important;
            font-weight: 600;
        }

        /* Bố cục Tin đã lưu */
        .tin-da-luu-thumb {
            width: 120px;
            height: 80px;
            object-fit: cover;
        }
        .card-tin-da-luu {
            border: 1px solid #e9ecef;
            transition: box-shadow 0.2s;
            background-color: #fff;
            border-radius: 4px;
        }
        .card-tin-da-luu:hover {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .text-decoration-none:hover {
            color: #007bff !important;
        }
    </style>
</head>
<body>
<div class="container my-5">
    <div class="row">

        <div class="col-md-3">
            @auth
                <div class="card sidebar-card mb-4">
                    <div class="card-body p-4 border-bottom">
                        {{-- Avatar --}}
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-circle me-3 flex-shrink-0">
                                <i class="fas fa-user"></i>
                            </div>
                            {{-- Tên người dùng và tham gia --}}
                            <div>
                                <h6 class="fw-bold mb-0">{{ Auth::user()->ho_ten ?? 'Tài khoản' }}</h6>
                                <p class="text-muted small mb-0">Tham gia từ <span>{{ optional(Auth::user()->ngay_tao)->format('d/m/Y') ?? 'Chưa xác định' }}</span></p>
                            </div>
                        </div>
                    </div>

                    {{-- Menu Điều Hướng --}}
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action">Thông tin chung</a>
                        <a href="#" class="list-group-item list-group-item-action">Ý kiến của bạn (0)</a>
                        {{-- Link Hiện Tại --}}
                        <a href="{{ route('favorites.index') }}" class="list-group-item list-group-item-action active-vnexpress-style">
                            Tin đã lưu
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">Tin đã xem</a>
                        {{-- Nút Thoát --}}
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="list-group-item list-group-item-action text-danger mt-2">
                            <i class="fas fa-sign-out-alt me-2"></i> Thoát
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            @endauth
        </div>

        <div class="col-md-9">
            <h4 class="mb-4 pb-2 border-bottom fw-bold">Tin đã lưu</h4>

            @forelse ($favorites as $favorite)
                @php
                    $item = $favorite->favoritable;
                    if (!$item) continue;
                @endphp

                <div class="card-tin-da-luu mb-3 p-3 d-flex align-items-start">

                    {{-- Ảnh Đại Diện/Thumbnail --}}
                    <div class="me-3 flex-shrink-0">
                        @if ($item instanceof \App\Models\BaiViet)
                            <a href="{{ route('bai-viet.show', $item->id) }}">
                                <img src="{{ asset($item->anh_dai_dien ?? 'images/placeholder.jpg') }}" alt="{{ $item->tieu_de }}" class="img-fluid rounded-3 tin-da-luu-thumb">
                            </a>
                        @elseif ($item instanceof \App\Models\Video)
                            <a href="{{ route('video.show', $item->id) }}">
                                <img src="{{ asset('images/video_default.jpg') }}" alt="{{ $item->tieu_de }}" class="img-fluid rounded-3 tin-da-luu-thumb">
                            </a>
                        @endif
                    </div>

                    {{-- Tiêu Đề và Thông Tin --}}
                    <div class="flex-grow-1">
                        <h5 class="mb-1 fw-bold">
                            <a href="{{ ($item instanceof \App\Models\BaiViet) ? route('bai-viet.show', $item->id) : route('video.show', $item->id) }}" class="text-dark text-decoration-none">
                                {{ $item->tieu_de }}
                            </a>
                        </h5>

                        {{-- Thời gian và Thao tác (Tương tự VnExpress) --}}
                        <div class="d-flex align-items-center small text-muted mt-2">
                            <span class="me-3">{{ $favorite->created_at->format('H:i - d/m/Y') }}</span>

                            {{-- Nút Xóa/Bookmark Icon --}}
                            <a href="#" class="text-danger remove-favorite-js"
                               data-id="{{ $item->id }}" data-type="{{ class_basename($item) }}">
                                <i class="fas fa-bookmark me-1"></i> Xóa
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning text-center">
                    Bạn chưa lưu bất kỳ tin tức nào.
                </div>
            @endforelse

            {{-- Phân Trang --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $favorites->links() }}
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Lấy token CSRF từ meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    document.querySelectorAll('.remove-favorite-js').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            if (!confirm('Bạn có chắc muốn xóa mục này khỏi danh sách đã lưu?')) {
                return;
            }

            const itemId = this.dataset.id;
            const itemType = this.dataset.type;
            const listItem = this.closest('.card-tin-da-luu'); // Lấy card cha để xóa khỏi DOM

            fetch('{{ route('favorites.toggle') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    model_id: itemId,
                    model_type: itemType
                })
            })
                .then(response => response.json())
                .then(result => {
                    if (!result.is_favorited) {
                        // Xóa mục khỏi giao diện
                        listItem.remove();
                        // Tùy chọn: Cập nhật lại số lượng nếu cần
                    } else {
                        alert('Lỗi: Mục vẫn còn trong yêu thích.');
                    }
                })
                .catch(error => {
                    console.error('Lỗi:', error);
                    alert('Xảy ra lỗi khi xóa mục yêu thích.');
                });
        });
    });
</script>

</body>
</html>
