<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Quản lý Danh mục</title>
</head>

<body>
    <div class="container">
        @yield('content')
    </div>
</body>

</html>

<style>
    /* Tổng quát */
    body {
        background-color: #f8f9fa;
        /* Màu nền sáng */
        font-family: Arial, sans-serif;
        /* Font chữ */
    }

    /* Container chính */
    .container {
        max-width: 800px;
        /* Chiều rộng tối đa */
        margin: 30px auto;
        /* Trung tâm trang */
        padding: 20px;
        /* Khoảng cách bên trong */
        background-color: #fff;
        /* Màu nền trắng */
        border-radius: 8px;
        /* Bo tròn các góc */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        /* Đổ bóng */
    }

    /* Tiêu đề */
    h1 {
        text-align: center;
        /* Căn giữa tiêu đề */
        color: #007bff;
        /* Màu chữ tiêu đề */
    }

    /* Bảng */
    .table {
        width: 100%;
        /* Chiều rộng bảng */
        margin-top: 20px;
        /* Khoảng cách phía trên */
    }

    .table th,
    .table td {
        padding: 12px;
        /* Khoảng cách trong ô */
        text-align: left;
        /* Căn trái cho văn bản */
        border-bottom: 1px solid #dee2e6;
        /* Đường viền dưới ô */
    }

    .table th {
        background-color: #f2f2f2;
        /* Màu nền tiêu đề */
    }

    /* Nút */
    .btn {
        border-radius: 5px;
        /* Bo tròn các góc nút */
        padding: 10px 15px;
        /* Khoảng cách trong nút */
    }

    .btn-primary {
        background-color: #007bff;
        /* Màu nền chín cho nút */
        color: white;
        /* Màu chữ cho nút */
    }

    .btn-success {
        background-color: #28a745;
        /* Màu xanh cho nút thành công */
        color: white;
    }

    .btn-warning {
        background-color: #ffc107;
        /* Màu vàng cho nút sửa */
        color: black;
    }

    .btn-danger {
        background-color: #dc3545;
        /* Màu đỏ cho nút xóa */
        color: white;
    }

    /* Hiệu ứng hover cho nút */
    .btn:hover {
        opacity: 0.9;
        /* Hiệu ứng giảm độ mờ khi hover */
    }

    /* Form */
    .form-group {
        margin-bottom: 15px;
        /* Khoảng cách giữa các nhóm */
    }

    .form-control {
        width: 100%;
        /* Chiều rộng đầy đủ */
        padding: 10px;
        /* Khoảng cách bên trong */
        border: 1px solid #ced4da;
        /* Đường viền cho input */
        border-radius: 5px;
        /* Bo tròn các góc */
        transition: border-color 0.3s;
        /* Hiệu ứng chuyển màu viền */
    }

    .form-control:focus {
        border-color: #007bff;
        /* Đổi màu viền khi focus */
        outline: none;
        /* Tắt viền cơ bản */
    }

    /* Thông báo lỗi */
    .alert {
        margin-top: 20px;
        /* Khoảng cách phía trên */
        border-radius: 5px;
        /* Bo tròn các góc */
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            margin: 10px;
            /* Giảm khoảng cách trên thiết bị di động */
        }

        .btn {
            width: 100%;
            /* Nút đầy chiều rộng trên di động */
            margin-bottom: 10px;
            /* Khoảng cách giữa các nút */
        }

        .table {
            font-size: 14px;
            /* Kích thước chữ nhỏ hơn trên di động */
        }
    }
</style>
