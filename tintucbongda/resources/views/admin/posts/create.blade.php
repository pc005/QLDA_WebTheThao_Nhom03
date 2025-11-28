@extends('admin.layouts.admin')

@section('content')
<style>
    .form-label { font-weight: 600; color: #111827; }
    .form-control, .form-select { border-radius: 8px; border: 1px solid #e5e7eb; }
    .btn-submit { background: #3b82f6; border: none; border-radius: 8px; padding: 10px 24px; font-weight: 600; }
    .card { border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
</style>

<div class="page-inner">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h4 class="dashboard-title">Tạo bài viết (Admin)</h4>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">Quay lại</a>
    </div>

    <div class="card p-4">
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="tieu_de" class="form-label">Tiêu đề bài viết <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="tieu_de" name="tieu_de" placeholder="Nhập tiêu đề..." required>
            </div>

            <div class="mb-3">
                <label for="danh_muc_id" class="form-label">Danh mục <span class="text-danger">*</span></label>
                <select class="form-select" id="danh_muc_id" name="danh_muc_id" required>
                    <option value="">-- Chọn danh mục --</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="noi_dung" class="form-label">Nội dung <span class="text-danger">*</span></label>
                <textarea class="form-control" id="noi_dung" name="noi_dung" rows="6" placeholder="Nhập nội dung bài viết..." required></textarea>
            </div>

            <div class="mb-3">
                <label for="anh_dai_dien" class="form-label">Hình ảnh đại diện</label>
                <input type="file" class="form-control" id="anh_dai_dien" name="anh_dai_dien" accept="image/*">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-submit text-white">Tạo bài viết</button>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">Hủy</a>
            </div>
        </form>
    </div>
</div>

@endsection
