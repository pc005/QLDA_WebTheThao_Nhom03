@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <h1>Quản lý Danh mục</h1>
        <a href="{{ route('danhmucs.create') }}" class=" adddanhmuc btn btn-primary">Thêm Danh mục</a>

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
                            <a href="{{ route('danhmucs.edit', $danhMuc) }}" class="a btn btn-warning">Sửa</a>
                            <form action="{{ route('danhmucs.destroy', $danhMuc) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class=" a btn btn-danger">Xóa</button>
                                <style>
                                    .adddanhmuc {

                                        margin-bottom: 10px;

                                    }

                                    .a {
                                        margin-top: 5px;
                                        width: 60px;
                                    }
                                </style>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
