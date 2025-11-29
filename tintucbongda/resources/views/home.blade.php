@extends('layouts.app')

@section('content')
    <!-- Content -->
    <!-- Feature post -->
    <section class="bg0">
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
                            <div class="featured-img position-relative w-100"
                                style="background-image: url('{{ $imgUrl }}');">
                                <a href="{{ route('bai-viet.show', $article->id) }}"
                                    class="dis-block how1-child1 trans-03 w-100 h-100"></a>
                                <span
                                    class="top-0 px-3 py-2 m-2 shadow featured-badge badge bg-warning text-dark position-absolute start-0 fs-6">Nổi
                                    bật</span>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="flex-wrap mb-2 d-flex align-items-center">
                                    <span
                                        class="mb-1 badge bg-primary me-2">{{ $article->danhMuc->ten_danh_muc ?? 'Chưa phân loại' }}</span>
                                    <span class="mb-1 text-muted small ms-auto"><i
                                            class="fa fa-user me-1"></i>{{ $article->user->ho_ten ?? 'Ẩn danh' }}</span>
                                </div>
                                <h5 class="mb-2 card-title">
                                    <a href="{{ route('bai-viet.show', $article->id) }}"
                                        class="tieu_de text-decoration-none fw-bold text-dark hov-cl10">
                                        {{ $article['tieu_de'] }}
                                    </a>
                                </h5>
                                <p class="mb-0 card-text text-secondary flex-grow-1">
                                    {{ Str::limit(strip_tags($article['noi_dung']), 120) }}
                                </p>
                            </div>
                            <div class="bg-white border-0 card-footer text-end">
                                <span class="text-muted small"><i
                                        class="fa fa-calendar me-1"></i>{{ optional($article->created_at)->format('d/m/Y') }}</span>
                            </div>
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
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
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
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
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

                color: #1900fc;
                text-decoration: none;
            }
        </style>

        <!-- Post -->
        <section class="post bg0 p-t-85">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8">
                        <div class="p-r-10 p-rl-0-sr991 p-b-20">

                            {{-- @foreach ($danhMucList as $danhMuc)
                                <div class="p-b-25">
                                    <div class="how2 how2-cl1 flex-s-c">
                                        <h3 class="f1-m-2 cl12 tab01-title">
                                            {{ $danhMuc->ten_danh_muc }}
                                        </h3>
                                    </div>

                                    @php
                                        $bvList = $baiVietTheoDanhMuc[$danhMuc->id] ?? collect();
                                        $first = $bvList->first();
                                        $rest = $bvList->slice(1);
                                    @endphp

                                    <div class="flex-wr-sb-s p-t-35">
                                        <div class="size-w-6 w-full-sr575">
                                            @if ($first)
                                                <div class="m-b-30">
                                                    <a href="{{ route('bai-viet.show', $first->id) }}"
                                                        class="wrap-pic-w hov1 trans-03">
                                                        <img src="{{ asset($first->anh_dai_dien) }}"
                                                            alt="{{ $first->tieu_de }}">
                                                    </a>
                                                    <div class="p-t-25">
                                                        <h5 class="p-b-5">
                                                            <a href="{{ route('bai-viet.show', $first->id) }}"
                                                                class="f1-m-3 cl2 hov-cl10 trans-03">
                                                                {{ Str::limit($first->tieu_de, 100) }}
                                                            </a>
                                                        </h5>
                                                        <span class="cl8">
                                                            <span class="f1-s-4 cl8 hov-cl10 trans-03">
                                                                {{ $danhMuc->ten_danh_muc }}
                                                            </span>
                                                            <span class="f1-s-3 m-rl-3">-</span>
                                                            <span
                                                                class="f1-s-3">{{ optional($first->created_at)->format('M d') }}</span>
                                                        </span>
                                                        <p class="f1-s-1 cl6 p-t-18">
                                                            {{ Str::limit(strip_tags($first->noi_dung), 120) }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="size-w-7 w-full-sr575">
                                            @foreach ($rest as $item)
                                                <div class="m-b-30">
                                                    <a href="{{ route('bai-viet.show', $item->id) }}"
                                                        class="wrap-pic-w hov1 trans-03">
                                                        <img src="{{ asset($item->anh_dai_dien) }}"
                                                            alt="{{ $item->tieu_de }}">
                                                    </a>
                                                    <div class="p-t-10">
                                                        <h5 class="p-b-5">
                                                            <a href="{{ route('bai-viet.show', $item->id) }}"
                                                                class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                {{ Str::limit($item->tieu_de, 80) }}
                                                            </a>
                                                        </h5>
                                                        <span class="cl8">
                                                            <span class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                {{ $danhMuc->ten_danh_muc }}
                                                            </span>
                                                            <span class="f1-s-3 m-rl-3">-</span>
                                                            <span
                                                                class="f1-s-3">{{ optional($item->created_at)->format('M d') }}</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="p-b-25">
                                    <div class="how2 how2-cl1 flex-s-c">
                                        <h3 class="f1-m-2 cl12 tab01-title">
                                            {{ $danhMuc->ten_danh_muc }}
                                        </h3>
                                    </div>

                                    @php
                                        $bvList = $baiVietTheoDanhMuc[$danhMuc->id] ?? collect();
                                        $first = $bvList->first();
                                        $rest = $bvList->slice(1);
                                    @endphp

                                    <div class="flex-wr-sb-s p-t-35">
                                        <div class="size-w-6 w-full-sr575">
                                            @if ($first)
                                                <div class="m-b-30">
                                                    <a href="{{ route('bai-viet.show', $first->id) }}"
                                                        class="wrap-pic-w hov1 trans-03">
                                                        <img src="{{ asset($first->anh_dai_dien) }}"
                                                            alt="{{ $first->tieu_de }}">
                                                    </a>
                                                    <div class="p-t-25">
                                                        <h5 class="p-b-5">
                                                            <a href="{{ route('bai-viet.show', $first->id) }}"
                                                                class="f1-m-3 cl2 hov-cl10 trans-03">
                                                                {{ Str::limit($first->tieu_de, 100) }}
                                                            </a>
                                                        </h5>
                                                        <span class="cl8">
                                                            <span class="f1-s-4 cl8 hov-cl10 trans-03">
                                                                {{ $danhMuc->ten_danh_muc }}
                                                            </span>
                                                            <span class="f1-s-3 m-rl-3">-</span>
                                                            <span
                                                                class="f1-s-3">{{ optional($first->created_at)->format('M d') }}</span>
                                                        </span>
                                                        <p class="f1-s-1 cl6 p-t-18">
                                                            {{ Str::limit(strip_tags($first->noi_dung), 120) }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="size-w-7 w-full-sr575">
                                            @foreach ($rest as $item)
                                                <div class="m-b-30">
                                                    <a href="{{ route('bai-viet.show', $item->id) }}"
                                                        class="wrap-pic-w hov1 trans-03">
                                                        <img src="{{ asset($item->anh_dai_dien) }}"
                                                            alt="{{ $item->tieu_de }}">
                                                    </a>
                                                    <div class="p-t-10">
                                                        <h5 class="p-b-5">
                                                            <a href="{{ route('bai-viet.show', $item->id) }}"
                                                                class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                {{ Str::limit($item->tieu_de, 80) }}
                                                            </a>
                                                        </h5>
                                                        <span class="cl8">
                                                            <span class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                {{ $danhMuc->ten_danh_muc }}
                                                            </span>
                                                            <span class="f1-s-3 m-rl-3">-</span>
                                                            <span
                                                                class="f1-s-3">{{ optional($item->created_at)->format('M d') }}</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach --}}
                            @foreach ($danhMucList as $danhMuc)
                                <div class="p-b-25">

                                    <div class="how2 how2-cl1 flex-s-c">
                                        <h3 class="f1-m-2 cl12 tab01-title">
                                            {{ $danhMuc->ten_danh_muc }}
                                        </h3>
                                    </div>

                                    @php
                                        $bvList = $baiVietTheoDanhMuc[$danhMuc->id] ?? collect();
                                        $first = $bvList->first();
                                        $rest = $bvList->slice(1);
                                    @endphp

                                    <div class="flex-wr-sb-s p-t-35">

                                        <div class="size-w-6 w-full-sr575">
                                            @if ($first)
                                                <div class="m-b-30">
                                                    <a href="{{ route('bai-viet.show', $first->id) }}"
                                                        class="wrap-pic-w hov1 trans-03">
                                                        <img src="{{ asset($first->anh_dai_dien) }}"
                                                            alt="{{ $first->tieu_de }}">
                                                    </a>
                                                    <div class="p-t-25">
                                                        <h5 class="p-b-5">
                                                            <a href="{{ route('bai-viet.show', $first->id) }}"
                                                                class="f1-m-3 cl2 hov-cl10 trans-03">
                                                                {{ Str::limit($first->tieu_de, 100) }}
                                                            </a>
                                                        </h5>
                                                        <span class="cl8">
                                                            <span class="f1-s-4 cl8 hov-cl10 trans-03">
                                                                {{ $danhMuc->ten_danh_muc }}
                                                            </span>
                                                            <span class="f1-s-3 m-rl-3">-</span>
                                                            <span
                                                                class="f1-s-3">{{ optional($first->created_at)->format('M d') }}</span>
                                                        </span>

                                                        <p class="f1-s-1 cl6 p-t-18">
                                                            {{ Str::limit(strip_tags($first->noi_dung), 120) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="size-w-7 w-full-sr575">
                                            @foreach ($rest as $item)
                                                <div class="m-b-30">
                                                    <a href="{{ route('bai-viet.show', $item->id) }}"
                                                        class="wrap-pic-w hov1 trans-03">
                                                        <img src="{{ asset($item->anh_dai_dien) }}"
                                                            alt="{{ $item->tieu_de }}">
                                                    </a>

                                                    <div class="p-t-10">
                                                        <h5 class="p-b-5">
                                                            <a href="{{ route('bai-viet.show', $item->id) }}"
                                                                class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                {{ Str::limit($item->tieu_de, 80) }}
                                                            </a>
                                                        </h5>

                                                        <span class="cl8">
                                                            <span class="f1-s-6 cl8 hov-cl10 trans-03">
                                                                {{ $danhMuc->ten_danh_muc }}
                                                            </span>
                                                            <span class="f1-s-3 m-rl-3">-</span>
                                                            <span
                                                                class="f1-s-3">{{ optional($item->created_at)->format('M d') }}</span>
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            @endforeach






                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
