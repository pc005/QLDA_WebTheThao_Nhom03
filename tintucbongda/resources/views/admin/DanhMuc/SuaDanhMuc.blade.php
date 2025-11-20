@extends('layouts.app') {{-- hoặc layouts.app nếu bạn dùng layout khác --}}

@section('content')
    <div class="container">
        <h1>Sửa danh mục</h1>

        {{-- Hiển thị thông báo lỗi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form sửa danh mục --}}
        <form action="{{ route('danhmucs.update', $danhMuc->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="ten_danh_muc">Tên danh mục</label>
                <input type="text" name="ten_danh_muc" id="ten_danh_muc" class="form-control"
                    value="{{ old('ten_danh_muc', $danhMuc->ten_danh_mucn) }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="danh_muc_cha_id">Danh mục cha</label>
                <select class="form-control" id="danh_muc_cha_id" name="danh_muc_cha_id">
                    <option value="">-- Không có --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->ten_danh_muc }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="mo_ta">Mô tả</label>
                <textarea name="mo_ta" id="mo_ta" class="form-control" rows="3">{{ old('mo_ta', $danhMuc->mo_ta) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('danhmucs.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
