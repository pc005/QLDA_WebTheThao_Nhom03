@extends('layouts.app')

@section('content')

    <head>
        <title>TITLE CỦA BÀI VIẾT</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Thẻ Open Graph -->
        <meta property="og:tieu_de" content="Tiêu đề của Bài Viết" />
        <meta property="og:description" content="Mô tả ngắn về bài viết." />
        <meta property="og:image" content="{{ asset('images/your-image-url.jpg') }}" /> <!-- Đường dẫn ảnh đại diện -->
        <meta property="og:url" content="{{ url()->current() }}" /> <!-- Đường dẫn hiện tại -->
        <meta property="og:type" content="article" /> <!-- Kiểu nội dung -->

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
@endsection
