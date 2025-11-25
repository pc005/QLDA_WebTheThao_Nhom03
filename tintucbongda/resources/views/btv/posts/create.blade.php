@extends('btv.layouts.btv')

@section('title', 'Tạo bài viết')

@section('content')
<style>
    .form-label { font-weight: 600; color: #111827; }
    .form-control, .form-select { border-radius: 8px; border: 1px solid #e5e7eb; }
    .form-control:focus, .form-select:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
    .btn-submit { background: #3b82f6; border: none; border-radius: 8px; padding: 10px 24px; font-weight: 600; }
    .btn-submit:hover { background: #2563eb; }
    .card { border-radius: 12px; border: 1px solid #e5e7eb; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
</style>

<div class="page-inner">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h4 class="dashboard-title">Tạo bài viết mới</h4>
        <a href="{{ route('btv.posts.index') }}" class="btn btn-outline-secondary">Quay lại</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Lỗi!</strong>
            <ul class="mb-0 ms-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="p-4 card">
        <form action="{{ route('btv.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Tiêu đề -->
            <div class="mb-3">
                <label for="tieu_de" class="form-label">Tiêu đề bài viết <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('tieu_de') is-invalid @enderror" id="tieu_de" name="tieu_de" placeholder="Nhập tiêu đề..." value="{{ old('tieu_de') }}" required>
                @error('tieu_de') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <!-- Danh mục -->
            <div class="mb-3">
                <label for="danh_muc_id" class="form-label">Danh mục <span class="text-danger">*</span></label>
                <select class="form-select @error('danh_muc_id') is-invalid @enderror" id="danh_muc_id" name="danh_muc_id" required>
                    <option value="">-- Chọn danh mục --</option>
                    @if(isset($categories) && $categories->count())
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('danh_muc_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->ten_danh_muc }}
                            </option>
                        @endforeach
                    @endif
                </select>
                @error('danh_muc_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <!-- Tóm tắt -->
            <div class="mb-3">
                <label for="tom_tat" class="form-label">Tóm tắt</label>
                <textarea class="form-control @error('tom_tat') is-invalid @enderror" id="tom_tat" name="tom_tat" rows="3" placeholder="Nhập tóm tắt bài viết..." value="{{ old('tom_tat') }}"></textarea>
                @error('tom_tat') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <!-- Nội dung -->
            <div class="mb-3">
                <label for="noi_dung" class="form-label">Nội dung <span class="text-danger">*</span></label>
                <textarea class="form-control @error('noi_dung') is-invalid @enderror" id="noi_dung" name="noi_dung" rows="6" placeholder="Nhập nội dung bài viết..." required>{{ old('noi_dung') }}</textarea>
                @error('noi_dung') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <!-- Hình ảnh đại diện -->
            <div class="mb-3">
                <label for="anh_dai_dien" class="form-label">Hình ảnh đại diện</label>
                <input type="file" class="form-control @error('anh_dai_dien') is-invalid @enderror" id="anh_dai_dien" name="anh_dai_dien" accept="image/*">
                <small class="text-muted">Định dạng: JPG, PNG. Kích thước tối đa: 2MB</small>
                @error('anh_dai_dien') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <!-- Trạng thái -->
            <div class="mb-3">
                <label for="trang_thai" class="form-label">Trạng thái</label>
                <select class="form-select" id="trang_thai" name="trang_thai">
                    <option value="Chờ duyệt" selected>Chờ duyệt</option>
                    <option value="Nháp">Nháp</option>
                </select>
                <small class="text-muted">Bài viết sẽ được gửi cho Admin duyệt</small>
            </div>

            <!-- Nổi bật -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="noi_bat" name="noi_bat" value="1">
                <label class="form-check-label" for="noi_bat">Đánh dấu nổi bật</label>
            </div>

            <!-- Nút submit -->
            <div class="gap-2 d-flex">
                <button type="submit" class="text-white btn btn-submit">Tạo bài viết</button>
                <a href="{{ route('btv.posts.index') }}" class="btn btn-outline-secondary">Hủy</a>
            </div>
        </form>
    </div>
</div>

@endsection
