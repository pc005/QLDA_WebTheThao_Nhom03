@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Quản lý Danh mục</h1>
        <a href="{{ route('danhmucs.create') }}" class="btn btn-primary">Thêm Danh mục</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Danh Mục</th>
                    <th>Mô Tả</th>
                    <th>Danh Mục Cha ID</th>
                    <th>Trạng Thái</th>
                    <th>Ngày Tạo</th>
                    <th>Ngày Cập Nhật</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($danhMucs as $danhMuc)
                    <tr>
                        <td>{{ $danhMuc->id }}</td>
                        <td>{{ $danhMuc->ten_danh_muc }}</td>
                        <td>{{ $danhMuc->mo_ta }}</td>
                        <td>{{ $danhMuc->danh_muc_cha_id }}</td>
                        <td>{{ $danhMuc->trang_thai }}</td>
                        <td>{{ $danhMuc->created_at }}</td>
                        <td>{{ $danhMuc->updated_at }}</td>
                        <td>
                            <a href="{{ route('danhmucs.edit', $danhMuc) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('danhmucs.destroy', $danhMuc) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
