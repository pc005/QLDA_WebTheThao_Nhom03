@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- KẾT QUẢ TÌM KIẾM -->
            <div class="search-results">
                @if(isset($keyword) && $keyword != '')
                    <p class="text-muted mb-4">Kết quả tìm kiếm cho: <strong>"{{ $keyword }}"</strong></p>
                @endif

                @if($result->count() > 0)
                    @foreach($result as $article)
                        @php
                            // Hàm xử lý ảnh (dùng lại logic cũ của bạn)
                            $img = $article->anh_dai_dien;
                            if (!filter_var($img, FILTER_VALIDATE_URL)) {
                                if (str_contains($img, 'uploads')) {
                                    $img = asset(str_replace(public_path(), '', $img));
                                } else {
                                    $img = asset($img);
                                }
                            }
                        @endphp

                        <!-- ITEM BÀI VIẾT -->
                        <div class="article-item-vne d-flex mb-4">
                            <!-- Nội dung bên trái -->
                            <div class="article-content flex-grow-1 pr-3">
                                <h3 class="article-title">
                                    <a href="{{ route('bai-viet.show', $article->id) }}">
                                        {{ $article->tieu_de }}
                                    </a>
                                </h3>
                                <div class="article-meta text-muted mb-2">
                                    <small>{{ \Carbon\Carbon::parse($article->ngay_tao)->format('d/m/Y H:i') }}</small>
                                </div>
                                <p class="article-summary text-secondary">
                                    {{ Str::limit(strip_tags($article->noi_dung), 150) }}
                                </p>
                            </div>

                            <!-- Ảnh bên phải (Giống VNExpress Search) -->
                            <div class="article-thumb">
                                <a href="{{ route('bai-viet.show', $article->id) }}">
                                    <img src="{{ $img }}" alt="{{ $article->tieu_de }}">
                                </a>
                            </div>
                        </div>
                        <hr class="separator">
                    @endforeach

                    <!-- Phân trang -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $result->appends(['q' => $keyword])->links('pagination::bootstrap-4') }}
                    </div>

                @else
                    <div class="text-center py-5">
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Không tìm thấy kết quả nào phù hợp.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- CSS RIÊNG CHO TRANG TÌM KIẾM -->
<style>
    /* Input Style */
    .search-form-vne .input-vne {
        height: 50px;
        font-size: 16px;
        border: 1px solid #e5e5e5;
        border-right: none;
        box-shadow: none;
        border-radius: 4px 0 0 4px;
    }
    .search-form-vne .input-vne:focus {
        border-color: #9f224e; /* Màu đỏ đô VNExpress */
    }
    
    .btn-search-vne {
        height: 50px;
        background: white;
        border: 1px solid #e5e5e5;
        border-left: none;
        color: #757575;
        padding: 0 20px;
        border-radius: 0 4px 4px 0;
    }
    .btn-search-vne:hover {
        color: #9f224e;
    }

    /* Article Item Style */
    .article-title {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 5px;
        line-height: 1.4;
    }
    .article-title a {
        color: #222;
        text-decoration: none;
        transition: color 0.2s;
    }
    .article-title a:hover {
        color: #9f224e;
    }
    
    .article-summary {
        font-size: 0.95rem;
        line-height: 1.5;
        color: #555;
    }

    /* Thumbnail Style */
    .article-thumb {
        width: 220px; /* Chiều rộng cố định cho ảnh */
        flex-shrink: 0;
    }
    .article-thumb img {
        width: 100%;
        height: 140px;
        object-fit: cover;
        border-radius: 3px;
    }
    
    .separator {
        border-top: 1px solid #f0f0f0;
        margin: 20px 0;
    }

    /* Responsive mobile */
    @media (max-width: 768px) {
        .article-item-vne {
            flex-direction: column-reverse; /* Đảo ngược để ảnh lên trên mobile */
        }
        .article-thumb {
            width: 100%;
            margin-bottom: 10px;
        }
        .article-thumb img {
            height: auto;
            aspect-ratio: 16/9;
        }
        .article-content {
            padding-right: 0 !important;
        }
    }
</style>
@endsection