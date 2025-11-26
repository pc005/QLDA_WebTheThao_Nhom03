<!-- resources/views/bai_viet/show.blade.php -->
@extends('layouts.app') <!-- Kế thừa layout chính của bạn -->

@section('content')
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.min.css') }}">

    <div class="container">
        <!-- Tiêu đề và Nút Yêu Thích -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="bai-viet-title mb-0">{{ $baiViet->tieu_de }}</h1>

            @auth
                @php
                    // Lấy trạng thái yêu thích
                    $isFavorited = auth()->user()->hasFavorited($baiViet);
                @endphp

                {{-- NÚT LƯU THEO THIẾT KẾ MỚI --}}
                <button
                    id="toggle-favorite-btn"
                    data-id="{{ $baiViet->id }}"
                    data-type="{{ class_basename($baiViet) }}"
                    class="btn-save-style {{ $isFavorited ? 'is-saved' : '' }}"
                    title="{{ $isFavorited ? 'Xóa khỏi danh sách đã lưu' : 'Lưu bài viết' }}"
                >
                    {{-- Dùng 2 Icon để chuyển đổi qua CSS: far (Regular/Outline) và fas (Solid/Filled) --}}
                    <i class="bookmark-icon fa-bookmark {{ $isFavorited ? 'fas' : 'far' }}"></i>
                    <span class="bookmark-text">Lưu</span>
                </button>
            @endauth
        </div>
        <img class="bai-viet-image img-fluid" src="{{ $baiViet->anh_dai_dien }}" alt="{{ $baiViet->tieu_de }}">
        <p class="noi-dung">{{ $baiViet->noi_dung }}</p>

        <div class="text-muted mt-3">
            <small>Ngày tạo: {{ $baiViet->ngay_tao }}</small>
        </div>

        <style>
            /* Tiêu đề lớn hơn */
            .bai-viet-title {
                font-size: 2.2rem;
                /* tăng kích thước chữ */
                font-weight: bold;
                /* in đậm */
                margin-bottom: 1rem;
            }

            /* Ảnh nhỏ hơn */
            .bai-viet-image {
                max-width: 60%;
                /* ảnh chỉ chiếm 60% chiều rộng container */
                height: auto;
                /* giữ tỷ lệ gốc */
                display: block;
                margin: 0 auto;
                /* căn giữa */
                border-radius: 8px;
                /* bo góc nhẹ cho đẹp */
            }
            /* ==================================== */
            /* CSS MỚI CHO NÚT LƯU */
            /* ==================================== */
            .btn-save-style {
                /* Thiết kế chung */
                display: inline-flex;
                align-items: center;
                padding: 8px 15px;
                border: 1px solid #ddd;
                border-radius: 4px;
                background-color: #fff;
                color: #333;
                cursor: pointer;
                transition: background-color 0.2s, border-color 0.2s, color 0.2s;
            }
            .btn-save-style:hover {
                border-color: #007bff; /* Hover chuyển sang màu xanh */
            }
            .bookmark-icon {
                font-size: 1.2rem;
                margin-right: 5px;
                transition: color 0.2s;
            }
            .bookmark-text {
                font-size: 1rem;
                line-height: 1;
                color: #333;
                transition: color 0.2s;
            }

            /* TRẠNG THÁI CHƯA LƯU (OUTLINE STATE) */
            .btn-save-style:not(.is-saved) {
                border-color: #ccc;
            }
            .btn-save-style:not(.is-saved) .bookmark-icon {
                color: #999; /* Icon màu xám nhạt */
            }
            .btn-save-style:not(.is-saved):hover {
                border-color: #007bff;
            }
            .btn-save-style:not(.is-saved):hover .bookmark-icon {
                color: #007bff;
            }

            /* TRẠNG THÁI ĐÃ LƯU (SAVED STATE) */
            .btn-save-style.is-saved {
                border-color: #007bff;
                background-color: #f0f8ff; /* Nền xanh nhạt */
            }
            /* Đổi icon thành solid khi đã lưu */
            .btn-save-style.is-saved .bookmark-icon {
                color: #007bff; /* Icon màu xanh đậm */
            }

            /* SỬA LỖI FONT AWESOME CHO VIỆC CHUYỂN ĐỔI ICON */
            /* Logic chuyển đổi icon sẽ được xử lý bằng JavaScript: thêm/xóa class 'fas'/'far' */
        </style>
        <div>
            <!-- Share -->

            <div class="flex-s-s">
                <span class="f1-s-12 cl5 p-t-1 m-r-15">
                    Share:
                </span>


                @php
                    $url = url()->current(); // Lấy URL hiện tại
                @endphp

                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}"
                    class="dis-block f1-s-13 cl0 bg-facebook borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03"
                    target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-facebook-f m-r-7"></i>
                    Facebook
                </a>

                <a href="#"
                    class="dis-block f1-s-13 cl0 bg-twitter borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
                    <i class="fab fa-twitter m-r-7"></i>
                    Twitter
                </a>

                <a href="#"
                    class="dis-block f1-s-13 cl0 bg-google borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
                    <i class="fab fa-google-plus-g m-r-7"></i>
                    Google+
                </a>

                <a href="#"
                    class="dis-block f1-s-13 cl0 bg-pinterest borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
                    <i class="fab fa-pinterest-p m-r-7"></i>
                    Pinterest
                </a>
            </div>
            <!-- Leave a comment -->
            <div>
                <h4 class="f1-l-4 cl3 p-b-12">
                    Leave a Comment
                </h4>

                <p class="f1-s-13 cl8 p-b-40">
                    Your email address will not be published. Required fields are marked *
                </p>

                <form>
                    <textarea class="bo-1-rad-3 bocl13 size-a-15 f1-s-13 cl5 plh6 p-rl-18 p-tb-14 m-b-20" name="msg"
                        placeholder="Comment..."></textarea>

                    <input class="bo-1-rad-3 bocl13 size-a-16 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text" name="name"
                        placeholder="Name*">

                    <input class="bo-1-rad-3 bocl13 size-a-16 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text" name="email"
                        placeholder="Email*">

                    <input class="bo-1-rad-3 bocl13 size-a-16 f1-s-13 cl5 plh6 p-rl-18 m-b-20" type="text" name="website"
                        placeholder="Website">

                    <button class="size-a-17 bg2 borad-3 f1-s-12 cl0 hov-btn1 trans-03 p-rl-15 m-t-10">
                        Post Comment
                    </button>
                </form>
            </div>
        </div>


    </div>
    </div>
    </div>


    <style>
        .like-button {
            cursor: pointer;
            display: flex;
            align-items: center;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f0f0f0;
            transition: background-color 0.3s;
        }

        .like-button:hover {
            background-color: #0c0404;
        }

        .hidden {
            display: none;
        }

        #likeIcon {
            font-size: 24px;
            /* Kích thước biểu tượng */
            margin-right: 8px;
        }

        .ratio.ratio-21x9 {
            height: 600px;
            /* tăng chiều cao khung baiviet */
        }

        .ratio.ratio-21x9 iframe {
            width: 100%;
            height: 100%;
        }

        .container.mt-5 {
            max-width: 1200px;
            /* tăng chiều rộng tối đa */
        }

        h1 {
            font-size: 3rem;
            /* tăng kích thước chữ */
            font-weight: bold;
            /* chữ đậm */
            text-align: center;
            /* căn giữa */
            margin-bottom: 20px;
            /* khoảng cách dưới */
            color: #2c3e50;
            /* màu chữ đẹp hơn */
        }

        .ratio iframe {
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
    </div>
    <div class="row justify-content-center">
        @foreach ($articles->random(4) as $article)
            <div class="b col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <!-- Ảnh vuông -->
                    <a href="{{ route('bai-viet.show', $article->id) }}">
                        <img src="{{ asset($article['anh_dai_dien']) }}" class="card-img-top square-img"
                            alt="{{ $article['tieu_de'] }}">
                    </a>

                    <!-- Nội dung -->
                    <div class="card-body px-3 py-2">
                        <h5 class="card-title mb-2">
                            <a class="tieu_de" href="{{ route('bai-viet.show', $article->id) }}"
                                class="text-dark text-decoration-none">
                                {{ $article['tieu_de'] }}
                            </a>
                        </h5>
                        <p class="card-text text-muted">
                            {{ Str::limit($article['noi_dung'], 100) }}
                        </p>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer bg-white border-0 text-end text-muted small px-3">
                        {{ optional($article->created_at)->format('d/m/Y') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <style>
        .tieu_de {
            font-size: 1.2rem;
            font-weight: 600;
            color: #000000;
            text-decoration: none;
        }

        .b {
            max-width: 300px;
            max-height: 300px
        }

        .square-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            display: block;
            margin: 10px auto;
            /* căn giữa + khoảng cách */
        }

        .card {
            margin: 10px;
            /* mỗi bên 10px → tổng cách giữa card là 20px */
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .card-title a {
            color: #2c3e50 font-size: 1.1rem;
            font-weight: 600;
        }

        .card-text {
            font-size: 0.85rem;
            color: #666;
        }
    </style>

    {{-- Script AJAX/Fetch API (Sử dụng Fetch API) --}}
    @push('scripts')
        <script>
            // Bọc trong hàm đảm bảo DOM đã tải hoàn tất
            document.addEventListener('DOMContentLoaded', function() {
                const button = document.getElementById('toggle-favorite-btn');

                // KIỂM TRA LẦN 1: Nếu không tìm thấy nút (người dùng chưa đăng nhập), thoát
                if (!button) {
                    console.log('Nút Lưu không tìm thấy (Chưa đăng nhập hoặc lỗi DOM).');
                    return;
                }

                console.log('Nút Lưu đã được gắn sự kiện.'); // DEBUG THÀNH CÔNG

                button.addEventListener('click', function() {
                    const icon = button.querySelector('.bookmark-icon');
                    const itemId = button.dataset.id;
                    const itemType = button.dataset.type;

                    // LẤY CSRF TOKEN TỪ META TAG
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

                    // TẠM THỜI VÔ HIỆU HÓA NÚT KHI ĐANG XỬ LÝ
                    button.disabled = true;

                    // LOG THÔNG TIN GỬI ĐI ĐỂ DEBUG
                    console.log('Gửi AJAX:', { route: '{{ route('favorites.toggle') }}', id: itemId, type: itemType });

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
                        .then(response => {
                            // Xử lý lỗi HTTP (Ví dụ: 403 Forbidden, 500 Internal Server Error)
                            if (!response.ok) {
                                return response.json().then(error => { throw new Error(error.message || 'Lỗi từ máy chủ: ' + response.status); });
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Cập nhật trạng thái nút
                            if (data.is_favorited) {
                                button.classList.add('is-saved');
                                icon.classList.remove('far');
                                icon.classList.add('fas');
                                button.title = 'Xóa khỏi danh sách đã lưu';
                            } else {
                                button.classList.remove('is-saved');
                                icon.classList.remove('fas');
                                icon.classList.add('far');
                                button.title = 'Lưu bài viết';
                            }
                            console.log('Thành công:', data.message);
                        })
                        .catch(error => {
                            // Lỗi AJAX sẽ được hiển thị chi tiết hơn
                            console.error('Lỗi AJAX:', error);
                            alert('Có lỗi xảy ra khi thực hiện thao tác. Chi tiết: ' + error.message);
                        })
                        .finally(() => {
                            // KÍCH HOẠT LẠI NÚT DÙ THÀNH CÔNG HAY THẤT BẠI
                            button.disabled = false;
                        });
                });
            });
        </script>
    @endpush
@endsection
