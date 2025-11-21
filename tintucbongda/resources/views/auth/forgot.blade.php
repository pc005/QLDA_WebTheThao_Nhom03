<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quên mật khẩu</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>
<body>

<div class="login-wrapper">
    <div class="login-box">

        <div class="login-header">
            <img src="{{ asset('images/icons/user.png') }}" class="login-icon">
            <h2>Quên mật khẩu</h2>
            {{-- <h2>Não Cá Vàng Hả Mạy"Dừa Lòng Tao Lắm"</h2> --}}
        </div>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <input type="email" name="email" placeholder="Nhập email của bạn"
                   class="login-input" value="{{ old('email') }}">

            <button type="submit" class="login-btn">Gửi liên kết đặt lại</button>
        </form>

        <div class="login-footer">
            <a href="{{ route('login.show') }}">Quay lại đăng nhập</a>
        </div>

    </div>
</div>

<style>
    body { margin: 0; font-family: Poppins, sans-serif; background: linear-gradient(135deg,#4dadff,#1e8df3); height:100vh; display:flex; justify-content:center; align-items:center }
    .login-wrapper { width:100%; max-width:420px }
    .login-box { background:#fff; padding:40px 30px; border-radius:16px; box-shadow:0 10px 40px rgba(0,0,0,.2); text-align:center; animation:fadeIn .7s ease }
    .login-icon { width:70px; height:70px; margin-bottom:10px }
    .login-input { width:100%; padding:12px 15px; margin:10px 0; border-radius:8px; border:1px solid #ddd }
    .login-btn { width:100%; padding:13px; border:none; border-radius:8px; background:#1e8df3; color:#fff; font-weight:600; margin-top:15px }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

{!! Toastr::message() !!}

</body>
</html>
