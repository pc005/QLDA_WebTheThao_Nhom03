@extends('layouts.app')

@section('content')

    <head>
        <title>TITLE CỦA BÀI VIẾT</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Thẻ Open Graph -->
        {{-- <meta property="og:tieu_de" content="Tiêu đề của Bài Viết" />
        <meta property="og:description" content="Mô tả ngắn về bài viết." />
        <meta property="og:image" content="{{ asset('images/your-image-url.jpg') }}" /> <!-- Đường dẫn ảnh đại diện -->
        <meta property="og:url" content="{{ url()->current() }}" /> <!-- Đường dẫn hiện tại -->
        <meta property="og:type" content="video" /> <!-- Kiểu nội dung --> --}}

        <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
        <!-- Các thẻ link khác -->
    </head>

    <div class="container mt-5">
        <h1>{{ $video->tieu_de }}</h1>

        <div class="ratio ratio-21x9 mb-4">
            {!! $video->url !!}
        </div>
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

            <a href="#" class="dis-block f1-s-13 cl0 bg-twitter borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
                <i class="fab fa-twitter m-r-7"></i>
                Twitter
            </a>

            {{-- <a href="#" class="dis-block f1-s-13 cl0 bg-google borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03">
                <i class="fab fa-google-plus-g m-r-7"></i>
                Google+
            </a> --}}


            <!-- Nút Like -->
            {{-- <div class="mt-4">
                <button id="likeButton" class="like-button">
                    <i id="likeIcon" class="fa-regular fa-heart"></i>
                    <span id="likeText">Like</span>
                </button>
            </div>
            <script>
                const likeButton = document.getElementById('likeButton');
                const likeIcon = document.getElementById('likeIcon');
                const likeText = document.getElementById('likeText');

                likeButton.addEventListener('click', function() {
                    if (likeIcon.classList.contains('fa-regular')) {
                        // Chuyển sang trạng thái đã like
                        likeIcon.classList.remove('fa-regular');
                        likeIcon.classList.add('fa-solid');
                        likeIcon.style.color = '#e0245e'; // màu đỏ
                        likeText.textContent = 'Đã like';
                    } else {
                        // Chuyển lại trạng thái chưa like
                        likeIcon.classList.remove('fa-solid');
                        likeIcon.classList.add('fa-regular');
                        likeIcon.style.color = '';
                        likeText.textContent = 'Like';
                    }
                });
            </script> --}}







        </div>
        {{-- report --}}
        {{-- <div class="my-3">
                <button type="button" class="btn btn-sm btn-outline-danger report-button-right" data-bs-toggle="modal"
                    data-bs-target="#reportModal">
                    <i class="fas fa-flag me-2"></i> Báo cáo bài viết
                </button>
            </div>
            <style>
                .report-button-right {
                    float: right;
                    /* Đẩy nút sang phải */
                }

                /* Đảm bảo vùng chứa (div bao ngoài) không bị ảnh hưởng bởi float */
                .my-3 {
                    overflow: auto;
                }
            </style> --}}
        <div class="my-3">
            <button type="button" class="btn btn-sm btn-outline-danger report-button-right" data-bs-toggle="modal"
                data-bs-target="#reportModal">
                <i class="fas fa-flag me-2"></i> Báo cáo bài viết
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('bai-viet.report', $video->id) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="reportModalLabel">Báo cáo bài viết</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="ly_do" class="form-label">Lý do báo cáo</label>
                                <select name="ly_do" id="ly_do" class="form-select" required>
                                    <option value="">-- Chọn lý do --</option>
                                    <option value="spam">Spam</option>
                                    <option value="hate_speech">Ngôn từ thù ghét</option>
                                    <option value="misinformation">Thông tin sai lệch</option>
                                    <option value="pornography">Nội dung khiêu dâm</option>
                                    <option value="other">Khác</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="mo_ta" class="form-label">Mô tả chi tiết (tùy chọn)</label>
                                <textarea name="mo_ta" id="mo_ta" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-danger">Gửi Báo cáo</button>
                        </div>
                    </form>
                </div>
            </div>
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
            background-color: #e0e0e0;
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
            /* tăng chiều cao khung video */
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







    <style>
        /* ------------------------------------ */
        /* 1. Tùy chỉnh Modal chính (reportModal) */
        /* ------------------------------------ */
        #reportModal .modal-content {
            border-radius: 12px;
            /* Bo góc mềm mại hơn cho popup */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            border: none;
        }

        /* ------------------------------------ */
        /* 2. Tiêu đề Modal */
        /* ------------------------------------ */
        #reportModal .modal-header {
            background-color: #dc3545;
            /* Màu nền đỏ nhạt (màu nguy hiểm của Bootstrap) */
            color: white;
            /* Màu chữ trắng */
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            padding: 1rem 1.5rem;
            border-bottom: none;
        }

        #reportModal .modal-title {
            font-weight: 600;
            font-size: 1.25rem;
        }

        /* Đảm bảo nút đóng có màu trắng */
        #reportModal .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
            /* Làm nút đóng màu trắng */
        }

        /* ------------------------------------ */
        /* 3. Nội dung Modal (Form) */
        /* ------------------------------------ */
        #reportModal .modal-body {
            padding: 1.5rem;
        }

        #reportModal .modal-body p {
            color: #555;
            margin-bottom: 1.25rem;
            font-size: 0.95rem;
        }

        /* Thiết kế cho Select Box và Textarea (Form controls) */
        #reportModal .form-control,
        #reportModal .form-select {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 0.75rem 1rem;
            box-shadow: none;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        #reportModal .form-control:focus,
        #reportModal .form-select:focus {
            border-color: #dc3545;
            /* Đổi màu viền khi tập trung */
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
            /* Thêm bóng mờ nhẹ */
        }

        /* ------------------------------------ */
        /* 4. Footer Modal (Các nút) */
        /* ------------------------------------ */
        #reportModal .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #eee;
            justify-content: flex-end;
            /* Căn nút sang phải */
        }

        /* Tùy chỉnh nút Đóng (Secondary) */
        #reportModal .btn-secondary {
            border-radius: 6px;
            font-weight: 500;
        }

        /* Tùy chỉnh nút Gửi Báo cáo (Danger) */
        #reportModal .btn-danger {
            border-radius: 6px;
            font-weight: 600;
        }
    </style>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
@endsection
