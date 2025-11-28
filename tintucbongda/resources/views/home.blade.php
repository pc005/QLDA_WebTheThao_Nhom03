@extends('layouts.app')

@section('content')
    <!-- Content -->
    <!-- Feature post -->
    <section class="bg0">


<<<<<<< HEAD
        <div class="row m-rl-0 justify-content-center">
            @foreach ($articles as $article)
                <div class="col-md-4 p-rl-1 p-b-2">
                    <div class="card h-100 shadow-sm">
                        <div class="img card-img-top bg-img1 size-a-11 how1 pos-relative"
                            style="background-image: url('{{ asset($article['anh_dai_dien']) }}');">
                            {{-- Liên kết phủ toàn bộ ảnh --}}
                            <a href="{{ route('bai-viet.show', $article->id) }}" class="dis-block how1-child1 trans-03"></a>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('bai-viet.show', $article->id) }}"
                                    class="tieu_de f1-l-1 cl0 hov-cl10 trans-03 respon1">
                                    {{ $article['tieu_de'] }}
                                </a>
                            </h5>
                            <p class="card-text">
                                {{ Str::limit($article['tom_tat'] ?? $article['noi_dung'], 100) }}
                            </p>
                        </div>

                        <div class="card-footer text-muted">
                            Đăng ngày {{ optional($article->created_at)->format('d/m/Y') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <style>
            /* ------------------------------------ */
            /* 1. STYLING CƠ BẢN CỦA CARD (H-100) */
            /* ------------------------------------ */
            .card {
                border: 1px solid #e0e0e0;
                /* Viền nhẹ */
                border-radius: 8px;
                /* Bo góc nhẹ */
                overflow: hidden;
                /* Thêm hiệu ứng chuyển động cho card */
                transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            }

            /* Hiệu ứng khi di chuột qua card */
            .card:hover {
                transform: translateY(-5px);
                /* Nâng card lên 5px */
                box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15) !important;
                /* Đổ bóng mạnh hơn */
            }

            /* ------------------------------------ */
            /* 2. STYLING CHO ẢNH ĐẠI DIỆN (.img) */
            /* ------------------------------------ */
            .img {
                overflow: hidden;
                background-size: cover;
                /* Đảm bảo ảnh nền phủ kín vùng chứa */
                background-position: center;
                /* Căn giữa ảnh nền */
            }

            /* ------------------------------------ */
            /* 3. STYLING CHO TIÊU ĐỀ (.tieu_de) */
            /* ------------------------------------ */
            .tieu_de {
                color: #333333 !important;
                /* Đảm bảo màu tối cho tiêu đề */
                text-decoration: none;
                font-weight: 600;
                /* Làm tiêu đề nổi bật hơn */
                margin-bottom: 0.5rem;
                line-height: 1.3;
                /* Giới hạn số dòng cho tiêu đề (cần cho tính đồng bộ) */
                display: -webkit-box;
                -webkit-line-clamp: 2;
                /* Ví dụ: Giới hạn 2 dòng */
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            /* ------------------------------------ */
            /* 4. STYLING CHO TÓM TẮT (.card-text) */
            /* ------------------------------------ */
            .card-text {
                color: #6c757d;
                /* Màu xám cho nội dung tóm tắt */
                font-size: 0.9rem;
                line-height: 1.5;
                /* Giới hạn 3 dòng cho tóm tắt */
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            /* ------------------------------------ */
            /* 5. STYLING CHO FOOTER (.card-footer) */
            /* ------------------------------------ */
            .card-footer {
                background-color: #f7f7f7;
                /* Nền xám nhạt */
                border-top: 1px solid #e0e0e0;
                font-size: 0.8rem;
                color: #999;
                /* Màu chữ rất nhẹ */
                padding: 0.75rem 1.25rem;
            }

            /* Xóa class c10 và img trống cũ */
            .c10,
            .img {}



            /* ------------------------------------ */
            /* 1. STYLING CƠ BẢN CỦA CARD (Bo góc chính) */
            /* ------------------------------------ */
            .card {
                border: 1px solid #e0e0e0;
                border-radius: 10px;
                /* **Tăng độ bo góc của toàn bộ card** */
                overflow: hidden;
                /* **Rất quan trọng: Để các thành phần bên trong (ảnh) được bo góc theo card** */
                transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            }

            /* Hiệu ứng khi di chuột qua card */
            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
                /* Đổ bóng mạnh hơn và rõ ràng hơn */
            }

            /* ------------------------------------ */
            /* 2. STYLING CHO ẢNH ĐẠI DIỆN (.img) */
            /* ------------------------------------ */
            .img {
                overflow: hidden;
                /* Bo góc chỉ ảnh hưởng đến góc trên cùng của ảnh (theo bo góc card) */
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;

                background-size: cover;
                /* Đảm bảo ảnh nền phủ kín vùng chứa */
                background-position: center;
                /* Căn giữa ảnh nền */
            }

            /* ------------------------------------ */
            /* 3. STYLING CHO TIÊU ĐỀ (.tieu_de) */
            /* ------------------------------------ */
            .tieu_de {
                color: #333333 !important;
                text-decoration: none;
                font-weight: 600;
                margin-bottom: 0.5rem;
                line-height: 1.3;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            /* ------------------------------------ */
            /* 4. STYLING CHO TÓM TẮT VÀ FOOTER */
            /* ------------------------------------ */
            .card-text {
                color: #6c757d;
                font-size: 0.9rem;
                line-height: 1.5;
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .card-footer {
                background-color: #f7f7f7;
                border-top: 1px solid #e0e0e0;
                font-size: 0.8rem;
                color: #999;
                padding: 0.75rem 1.25rem;
            }
        </style>

        {{-- <div class="row m-rl-0 justify-content-center">
            @foreach ($articles as $article)
                <div class="col-md-4 p-rl-1 p-b-2">
                    <!-- Card wrapper -->
                    <div class="card h-100 shadow-sm">
                        <!-- Ảnh đại diện -->
                        <div class="img card-img-top bg-img1 size-a-11 how1 pos-relative"
                            style="background-image: url('{{ asset($article['anh_dai_dien']) }}');">
                            <a href="{{ route('bai-viet.show', $article->id) }}" class=" dis-block how1-child1 trans-03"></a>
                        </div>

                        <!-- Nội dung card -->
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('bai-viet.show', $article->id) }}"
                                    class="tieu_de f1-l-1 cl0 hov-cl10 trans-03 respon1">
                                    {{ $article['tieu_de'] }}
                                </a>
                            </h5>
                            <p class="card-text">
                                {{ Str::limit($article['noi_dung'], 100) }}
                            </p>
                        </div>

                        <!-- Footer card -->
                        <div class="card-footer text-muted">
                            Đăng ngày {{ optional($article->created_at)->format('d/m/Y') }}
=======
        <div class="container mb-4">
            <div class="row justify-content-center gx-4 gy-4">
                @foreach ($featuredArticles as $article)
                    <div class="col-lg-4 col-md-6 col-12 d-flex">
                        <div class="border-0 shadow card featured-card flex-fill position-relative">
                            @php
                                $imgPath = $article['anh_dai_dien'];
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
                            <div class="featured-img position-relative w-100" style="background-image: url('{{ $imgUrl }}');">
                                <a href="{{ route('bai-viet.show', $article->id) }}" class="dis-block how1-child1 trans-03 w-100 h-100"></a>
                                <span class="top-0 px-3 py-2 m-2 shadow featured-badge badge bg-warning text-dark position-absolute start-0 fs-6">Nổi bật</span>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="flex-wrap mb-2 d-flex align-items-center">
                                    <span class="mb-1 badge bg-primary me-2">{{ $article->danhMuc->ten_danh_muc ?? 'Chưa phân loại' }}</span>
                                    <span class="mb-1 text-muted small ms-auto"><i class="fa fa-user me-1"></i>{{ $article->user->ho_ten ?? 'Ẩn danh' }}</span>
                                </div>
                                <h5 class="mb-2 card-title">
                                    <a href="{{ route('bai-viet.show', $article->id) }}" class="tieu_de text-decoration-none fw-bold text-dark hov-cl10">
                                        {{ $article['tieu_de'] }}
                                    </a>
                                </h5>
                                <p class="mb-0 card-text text-secondary flex-grow-1">
                                    {{ Str::limit(strip_tags($article['noi_dung']), 120) }}
                                </p>
                            </div>
                            <div class="bg-white border-0 card-footer text-end">
                                <span class="text-muted small"><i class="fa fa-calendar me-1"></i>{{ optional($article->created_at)->format('d/m/Y') }}</span>
                            </div>
>>>>>>> d4c14bb287ea7788cfe2395fdf21b8556e868ee5
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <style>
            .featured-card {
                transition: transform 0.2s, box-shadow 0.2s;
                border-radius: 1rem;
                min-width: 0;
                display: flex;
                flex-direction: column;
            }
            .featured-card:hover {
                transform: translateY(-8px) scale(1.03);
                box-shadow: 0 8px 32px rgba(0,0,0,0.15);
            }
            .featured-img {
                height: 180px;
                background-size: cover;
                background-position: center;
                border-top-left-radius: 1rem;
                border-top-right-radius: 1rem;
            }
            .featured-badge {
                font-size: 1rem;
                border-radius: 0.75rem;
                box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            }
            @media (max-width: 991.98px) {
                .featured-img {
                    height: 140px;
                }
            }
            @media (max-width: 767.98px) {
                .featured-img {
                    height: 100px;
                }
            }
        </style>
        <style>
            .img {}

            .c10 {
                color: #050708;
            }

            .tieu_de {

                color: #000000;
                text-decoration: none;
            }
<<<<<<< HEAD
        </style> --}}

=======
        </style>
>>>>>>> d4c14bb287ea7788cfe2395fdf21b8556e868ee5

        <!-- Post -->
        <section class="post bg0 p-t-85">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8">
                        <div class="p-r-10 p-rl-0-sr991 p-b-20">
                            <!-- Entertainment  -->
                            <div class="p-b-25">
                                <div class="how2 how2-cl1 flex-s-c">
                                    <h3 class="f1-m-2 cl12 tab01-title">
                                        Entertainment
                                    </h3>
                                </div>

                                <div class="flex-wr-sb-s p-t-35">
                                    <div class="size-w-6 w-full-sr575">
                                        <!-- Item post -->
                                        <div class="m-b-30">
                                            <a href="blog-detail-02.html" class="wrap-pic-w hov1 trans-03">
                                                <img src="images/post-21.jpg" alt="IMG">
                                            </a>

                                            <div class="p-t-25">
                                                <h5 class="p-b-5">
                                                    <a href="blog-detail-02.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                        American live music lorem ipsum dolor sit amet consectetur
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                        Music
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        Feb 18
                                                    </span>
                                                </span>

                                                <p class="f1-s-1 cl6 p-t-18">
                                                    Duis eu felis id tortor congue consequat. Sed vitae vestibulum enim, et
                                                    pharetra magna
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="size-w-7 w-full-sr575">
                                        <!-- Item post -->
                                        <div class="m-b-30">
                                            <a href="blog-detail-02.html" class="wrap-pic-w hov1 trans-03">
                                                <img src="images/post-22.jpg" alt="IMG">
                                            </a>

                                            <div class="p-t-10">
                                                <h5 class="p-b-5">
                                                    <a href="blog-detail-02.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                        Donec metus orci, malesuada et lectus vitae
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                        Music
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        Feb 18
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Item post -->
                                        <div class="m-b-30">
                                            <a href="blog-detail-02.html" class="wrap-pic-w hov1 trans-03">
                                                <img src="images/post-23.jpg" alt="IMG">
                                            </a>

                                            <div class="p-t-10">
                                                <h5 class="p-b-5">
                                                    <a href="blog-detail-02.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                        Donec metus orci, malesuada et lectus vitae
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                        Game
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        Feb 16
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Business  -->
                            <div class="p-b-25">
                                <div class="how2 how2-cl2 flex-s-c">
                                    <h3 class="f1-m-2 cl13 tab01-title">
                                        Business
                                    </h3>
                                </div>

                                <div class="flex-wr-sb-s p-t-35">
                                    <div class="size-w-6 w-full-sr575">
                                        <!-- Item post -->
                                        <div class="m-b-30">
                                            <a href="blog-detail-02.html" class="wrap-pic-w hov1 trans-03">
                                                <img src="images/post-10.jpg" alt="IMG">
                                            </a>

                                            <div class="p-t-25">
                                                <h5 class="p-b-5">
                                                    <a href="blog-detail-02.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                        Bitcoin lorem ipsum dolor sit amet consectetur
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                        Finance
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        Feb 18
                                                    </span>
                                                </span>

                                                <p class="f1-s-1 cl6 p-t-18">
                                                    Duis eu felis id tortor congue consequat. Sed vitae vestibulum enim, et
                                                    pharetra magna
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="size-w-7 w-full-sr575">
                                        <!-- Item post -->
                                        <div class="m-b-30">
                                            <a href="blog-detail-02.html" class="wrap-pic-w hov1 trans-03">
                                                <img src="images/post-11.jpg" alt="IMG">
                                            </a>

                                            <div class="p-t-10">
                                                <h5 class="p-b-5">
                                                    <a href="blog-detail-02.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                        Donec metus orci, malesuada et lectus vitae
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                        Small Business
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        Feb 17
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Item post -->
                                        <div class="m-b-30">
                                            <a href="blog-detail-02.html" class="wrap-pic-w hov1 trans-03">
                                                <img src="images/post-24.jpg" alt="IMG">
                                            </a>

                                            <div class="p-t-10">
                                                <h5 class="p-b-5">
                                                    <a href="blog-detail-02.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                        Donec metus orci, malesuada et lectus vitae
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                        Economy
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        Feb 16
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Travel  -->
                            <div class="p-b-25">
                                <div class="how2 how2-cl3 flex-s-c">
                                    <h3 class="f1-m-2 cl14 tab01-title">
                                        Travel
                                    </h3>
                                </div>

                                <div class="flex-wr-sb-s p-t-35">
                                    <div class="size-w-6 w-full-sr575">
                                        <!-- Item post -->
                                        <div class="m-b-30">
                                            <a href="blog-detail-02.html" class="wrap-pic-w hov1 trans-03">
                                                <img src="images/post-14.jpg" alt="IMG">
                                            </a>

                                            <div class="p-t-25">
                                                <h5 class="p-b-5">
                                                    <a href="blog-detail-02.html" class="f1-m-3 cl2 hov-cl10 trans-03">
                                                        You wish lorem ipsum dolor sit amet consectetur
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                        Beach
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        Feb 18
                                                    </span>
                                                </span>

                                                <p class="f1-s-1 cl6 p-t-18">
                                                    Duis eu felis id tortor congue consequat. Sed vitae vestibulum enim, et
                                                    pharetra magna
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="size-w-7 w-full-sr575">
                                        <!-- Item post -->
                                        <div class="m-b-30">
                                            <a href="blog-detail-02.html" class="wrap-pic-w hov1 trans-03">
                                                <img src="images/post-15.jpg" alt="IMG">
                                            </a>

                                            <div class="p-t-10">
                                                <h5 class="p-b-5">
                                                    <a href="blog-detail-02.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                        Donec metus orci, malesuada et lectus vitae
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                        Beach
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        Feb 17
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Item post -->
                                        <div class="m-b-30">
                                            <a href="blog-detail-02.html" class="wrap-pic-w hov1 trans-03">
                                                <img src="images/post-17.jpg" alt="IMG">
                                            </a>

                                            <div class="p-t-10">
                                                <h5 class="p-b-5">
                                                    <a href="blog-detail-02.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                        Donec metus orci, malesuada et lectus vitae
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                        Hotels
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        Feb 16
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Life Style  -->
                            <div class="p-b-25 m-r--10 m-r-0-sr991">
                                <div class="how2 how2-cl5 flex-s-c m-r-10 m-r-0-sr991">
                                    <h3 class="f1-m-2 cl17 tab01-title">
                                        Life Style
                                    </h3>
                                </div>

                                <div class="row p-t-35">
                                    <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                        <!-- Item post -->
                                        <div class="flex-wr-sb-s m-b-30">
                                            <a href="blog-detail-02.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                <img src="images/post-25.jpg" alt="IMG">
                                            </a>

                                            <div class="size-w-2">
                                                <h5 class="p-b-5">
                                                    <a href="blog-detail-02.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                        Donec metus orci, malesuada et lectus vitae
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                        Beach
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        Feb 17
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Item post -->
                                        <div class="flex-wr-sb-s m-b-30">
                                            <a href="blog-detail-02.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                <img src="images/post-26.jpg" alt="IMG">
                                            </a>

                                            <div class="size-w-2">
                                                <h5 class="p-b-5">
                                                    <a href="blog-detail-02.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                        Donec metus orci, malesuada et lectus vitae
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                        Flights
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        Feb 16
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                        <!-- Item post -->
                                        <div class="flex-wr-sb-s m-b-30">
                                            <a href="blog-detail-02.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                <img src="images/post-03.jpg" alt="IMG">
                                            </a>

                                            <div class="size-w-2">
                                                <h5 class="p-b-5">
                                                    <a href="blog-detail-02.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                        Donec metus orci, malesuada et lectus vitae
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                        Beachs
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        Feb 17
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Item post -->
                                        <div class="flex-wr-sb-s m-b-30">
                                            <a href="blog-detail-02.html" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                <img src="images/post-27.jpg" alt="IMG">
                                            </a>

                                            <div class="size-w-2">
                                                <h5 class="p-b-5">
                                                    <a href="blog-detail-02.html" class="f1-s-5 cl3 hov-cl10 trans-03">
                                                        Donec metus orci, malesuada et lectus vitae
                                                    </a>
                                                </h5>

                                                <span class="cl8">
                                                    <a href="#" class="f1-s-6 cl8 hov-cl10 trans-03">
                                                        Flight
                                                    </a>

                                                    <span class="f1-s-3 m-rl-3">
                                                        -
                                                    </span>

                                                    <span class="f1-s-3">
                                                        Feb 16
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-10 col-lg-4">
                        <div class="p-l-10 p-rl-0-sr991 p-b-20">
                            <!-- Stay Connected -->
                            <div class="p-b-35">
                                <div class="how2 how2-cl4 flex-s-c">
                                    <h3 class="f1-m-2 cl3 tab01-title">
                                        Stay Connected
                                    </h3>
                                </div>

                                <ul class="p-t-35">
                                    <li class="flex-wr-sb-c p-b-20">
                                        <a href="#"
                                            class="size-a-8 flex-c-c borad-3 bg-facebook fs-16 cl0 hov-cl0">
                                            <span class="fab fa-facebook-f"></span>
                                        </a>

                                        <div class="size-w-3 flex-wr-sb-c">
                                            <span class="f1-s-8 cl3 p-r-20">
                                                6879 Fans
                                            </span>

                                            <a href="#" class="f1-s-9 text-uppercase cl3 hov-cl10 trans-03">
                                                Like
                                            </a>
                                        </div>
                                    </li>

                                    <li class="flex-wr-sb-c p-b-20">
                                        <a href="#"
                                            class="size-a-8 flex-c-c borad-3 bg-twitter fs-16 cl0 hov-cl0">
                                            <span class="fab fa-twitter"></span>
                                        </a>

                                        <div class="size-w-3 flex-wr-sb-c">
                                            <span class="f1-s-8 cl3 p-r-20">
                                                568 Followers
                                            </span>

                                            <a href="#" class="f1-s-9 text-uppercase cl3 hov-cl10 trans-03">
                                                Follow
                                            </a>
                                        </div>
                                    </li>

                                    <li class="flex-wr-sb-c p-b-20">
                                        <a href="#"
                                            class="size-a-8 flex-c-c borad-3 bg-youtube fs-16 cl0 hov-cl0">
                                            <span class="fab fa-youtube"></span>
                                        </a>

                                        <div class="size-w-3 flex-wr-sb-c">
                                            <span class="f1-s-8 cl3 p-r-20">
                                                5039 Subscribers
                                            </span>

                                            <a href="#" class="f1-s-9 text-uppercase cl3 hov-cl10 trans-03">
                                                Subscribe
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                            <!-- Most Popular -->
                            <div class="p-b-30">
                                <div class="how2 how2-cl4 flex-s-c">
                                    <h3 class="f1-m-2 cl3 tab01-title">
                                        Most Popular
                                    </h3>
                                </div>

                                <ul class="p-t-35">
                                    <li class="flex-wr-sb-s p-b-22">
                                        <div class="size-a-8 flex-c-c borad-3 bg9 f1-m-4 cl0 m-b-6">
                                            1
                                        </div>

                                        <a href="#" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit
                                        </a>
                                    </li>

                                    <li class="flex-wr-sb-s p-b-22">
                                        <div class="size-a-8 flex-c-c borad-3 bg9 f1-m-4 cl0 m-b-6">
                                            2
                                        </div>

                                        <a href="#" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
                                            Proin velit consectetur non neque
                                        </a>
                                    </li>

                                    <li class="flex-wr-sb-s p-b-22">
                                        <div class="size-a-8 flex-c-c borad-3 bg9 f1-m-4 cl0 m-b-6">
                                            3
                                        </div>

                                        <a href="#" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
                                            Nunc vestibulum, enim vitae condimentum volutpat lobortis ante
                                        </a>
                                    </li>

                                    <li class="flex-wr-sb-s p-b-22">
                                        <div class="size-a-8 flex-c-c borad-3 bg9 f1-m-4 cl0 m-b-6">
                                            4
                                        </div>

                                        <a href="#" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
                                            Proin velit justo consectetur non neque elementum
                                        </a>
                                    </li>

                                    <li class="flex-wr-sb-s p-b-22">
                                        <div class="size-a-8 flex-c-c borad-3 bg9 f1-m-4 cl0">
                                            5
                                        </div>

                                        <a href="#" class="size-w-3 f1-s-7 cl3 hov-cl10 trans-03">
                                            Proin velit consectetur non neque
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <!--  -->
                            <div class="flex-c-s p-t-8 p-b-65">
                                <a href="#">
                                    <img class="max-w-full" src="images/banner-02.jpg" alt="IMG">
                                </a>
                            </div>

                            <!-- Video -->
                            <div class="p-b-55">
                                <div class="how2 how2-cl4 flex-s-c m-b-35">
                                    <h3 class="f1-m-2 cl3 tab01-title">
                                        Featured Video
                                    </h3>
                                </div>

                                <div>
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="images/video-01.jpg" alt="IMG">

                                        <button class="s-full ab-t-l flex-c-c fs-32 cl0 hov-cl10 trans-03"
                                            data-toggle="modal" data-target="#modal-video-01">
                                            <span class="fab fa-youtube"></span>
                                        </button>
                                    </div>

                                    <div class="p-tb-16 p-rl-25 bg3">
                                        <h5 class="p-b-5">
                                            <a href="#" class="f1-m-3 cl0 hov-cl10 trans-03">
                                                Music lorem ipsum dolor sit amet consectetur
                                            </a>
                                        </h5>

                                        <span class="cl15">
                                            <a href="#" class="f1-s-4 cl8 hov-cl10 trans-03">
                                                by John Alvarado
                                            </a>

                                            <span class="f1-s-3 m-rl-3">
                                                -
                                            </span>

                                            <span class="f1-s-3">
                                                Feb 18
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Subscribe -->
                            <div class="bg10 p-rl-35 p-t-28 p-b-35 m-b-55">
                                <h5 class="f1-m-5 cl0 p-b-10">
                                    Subscribe
                                </h5>

                                <p class="f1-s-1 cl0 p-b-25">
                                    Get all latest content delivered to your email a few times a month.
                                </p>

                                <form class="size-a-9 pos-relative">
                                    <input class="s-full f1-m-6 cl6 plh9 p-l-20 p-r-55" type="text" name="email"
                                        placeholder="Email">

                                    <button class="size-a-10 flex-c-c ab-t-r fs-16 cl9 hov-cl10 trans-03">
                                        <i class="fa fa-arrow-right"></i>
                                    </button>
                                </form>
                            </div>

                            <!-- Tag -->
                            <div class="p-b-55">
                                <div class="how2 how2-cl4 flex-s-c m-b-30">
                                    <h3 class="f1-m-2 cl3 tab01-title">
                                        Tags
                                    </h3>
                                </div>

                                <div class="flex-wr-s-s m-rl--5">
                                    <a href="#"
                                        class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                        Fashion
                                    </a>

                                    <a href="#"
                                        class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                        Lifestyle
                                    </a>

                                    <a href="#"
                                        class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                        Denim
                                    </a>

                                    <a href="#"
                                        class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                        Streetstyle
                                    </a>

                                    <a href="#"
                                        class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                        Crafts
                                    </a>

                                    <a href="#"
                                        class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                        Magazine
                                    </a>

                                    <a href="#"
                                        class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                        News
                                    </a>

                                    <a href="#"
                                        class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                                        Blogs
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Banner -->
        <div class="container m-t-10 m-b-15">
            <div class="flex-c-c">
                <a href="#">
                    <img class="max-w-full" src="images/banner-01.jpg" alt="IMG">
                </a>
            </div>
        </div>

        <!-- Latest -->
        <section class="bg0 p-t-60 p-b-40">
            <div class="container">
                <div class="how2 how2-cl4 flex-s-c">
                    <h3 class="f1-m-2 cl3 tab01-title">
                        Bài viết mới nhất
                    </h3>
                </div>

                <div class="row p-t-35">
                    @foreach ($latestArticles as $article)
                        <div class="col-sm-6 col-md-4">
                            <div class="m-b-45">
                                <a href="{{ route('bai-viet.show', $article->id) }}" class="wrap-pic-w hov1 trans-03">
                                    @php
                                        $imgPath = $article['anh_dai_dien'];
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
                                    <img src="{{ $imgUrl }}" alt="IMG">
                                </a>

                                <div class="p-t-16">
                                    <h5 class="p-b-5">
                                        <a href="{{ route('bai-viet.show', $article->id) }}" class="f1-m-3 cl2 hov-cl10 trans-03">
                                            {{ $article['tieu_de'] }}
                                        </a>
                                    </h5>

                                    <span class="cl8">
                                        <span class="f1-s-4 cl8 hov-cl10 trans-03">
                                            {{ $article->user->ho_ten ?? 'Ẩn danh' }}
                                        </span>

                                        <span class="f1-s-3 m-rl-3">
                                            -
                                        </span>

                                        <span class="f1-s-3">
                                            {{ optional($article->created_at)->format('d/m/Y') }}
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endsection
