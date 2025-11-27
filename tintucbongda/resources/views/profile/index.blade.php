<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin Tài khoản - {{ Auth::user()->ho_ten ?? 'Tài khoản' }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        /* CSS Sidebar và Chung (SAO CHÉP TỪ index.blade.php) */
        body { background-color: #f8f8f8; }
        .sidebar-card { border-radius: 0; border: none; box-shadow: 0 1px 3px rgba(0,0,0,.1); }
        .avatar-circle { width: 60px; height: 60px; border-radius: 50%; background-color: #e0e0e0; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
        .list-group-flush .list-group-item { border-left: 3px solid transparent; }
        .active-vnexpress-style { background-color: #f3f3f3 !important; border-left: 3px solid #007bff !important; color: #007bff !important; font-weight: 600; }
        .profile-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        .profile-row:last-child {
            border-bottom: none;
        }
        .change-avatar-link {
            cursor: pointer;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container my-5">
    
    {{-- 1. THÔNG BÁO THÀNH CÔNG (Màu Xanh) --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="auto-dismiss-alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- 2. THÔNG BÁO LỖI HỆ THỐNG (Màu Đỏ - dùng key 'error') --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- 3. THÔNG BÁO LỖI VALIDATION (Khi nhập sai form) --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> Vui lòng kiểm tra lại thông tin nhập vào:
            <ul class="mb-0 mt-2 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="row">

        <!-- 1. Thanh Điều Hướng Cá Nhân (Sidebar) -->
        <div class="col-md-3">
            @auth
                <!-- ... (Mã Sidebar giữ nguyên, sử dụng $user) ... -->
                <div class="card sidebar-card mb-4">
                    <div class="card-body p-4 border-bottom">
                        {{-- Avatar --}}
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar-circle me-3 flex-shrink-0">
                                @if ($user->anh_dai_dien)
                                    <img src="{{ asset('storage/' . $user->anh_dai_dien) }}" alt="Avatar" class="img-fluid rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    <i class="fas fa-user"></i>
                                @endif
                            </div>
                            {{-- Tên người dùng và tham gia --}}
                            <div>
                                <h6 class="fw-bold mb-0">{{ $user->ho_ten ?? 'Tài khoản' }}</h6>
                                <p class="text-muted small mb-0">Tham gia từ <span>{{ optional($user->ngay_tao)->format('d/m/Y') ?? 'Chưa xác định' }}</span></p>
                            </div>
                        </div>
                    </div>

                    {{-- Menu Điều Hướng --}}
                    <div class="list-group list-group-flush">
                        <a href="{{ route('profile.index') }}" class="list-group-item list-group-item-action active-vnexpress-style">
                            Thông tin chung
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">Ý kiến của bạn (0)</a>
                        <a href="{{ route('favorites.index') }}" class="list-group-item list-group-item-action">
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

        <!-- 2. Khu Vực Nội Dung Chính (Thông tin tài khoản) -->
        <div class="col-md-9">
            <div class="card sidebar-card p-4">
                <h4 class="mb-4 pb-2 border-bottom fw-bold">Thông tin tài khoản</h4>

                <!-- FORM UPLOAD ẢNH ĐẠI DIỆN -->
                <form id="avatar-form" action="{{ route('profile.update.avatar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- HÀNG ẢNH ĐẠI DIỆN -->
                    <div class="profile-row">
                        <div class="d-flex align-items-center">
                            <span class="me-4 fw-bold">Ảnh đại diện</span>
                            <div class="avatar-circle flex-shrink-0" style="width: 40px; height: 40px; font-size: 1rem;">
                                @if ($user->anh_dai_dien)
                                    <img src="{{ asset('storage/' . $user->anh_dai_dien) }}" alt="Avatar" class="img-fluid rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">
                                @else
                                    {{ strtoupper(substr($user->ho_ten ?? 'L', 0, 1)) }}
                                @endif
                            </div>
                        </div>
                        
                        <a id="change-avatar-trigger" class="text-primary small change-avatar-link">Thay ảnh đại diện</a>
                        
                        {{-- Input file ẩn để kích hoạt bằng JS --}}
                        <input type="file" name="avatar" id="avatar-input" class="d-none" accept="image/*">
                        
                        {{-- Nút submit ẩn --}}
                        <button type="submit" id="avatar-submit-btn" class="d-none">Upload</button>

                    </div>
                    
                    {{-- Hiển thị lỗi validation riêng cho avatar --}}
                    @error('avatar')
                        <small class="text-danger mt-1">{{ $message }}</small>
                    @enderror
                </form>
                
                <!-- HÀNG HỌ TÊN -->
                <div class="profile-row">
                    <span class="fw-bold me-4">Họ tên</span>
                    <span class="flex-grow-1">{{ $user->ho_ten }}</span>
    {{-- PHẢI CÓ data-bs-toggle VÀ data-bs-target --}}
                    <a href="#" class="text-primary small change-link" data-bs-toggle="modal" data-bs-target="#changeNameModal">Thay đổi</a>
                </div>
                
                <!-- HÀNG EMAIL -->
                <div class="profile-row">
                    <span class="fw-bold me-4">Email</span>
                    <span class="flex-grow-1">{{ $user->email }}</span>
                    {{-- Thêm data-bs-toggle và target để mở Modal Email --}}
                    <a href="#" class="text-primary small" data-bs-toggle="modal" data-bs-target="#changeEmailModal">Thay đổi</a>
                </div>
                
                <!-- HÀNG MẬT KHẨU -->
                <div class="profile-row">
                    <span class="fw-bold me-4">Mật khẩu</span>
                    <span class="flex-grow-1">••••••••••••</span>
                    {{-- Thêm data-bs-toggle và target để mở Modal Password --}}
                    <a href="#" class="text-primary small change-link" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Thay đổi</a>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="changeNameModal" tabindex="-1" aria-labelledby="changeNameModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="changeNameModalLabel">Đổi tên hiển thị</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    
    {{-- Form gửi dữ liệu --}}
    <form method="POST" action="{{ route('profile.update.name') }}">
        @csrf
        @method('PATCH') {{-- Sử dụng phương thức PATCH để cập nhật --}}
        
        <div class="modal-body">
            <div class="mb-3">
                <label for="ho_ten" class="form-label">Nhập họ tên mới</label>
                {{-- Dùng old() để giữ lại giá trị nếu validate lỗi --}}
                <input type="text" 
                       class="form-control" 
                       id="ho_ten" 
                       name="ho_ten" 
                       value="{{ old('ho_ten', $user->ho_ten) }}" 
                       required>
            </div>
        </div>
        
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
        </div>
    </form>
</div>
  </div>
</div>

<div class="modal fade" id="changeEmailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Thay đổi Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('profile.update.email') }}" method="POST"> @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Mật khẩu hiện tại</label>
                        <div class="input-group">
                            <input type="password" name="current_password" class="form-control password-field" required placeholder="Nhập mật khẩu để xác nhận">
                            <button class="btn btn-outline-secondary toggle-password" type="button"><i class="far fa-eye"></i></button>
                        </div>
                        @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Email mới</label>
                        <input type="email" name="email" class="form-control" required placeholder="Nhập địa chỉ email mới">
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Cập nhật Email</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Đổi mật khẩu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('profile.update.password') }}" method="POST"> @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Mật khẩu hiện tại</label>
                        <div class="input-group">
                            <input type="password" name="current_password" class="form-control password-field" required>
                            <button class="btn btn-outline-secondary toggle-password" type="button"><i class="far fa-eye"></i></button>
                        </div>
                        @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mật khẩu mới</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control password-field" required>
                            <button class="btn btn-outline-secondary toggle-password" type="button"><i class="far fa-eye"></i></button>
                        </div>
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Xác nhận mật khẩu mới</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" class="form-control password-field" required>
                            <button class="btn btn-outline-secondary toggle-password" type="button"><i class="far fa-eye"></i></button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const trigger = document.getElementById('change-avatar-trigger');
        const input = document.getElementById('avatar-input');
        const form = document.getElementById('avatar-form');

        if (trigger && input && form) {
            // 1. Kích hoạt input file khi nhấp vào link
            trigger.addEventListener('click', function (e) {
                e.preventDefault();
                input.click();
            });

            // 2. Tự động submit form khi có file được chọn
            input.addEventListener('change', function () {
                if (input.files.length > 0) {
                    form.submit();
                }
            });
        }
    });

    const togglePasswordButtons = document.querySelectorAll('.toggle-password');
    
    togglePasswordButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Tìm ô input đi kèm với nút này
            const input = this.previousElementSibling;
            
            // Toggle type
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            
            // Toggle icon (Mắt mở / Mắt đóng)
            const icon = this.querySelector('i');
            if (type === 'text') {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // 1. Tự động ẩn thông báo thành công sau 4 giây
        const successAlert = document.getElementById('auto-dismiss-alert');
        if (successAlert) {
            setTimeout(function() {
                // Dùng Bootstrap API để đóng alert
                const alert = new bootstrap.Alert(successAlert);
                alert.close();
            }, 4000); // 4000ms = 4 giây
        }

        // 2. Logic tự động mở lại Modal khi có lỗi Validation
        // Kiểm tra xem Laravel có trả về lỗi nào không
        @if ($errors->any())
            
            // Nếu có lỗi liên quan đến trường 'email' -> Mở Modal Email
            @if ($errors->has('email'))
                var emailModal = new bootstrap.Modal(document.getElementById('changeEmailModal'));
                emailModal.show();
            @endif

            // Nếu có lỗi liên quan đến 'password' hoặc 'password_confirmation' -> Mở Modal Password
            @if ($errors->has('password') || $errors->has('password_confirmation'))
                var passwordModal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
                passwordModal.show();
            @endif
            
            // Lưu ý: Lỗi 'current_password' hơi đặc biệt vì cả 2 form đều dùng chung tên này.
            // Nếu bạn muốn chính xác tuyệt đối, bạn nên đặt tên khác nhau (vd: current_password_email & current_password_pass)
            // Tuy nhiên, thường thì người dùng đổi mật khẩu hay bị sai pass cũ hơn, nên ta ưu tiên mở Modal Password
            @if ($errors->has('current_password') && !$errors->has('email'))
                 var passwordModal = new bootstrap.Modal(document.getElementById('changePasswordModal'));
                 passwordModal.show();
            @endif

        @endif
    });
</script>
</body>
</html>