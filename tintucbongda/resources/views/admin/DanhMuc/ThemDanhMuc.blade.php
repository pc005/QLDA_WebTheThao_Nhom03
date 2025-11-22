@extends('layouts.app') {{-- hoặc layouts.app nếu bạn dùng layout khác --}}

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="ten_danh_muc">Tên danh mục</label>
                <input type="text" class="form-control" id="ten_danh_muc" name="ten_danh_muc" required>
            </div>

            <div class="form-group mb-3">
                <label for="mo_ta">Mô tả</label>
                <textarea class="form-control" id="mo_ta" name="mo_ta"></textarea>
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
                <label for="trang_thai">Trạng thái</label>
                <select class="form-control" id="trang_thai" name="trang_thai" required>
                    <option value="Hoạt động">Hoạt động</option>
                    <option value="Không hoạt động">Không hoạt động</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Thêm</button>
        </form>
    </div>
@endsection
