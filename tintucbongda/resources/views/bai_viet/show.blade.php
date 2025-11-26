<!-- resources/views/bai_viet/show.blade.php -->
@extends('layouts.app') <!-- Kế thừa layout chính của bạn -->

@section('content')
    {{-- <head>
        <meta property="og:title" content="{{ $baiViet->tieu_de }}" />
        <meta property="og:description" content="{{ Str::limit($baiViet->noi_dung, 150) }}" />
        <meta property="og:image" content="{{ asset($baiViet->hinh_anh) }}" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:type" content="article" />

    </head> --}}
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.png') }}" />

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.min.css') }}">
    <div class="container">
        <h1 class="bai-viet-title">{{ $baiViet->tieu_de }}</h1>
        @php
            function normalizeImage($path) {
                // Nếu là URL thật (http/https)
                if (filter_var($path, FILTER_VALIDATE_URL)) {
                    return $path;
                }

                // Nếu là đường dẫn tuyệt đối của Windows → convert về web path
                if (str_contains($path, 'uploads')) {
                    $clean = str_replace(public_path(), '', $path);
                    return asset($clean);
                }

                // Seeder hoặc đường dẫn tương đối
                return asset($path);
            }

            $imageUrl = normalizeImage($baiViet->anh_dai_dien);
        @endphp


        {{-- <img class="bai-viet-image" src="{{ $baiViet->anh_dai_dien }}" alt="{{ $baiViet->tieu_de }}" class="img-fluid"> --}}
        <img class="bai-viet-image" src="{{ $imageUrl }}" alt="{{ $baiViet->tieu_de }}">

        <p class="noi-dung">{{ $baiViet->noi_dung }}</p>

        <div class="mt-3 text-muted">
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

                @php
                    $url = url()->current(); // Lấy URL hiện tại
                @endphp

                <a href="https://zalo.me/share?url={{ urlencode($url) }}"
                    class="zalo dis-block f1-s-13 cl0 bg-zalo borad-3 p-tb-4 p-rl-18 hov-btn1 m-r-3 m-b-3 trans-03"
                    target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-share-alt m-r-7"></i>
                    Zalo
                </a>



                <!-- Nút Like -->
                <!-- Nút Like -->
                {{-- <button id="likeButton" data-id="{{ $baiViet->id }}" class="like-button {{ $daLike ? 'liked' : '' }}">
                    @if ($daLike)
                        <i id="likeIcon" class="fa-solid fa-heart" style="color:#e0245e"></i>
                        <span id="likeText">Đã like</span>
                    @else
                        <i id="likeIcon" class="fa-regular fa-heart"></i>
                        <span id="likeText">Like</span>
                    @endif
                </button>



                <script>
                    document.getElementById('likeButton').addEventListener('click', function() {
                        let baiVietId = this.getAttribute('data-id');

                        fetch(`/like/${baiVietId}`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({})
                            })
                            .then(response => response.json())
                            .then(data => {
                                const icon = document.getElementById('likeIcon');
                                const text = document.getElementById('likeText');

                                if (data.status === 'liked') {
                                    this.classList.add('liked');
                                    icon.classList.remove('fa-regular');
                                    icon.classList.add('fa-solid');
                                    icon.style.color = '#e0245e';
                                    text.textContent = 'Đã like';
                                } else {
                                    this.classList.remove('liked');
                                    icon.classList.remove('fa-solid');
                                    icon.classList.add('fa-regular');
                                    icon.style.color = '';
                                    text.textContent = 'Like';
                                }
                            });
                    });
                </script> --}}


                <!-- CSS -->
                <style>
                    .zalo {
                        background-color: #0068ff;
                    }

                    .like-button {
                        cursor: pointer;
                        display: inline-flex;
                        align-items: center;
                        padding: 10px 16px;
                        border: none;
                        border-radius: 25px;
                        background-color: #f5f5f5;
                        font-size: 16px;
                        font-weight: 500;
                        color: #333;
                        transition: all 0.3s ease;
                    }

                    .like-button:hover {
                        background-color: #eaeaea;
                    }

                    .like-button i {
                        font-size: 20px;
                        margin-right: 8px;
                        transition: color 0.3s ease;
                    }

                    .like-button.liked {
                        background-color: #ffe6eb;
                        color: #e0245e;
                    }

                    .like-button.liked i {
                        color: #e0245e;
                    }
                </style>

                {{-- <!-- JS -->
                <script>
                    const likeButton = document.getElementById('likeButton');
                    const likeIcon = document.getElementById('likeIcon');
                    const likeText = document.getElementById('likeText');

                    likeButton.addEventListener('click', function() {
                        this.classList.toggle('liked');
                        if (this.classList.contains('liked')) {
                            likeIcon.classList.remove('fa-regular');
                            likeIcon.classList.add('fa-solid');
                            likeText.textContent = 'Đã like';
                        } else {
                            likeIcon.classList.remove('fa-solid');
                            likeIcon.classList.add('fa-regular');
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
    </div>
    </div>




    </div>

    <div class="row justify-content-center">
        {{-- <div>
            <h1 style="baivietngaunhien">bài viết ngẫu nhiên</h1>
        </div> --}}
        @foreach ($articles->random(4) as $article)
            <div class="mb-4 b col-md-4">
                <div class="border-0 shadow-sm card h-100">
                    <!-- Ảnh vuông -->
                    <a href="{{ route('bai-viet.show', $article->id) }}">
                        {{-- <img src="{{ asset($article['anh_dai_dien']) }}" class="card-img-top square-img"
                            alt="{{ $article['tieu_de'] }}"> --}}
                            @php
                                $img = normalizeImage($article['anh_dai_dien']);
                            @endphp

                            <img src="{{ $img }}" class="card-img-top square-img" alt="{{ $article['tieu_de'] }}">

                    </a>

                    <!-- Nội dung -->
                    <div class="px-3 py-2 card-body">
                        <h5 class="mb-2 card-title">
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
                    <div class="px-3 bg-white border-0 card-footer text-end text-muted small">
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
            /* max-height: 300px */
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
@endsection
