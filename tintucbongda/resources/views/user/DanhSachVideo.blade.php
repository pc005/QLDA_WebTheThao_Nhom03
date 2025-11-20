{{-- @extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">📹 Danh sách video</h2>

        @if ($videos->isEmpty())
            <div class="alert alert-warning">Chưa có video nào.</div>
        @else
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>URL</th>
                        <th>Bài viết ID</th>
                        <th>Người dùng ID</th>
                        <th>Trạng thái</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($videos as $video)
                        <tr>
                            <td>{{ $video->id }}</td>
                            <td>{{ $video->tieu_de }}</td>
                            <td><a href="{{ $video->url }}" target="_blank">Xem video</a></td>
                            <td>{{ $video->bai_viet_id }}</td>
                            <td>{{ $video->nguoi_dung_id }}</td>
                            <td>{{ $video->trang_thai ?? 'Chưa cập nhật' }}</td>
                            <td>{{ $video->ngay_tao ?? '-' }}</td>
                            <td>{{ $video->ngay_cap_nhat ?? '-' }}</td>
                            <td>{{ optional($video->created_at)->format('Y-m-d H:i') }}</td>
                            <td>{{ optional($video->updated_at)->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $videos->links() }}
            </div>
        @endif
    </div>
@endsection --}}

@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">📹 Video nổi bật</h2>

        @if ($videos->isEmpty())
            <div class="alert alert-info">Hiện chưa có video nào để hiển thị.</div>
        @else
            <div class="row">
                @foreach ($videos as $video)
                    @php
                        // Tách video_id từ nhiều dạng URL YouTube
                        $videoId = null;
                        $url = $video->url ?? '';
                        $host = parse_url($url, PHP_URL_HOST);
                        $path = parse_url($url, PHP_URL_PATH);
                        $query = parse_url($url, PHP_URL_QUERY);

                        // Trường hợp watch?v=ID
                        if ($query) {
                            parse_str($query, $params);
                            $videoId = $params['v'] ?? null;
                        }

                        // Nếu chưa có, thử các dạng khác: /embed/ID, youtu.be/ID, /shorts/ID
                        if (!$videoId) {
                            $segments = array_values(array_filter(explode('/', $path)));
                            if (($segments[0] ?? null) === 'embed' && !empty($segments[1])) {
                                $videoId = $segments[1];
                            } elseif (($segments[0] ?? null) === 'shorts' && !empty($segments[1])) {
                                $videoId = $segments[1];
                            } elseif (($host ?? '') === 'youtu.be' && !empty($segments[0])) {
                                $videoId = $segments[0];
                            } elseif (!empty($segments)) {
                                // Dự phòng: lấy phần tử cuối cùng
                                $videoId = end($segments);
                            }
                        }
                    @endphp

                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            @if ($videoId)
                                <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg" alt="Thumbnail"
                                    class="card-img-top rounded-top">
                            @else
                                <img src="https://via.placeholder.com/350x200?text=Video" alt="Thumbnail"
                                    class="card-img-top rounded-top">
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $video->tieu_de }}</h5>
                                <p class="card-text">
                                    <small class="text-muted">
                                        Đăng ngày {{ optional($video->created_at)->format('d/m/Y H:i') }}
                                    </small>
                                </p>
                                <a href="{{ route('video.show', $video->id) }}" class="btn btn-primary w-100">▶ Xem
                                    video</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Phân trang -->
            <div class="d-flex justify-content-center mt-4">
                {{ $videos->links() }}
            </div>
        @endif
    </div>
@endsection
