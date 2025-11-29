<!-- resources/views/bai_viet/show.blade.php -->
@extends('layouts.app')

@section('content')
<link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.png') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/util.min.css') }}">

<div class="container">
    <h1 class="bai-viet-title">{{ $baiViet->tieu_de }}</h1>

    @php
        $imagePath = $baiViet->anh_dai_dien;
        if (!empty($imagePath)) {
            if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                $imageUrl = $imagePath;
            } elseif (str_starts_with($imagePath, public_path())) {
                $relativePath = str_replace(public_path(), '', $imagePath);
                $relativePath = str_replace('\\', '/', $relativePath);
                $imageUrl = asset(ltrim($relativePath, '/'));
            } else {
                $imageUrl = asset($imagePath);
            }
        } else {
            $imageUrl = asset('images/no-image.png');
        }
    @endphp

    <img class="bai-viet-image" src="{{ $imageUrl }}" alt="{{ $baiViet->tieu_de }}">
    <p class="noi-dung">{{ $baiViet->noi_dung }}</p>

    <div class="mt-3 text-muted">
        <small>Ngày tạo: {{ $baiViet->ngay_tao }}</small>
    </div>

    <style>
        .bai-viet-title {
            font-size: 2.2rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .bai-viet-image {
            max-width: 60%;
            height: auto;
            display: block;
            margin: 0 auto;
            border-radius: 8px;
        }
        .zalo { background-color: #0068ff; }
    </style>

    <div>
        <!-- Share -->
        <div class="flex-s-s">
            <span class="f1-s-12 cl5 p-t-1 m-r-15">Share:</span>

            @php $url = url()->current(); @endphp

            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}"
                class="dis-block f1-s-13 cl0 bg-facebook borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03"
                target="_blank" rel="noopener noreferrer">
                <i class="fab fa-facebook-f m-r-7"></i> Facebook
            </a>

            <a href="https://zalo.me/share?url={{ urlencode($url) }}"
                class="zalo dis-block f1-s-13 cl0 bg-zalo borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03"
                target="_blank" rel="noopener noreferrer">
                <i class="fas fa-share-alt m-r-7"></i> Zalo
            </a>

            <!-- Nút Báo cáo - chỉ hiển thị nếu đã đăng nhập -->
            @if(Auth::check())
                <button type="button" class="dis-block f1-s-13 cl0 bg-danger borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03"
                        onclick="showReportPopup({{ $baiViet->id }})">
                    <i class="fas fa-flag m-r-7"></i> Báo cáo
                </button>
            @else
                <a href="{{ route('login.show') }}" class="dis-block f1-s-13 cl0 bg-warning borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
                    <i class="fas fa-sign-in-alt m-r-7"></i> Đăng nhập để báo cáo
                </a>
            @endif
        </div>

        <!-- Comment Section -->
        <div class="mt-4">
            <h4 class="f1-l-4 cl3 p-b-12">Leave a Comment</h4>
            <p class="f1-s-13 cl8 p-b-40">
                Your email address will not be published. Required fields are marked *
            </p>

            <form>
                <textarea class="bo-1-rad-3 bocl13 size-a-15 f1-s-13 cl5 plh6 p-rl-18 p-tb-14 m-b-20"
                          name="msg" placeholder="Comment..."></textarea>
                <input class="bo-1-rad-3 bocl13 size-a-16 f1-s-13 cl5 plh6 p-rl-18 m-b-20"
                       type="text" name="name" placeholder="Name*">
                <input class="bo-1-rad-3 bocl13 size-a-16 f1-s-13 cl5 plh6 p-rl-18 m-b-20"
                       type="text" name="email" placeholder="Email*">
                <input class="bo-1-rad-3 bocl13 size-a-16 f1-s-13 cl5 plh6 p-rl-18 m-b-20"
                       type="text" name="website" placeholder="Website">
                <button class="size-a-17 bg2 borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-10">
                    Post Comment
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Bài viết liên quan -->
<div class="container mt-5">
    <h3 class="mb-4 text-center">Bài viết liên quan</h3>
    <div class="row justify-content-center">
        @foreach ($articles->random(4) as $article)
            <div class="mb-4 col-md-3">
                <div class="shadow-sm card h-100">
                    <a href="{{ route('bai-viet.show', $article->id) }}">
                        @php
                            $imgPath = $article->anh_dai_dien;
                            if (!empty($imgPath)) {
                                if (filter_var($imgPath, FILTER_VALIDATE_URL)) {
                                    $imgUrl = $imgPath;
                                } elseif (str_starts_with($imgPath, public_path())) {
                                    $relPath = str_replace(public_path(), '', $imgPath);
                                    $relPath = str_replace('\\', '/', $relPath);
                                    $imgUrl = asset(ltrim($relPath, '/'));
                                } else {
                                    $imgUrl = asset($imgPath);
                                }
                            } else {
                                $imgUrl = asset('images/no-image.png');
                            }
                        @endphp
                        <img src="{{ $imgUrl }}" class="card-img-top" style="height: 150px; object-fit: cover;" alt="{{ $article->tieu_de }}">
                    </a>

                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('bai-viet.show', $article->id) }}" class="text-decoration-none text-dark">
                                {{ Str::limit($article->tieu_de, 50) }}
                            </a>
                        </h5>
                        <p class="card-text text-muted small">
                            {{ Str::limit($article->noi_dung, 80) }}
                        </p>
                    </div>

                    <div class="card-footer text-muted small">
                        {{ optional($article->created_at)->format('d/m/Y') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
function showReportPopup(postId) {
    Swal.fire({
        title: 'Báo cáo bài viết',
        html: `
            <div class="text-start">
                <div class="mb-3">
                    <label for="swal-ly_do" class="form-label">Lý do báo cáo <span class="text-danger">*</span></label>
                    <select class="form-select" id="swal-ly_do" required>
                        <option value="">-- Chọn lý do --</option>
                        <option value="Nội dung không phù hợp">Nội dung không phù hợp</option>
                        <option value="Spam">Spam</option>
                        <option value="Vi phạm bản quyền">Vi phạm bản quyền</option>
                        <option value="Thông tin sai lệch">Thông tin sai lệch</option>
                        <option value="Khác">Khác</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="swal-mo_ta" class="form-label">Mô tả chi tiết (tùy chọn)</label>
                    <textarea class="form-control" id="swal-mo_ta" rows="3" placeholder="Mô tả thêm về lý do báo cáo..."></textarea>
                </div>
            </div>
        `,
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Gửi báo cáo',
        cancelButtonText: 'Hủy',
        preConfirm: () => {
            const ly_do = document.getElementById('swal-ly_do').value;
            const mo_ta = document.getElementById('swal-mo_ta').value;

            if (!ly_do) {
                Swal.showValidationMessage('Vui lòng chọn lý do báo cáo');
                return false;
            }

            return { ly_do, mo_ta };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the report
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/bai-viet/${postId}/report`;

            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);

            const lyDoInput = document.createElement('input');
            lyDoInput.type = 'hidden';
            lyDoInput.name = 'ly_do';
            lyDoInput.value = result.value.ly_do;
            form.appendChild(lyDoInput);

            const moTaInput = document.createElement('input');
            moTaInput.type = 'hidden';
            moTaInput.name = 'mo_ta';
            moTaInput.value = result.value.mo_ta;
            form.appendChild(moTaInput);

            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>

@endsection
