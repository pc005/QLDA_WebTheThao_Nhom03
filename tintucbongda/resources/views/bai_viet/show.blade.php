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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.min.css') }}">

    <div class="container">
        <!-- Tiêu đề và Nút Yêu Thích -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="bai-viet-title">{{ $baiViet->tieu_de }}</h1>

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
          <!-- ==================================================================== -->
        <!-- KHU VỰC BÌNH LUẬN (STYLE VNEXPRESS - KHÔNG TAB) -->
        <!-- ==================================================================== -->
        <div id="comment-section" class="mt-5 mb-5 p-3 bg-white rounded shadow-sm">
            <h4 class="mb-4 font-weight-bold" style="border-left: 4px solid #9f224e; padding-left: 10px; color: #333;">
                Ý kiến <span id="comment-count" class="text-muted" style="font-size: 0.8em;">(0)</span>
            </h4>

            <!-- Form nhập bình luận -->
            @auth
                <div class="comment-input-box mb-4">
                    <textarea id="comment-content" class="form-control" rows="3" placeholder="Chia sẻ ý kiến của bạn..."></textarea>
                    <div class="d-flex justify-content-end mt-2">
                        <button id="btn-submit-comment" class="btn btn-vne-primary px-4">Gửi</button>
                    </div>
                </div>
            @else
                <div class="alert alert-light text-center border mb-4">
                    <a href="{{ route('login') }}" class="text-danger font-weight-bold">Đăng nhập</a> để gửi bình luận.
                </div>
            @endauth

            <!-- Danh sách bình luận -->
            <div id="comment-list">
                <!-- Comments will be loaded here via JS -->
                <div class="text-center py-3"><i class="fas fa-spinner fa-spin"></i> Đang tải ý kiến...</div>
            </div>
        </div>
        <!-- ==================================================================== -->
        </div>
    <style>
     /* CSS Mới cho Bình Luận (VNExpress Style) */
        .btn-vne-primary { background-color: #9f224e; color: #fff; border: none; font-weight: 500; }
        .btn-vne-primary:hover { background-color: #851c41; color: #fff; }
        .comment-item { display: flex; gap: 15px; margin-bottom: 20px; }
        .comment-avatar { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; background: #eee; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #666; font-size: 18px; }
        .comment-body { flex: 1; }
        .comment-name { font-weight: 700; color: #222; margin-right: 10px; }
        .comment-content { color: #333; line-height: 1.5; }
        .comment-actions { display: flex; gap: 15px; margin-top: 5px; font-size: 0.85rem; color: #757575; }
        .action-link { cursor: pointer; display: flex; align-items: center; gap: 4px; }
        .action-link:hover { color: #9f224e; }
        .border-bottom-active { border-bottom: 2px solid #9f224e !important; color: #9f224e !important; }
        .comment-input-box textarea { background: #fafafa; border: 1px solid #eee; resize: none; }
        .comment-input-box textarea:focus { background: #fff; border-color: #9f224e; box-shadow: none; }
    </style>

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

    <style>
        /* CSS MỚI CHO AVATAR - BẮT BUỘC PHẢI CÓ */
        .avatar-wrapper { 
            position: relative; 
            width: 40px; 
            height: 40px; 
            flex-shrink: 0;
            margin-right: 10px; /* Thêm khoảng cách với tên */
        }
        
        .comment-avatar-img { 
            width: 100%; 
            height: 100%; 
            border-radius: 50%; 
            object-fit: cover; 
            position: absolute; /* Đè lên chữ */
            top: 0; 
            left: 0; 
            z-index: 2;
            background-color: white; 
        }
        
        .comment-avatar-text { 
            width: 100%; 
            height: 100%; 
            border-radius: 50%; 
            background: #eee; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-weight: bold; 
            color: #666; 
            font-size: 18px; 
            position: absolute; /* Nằm dưới */
            top: 0; 
            left: 0; 
            z-index: 1;
        }
    </style>
    {{-- Script AJAX/Fetch API (Sử dụng Fetch API) --}}
    @push('scripts')
         <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- XỬ LÝ NÚT LƯU (CŨ) ---
            const btnSave = document.getElementById('toggle-favorite-btn');
            if(btnSave) {
                btnSave.addEventListener('click', function() {
                    const icon = btnSave.querySelector('.bookmark-icon');
                    // ... (Code cũ của bạn giữ nguyên, tôi viết gọn lại)
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                    fetch('{{ route('favorites.toggle') }}', {
                        method: 'POST',
                        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken},
                        body: JSON.stringify({ model_id: btnSave.dataset.id, model_type: btnSave.dataset.type })
                    }).then(res => res.json()).then(data => {
                        if(data.is_favorited) {
                            btnSave.classList.add('is-saved'); icon.classList.replace('far', 'fas');
                        } else {
                            btnSave.classList.remove('is-saved'); icon.classList.replace('fas', 'far');
                        }
                    });
                });
            }

           // --- XỬ LÝ BÌNH LUẬN (MỚI - ĐÃ CẬP NHẬT BẮT LỖI) ---
            const baiVietId = {{ $baiViet->id }};
            const commentList = document.getElementById('comment-list');
            const commentCount = document.getElementById('comment-count');
            const commentInput = document.getElementById('comment-content');
            const btnSubmit = document.getElementById('btn-submit-comment');
            
            // Lấy CSRF token an toàn
            const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfTokenMeta ? csrfTokenMeta.content : '';

            // HÀM RENDER AVATAR THÔNG MINH
            function getAvatar(name, imgUrl) {
                // 1. Lấy chữ cái đầu tên (Ví dụ: "Nam" -> "N")
                const char = name ? name.charAt(0).toUpperCase() : 'U';
                
                // 2. Tạo HTML cho lớp nền (hiển thị chữ cái)
                const fallbackHtml = `<div class="comment-avatar-text">${char}</div>`;
                
                // 3. Nếu có đường dẫn ảnh
                if (imgUrl && imgUrl !== 'null' && imgUrl !== '') {
                    // Trả về cấu trúc gồm 2 lớp:
                    // - Lớp dưới: fallbackHtml (chữ cái)
                    // - Lớp trên: thẻ img. 
                    // Nếu img lỗi (onerror), nó tự ẩn mình đi (display='none') để lộ lớp dưới ra.
                    return `
                        <div class="avatar-wrapper">
                            ${fallbackHtml}
                            <img src="${imgUrl}" 
                                 class="comment-avatar-img" 
                                 alt="${name}"
                                 onerror="this.style.display='none'">
                        </div>
                    `;
                }

                // 4. Nếu không có đường dẫn ảnh -> chỉ trả về lớp nền
                return `<div class="avatar-wrapper">${fallbackHtml}</div>`;
            }

            // 2. Load danh sách bình luận
            function loadComments() {
                fetch(`/binh-luan/${baiVietId}`)
                    .then(res => res.json())
                    .then(data => {
                        if(commentCount) commentCount.textContent = `(${data.length})`;
                        if (data.length === 0) {
                            commentList.innerHTML = '<p class="text-muted text-center">Chưa có ý kiến nào. Hãy là người đầu tiên!</p>';
                            return;
                        }

                        let html = '';
                        data.forEach(cmt => {
                            html += `
                                <div class="comment-item" id="comment-${cmt.id}">
                                    ${getAvatar(cmt.ho_ten, cmt.anh_dai_dien)}
                                    <div class="comment-body">
                                        <div class="mb-1">
                                            <span class="comment-name">${cmt.ho_ten}</span>
                                            <span class="comment-content" id="content-${cmt.id}">${cmt.noi_dung}</span>
                                        </div>
                                        <div class="comment-actions">
                                            <span class="action-link"><i class="far fa-thumbs-up"></i> Thích</span>
                                            <span class="action-link">Trả lời</span>
                                            <span>${cmt.ngay_tao}</span>
                                            ${cmt.can_edit ? `
                                                <span class="action-link text-primary ml-auto" onclick="editComment(${cmt.id}, '${cmt.noi_dung}')">Sửa</span>
                                                <span class="action-link text-danger" onclick="deleteComment(${cmt.id})">Xóa</span>
                                            ` : ''}
                                        </div>
                                        <!-- Form sửa ẩn -->
                                        <div id="edit-form-${cmt.id}" class="mt-2" style="display:none;">
                                            <textarea class="form-control mb-2" id="edit-input-${cmt.id}" rows="2"></textarea>
                                            <button onclick="saveEdit(${cmt.id})" class="btn btn-sm btn-vne-primary">Lưu</button>
                                            <button onclick="cancelEdit(${cmt.id})" class="btn btn-sm btn-light">Hủy</button>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });
                        commentList.innerHTML = html;
                    });
            }

            // 3. Gửi bình luận mới (UPDATED)
            if (btnSubmit) {
                btnSubmit.addEventListener('click', function() {
                    const content = commentInput.value.trim();
                    if (!content) return alert('Vui lòng nhập nội dung!');

                    // Kiểm tra CSRF
                    if (!csrfToken) return alert('Lỗi: Thiếu CSRF Token trong thẻ meta.');

                    btnSubmit.disabled = true;
                    btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

                    fetch('{{ route("binh-luan.store") }}', {
                        method: 'POST',
                        headers: { 
                            'Content-Type': 'application/json', 
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json' // Quan trọng để Laravel trả về JSON khi lỗi
                        },
                        body: JSON.stringify({ bai_viet_id: baiVietId, noi_dung: content })
                    })
                    .then(async res => {
                        // Nếu server trả về lỗi (400, 401, 403, 500...)
                        if (!res.ok) {
                            const errorData = await res.json().catch(() => ({})); 
                            // Ưu tiên hiện lỗi validate
                            if (errorData.message) throw new Error(errorData.message);
                            if (errorData.errors) throw new Error(Object.values(errorData.errors).flat().join('\n'));
                            throw new Error(`Lỗi server: ${res.status}`);
                        }
                        return res.json();
                    })
                    .then(data => {
                        commentInput.value = '';
                        loadComments(); // Reload lại danh sách
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Không gửi được: ' + err.message); // Hiển thị lỗi chi tiết
                    })
                    .finally(() => {
                        btnSubmit.disabled = false;
                        btnSubmit.innerText = 'Gửi';
                    });
                });
            }

            // 4. Các hàm global (Sửa, Xóa, Lưu)
            window.deleteComment = function(id) {
                if (!confirm('Bạn chắc chắn muốn xóa?')) return;
                fetch(`/binh-luan/${id}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': csrfToken }
                }).then(() => {
                    document.getElementById(`comment-${id}`).remove();
                });
            };

            window.editComment = function(id, oldContent) {
                document.getElementById(`content-${id}`).style.display = 'none';
                const form = document.getElementById(`edit-form-${id}`);
                const input = document.getElementById(`edit-input-${id}`);
                form.style.display = 'block';
                input.value = oldContent;
            };

            window.cancelEdit = function(id) {
                document.getElementById(`content-${id}`).style.display = 'inline';
                document.getElementById(`edit-form-${id}`).style.display = 'none';
            };

            window.saveEdit = function(id) {
                // 1. Lấy nội dung mới từ ô textarea
                const newContent = document.getElementById(`edit-input-${id}`).value.trim();
                
                // Kiểm tra nếu nội dung rỗng
                if (!newContent) {
                    alert('Nội dung bình luận không được để trống!');
                    return;
                }

                // 2. Gửi yêu cầu cập nhật lên server
                fetch(`/binh-luan/${id}`, {
                    method: 'PUT',
                    headers: { 
                        'Content-Type': 'application/json', 
                        'X-CSRF-TOKEN': csrfToken,    // Bắt buộc phải có Token
                        'Accept': 'application/json'  // Bắt buộc để nhận lỗi JSON từ Laravel
                    },
                    body: JSON.stringify({ noi_dung: newContent })
                })
                .then(async res => {
                    // 3. Kiểm tra xem server có trả về lỗi không
                    if (!res.ok) {
                        const errorData = await res.json().catch(() => ({}));
                        throw new Error(errorData.message || 'Có lỗi xảy ra khi cập nhật');
                    }
                    return res.json();
                })
                .then(() => {
                    // 4. Thành công -> Tải lại danh sách bình luận
                    loadComments();
                })
                .catch(err => {
                    // 5. Hiển thị lỗi nếu có
                    alert(err.message);
                });
            };

            // Chạy lần đầu
            loadComments();
        });
    </script>
    @endpush
@endsection
