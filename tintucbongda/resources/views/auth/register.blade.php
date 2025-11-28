<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>
<body>

<div class="login-wrapper">
    <div class="login-box">

        <div class="login-header">
            <img src="{{ asset('images/icons/user.png') }}" alt="User Icon" class="login-icon">
            <h2>Tạo Tài Khoản</h2>
        </div>

        <form method="POST" action="{{ route('register.post') }}">
            @csrf

            <input type="text" name="ho_ten" placeholder="Họ và tên" class="login-input" value="{{ old('ho_ten') }}">

            <input type="email" name="email" placeholder="Email" class="login-input" value="{{ old('email') }}">

            <input type="password" name="password" placeholder="Mật khẩu" class="login-input">

            <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu" class="login-input">

            <button type="submit" class="login-btn">Đăng ký</button>
        </form>

        <div class="login-footer">
            <a href="{{ route('login') }}">Đã có tài khoản? Đăng nhập</a>
        </div>

    </div>
</div>
    

<style>
    body {
        margin: 0;
        font-family: Poppins, sans-serif;
        background: linear-gradient(135deg, #4dadff, #1e8df3);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-wrapper {
        width: 100%;
        max-width: 420px;
    }

    .login-box {
        background: #ffffff;
        padding: 40px 30px;
        border-radius: 16px;
        box-shadow: 0px 10px 40px rgba(0,0,0,0.2);
        text-align: center;
        animation: fadeIn 0.7s ease;
    }

    .login-icon {
        width: 70px;
        height: 70px;
        object-fit: cover;
        margin-bottom: 10px;
    }

    .login-input {
        width: 100%;
        padding: 12px 15px;
        margin: 10px 0;
        border: 1px solid #d9d9d9;
        border-radius: 8px;
        font-size: 15px;
    }

    .login-btn {
        width: 100%;
        background: #1e8df3;
        color: #fff;
        padding: 13px;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        margin-top: 15px;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Hiển thị thông báo -->
{!! Toastr::message() !!}

</body>
</html>
