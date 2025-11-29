@extends('admin.layouts.admin') {{-- Đảm bảo đường dẫn layout này là đúng --}}

@section('content')
    <div class="container">
        <h1>Quản lý Video</h1>

        {{-- Nút Thêm Video Mới, giả sử route tạo mới là 'videos.create' --}}
        <a href="{{ route('videos.create') }}" class="add-button btn btn-primary">Thêm Video Mới</a>

        @if (session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu Đề</th>
                    <th>Slug</th>
                    <th>URL Video</th>
                    <th>Trạng Thái</th>
                    <th>Ngày Tạo</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($videos as $video)
                    <tr>
                        <td>{{ $video->id }}</td>
                        <td>{{ $video->tieu_de }}</td>
                        <td>{{ $video->slug }}</td>
                        <td>
                            @if ($video->video_url)
                                <a href="{{ $video->video_url }}" target="_blank" class="btn btn-sm btn-info">Xem Video</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $video->trang_thai }}</td>
                        <td>{{ $video->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            {{-- Nút Sửa, giả sử route sửa là 'videos.edit' --}}
                            {{-- Dùng tên Route admin.videos.editvideo để tạo ra URL /admin/videos/ID/edit --}}
                            {{-- <a href="{{ route('admin.videos.editvideo', $video) }}" class="action-btn btn btn-warning">Sửa</a> --}}
                            <a href="/admin" class="action-btn btn btn-warning">Sửa</a>
                            {{-- Form Xóa, giả sử route xóa là 'videos.destroy' --}}
                            <form action="{{ route('videos.destroy', $video) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa video: {{ $video->tieu_de }} không?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Hiển thị phân trang --}}
        <div class="d-flex justify-content-center">
            {{ $videos->links() }}
        </div>
    </div>

    <style>
        .add-button {
            margin-bottom: 15px;
        }

        .action-btn {
            margin-top: 5px;
            width: 70px;
        }
    </style>
@endsection
