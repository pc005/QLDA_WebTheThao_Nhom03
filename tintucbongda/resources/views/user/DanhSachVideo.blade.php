{{--

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
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center mt-3">
                {{ $videos->links('pagination::bootstrap-5') }}
            </div>
            <div class="pagination mt-4">
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

                        if ($query) {
                            parse_str($query, $params);
                            $videoId = $params['v'] ?? null;
                        }

                        if (!$videoId) {
                            $segments = array_values(array_filter(explode('/', $path)));
                            if (($segments[0] ?? null) === 'embed' && !empty($segments[1])) {
                                $videoId = $segments[1];
                            } elseif (($segments[0] ?? null) === 'shorts' && !empty($segments[1])) {
                                $videoId = $segments[1];
                            } elseif (($host ?? '') === 'youtu.be' && !empty($segments[0])) {
                                $videoId = $segments[0];
                            } elseif (!empty($segments)) {
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
            <div class="a d-flex flex-column align-items-center justify-content-center mt-3">
                <div class="first-div">
                    {{ $videos->links('pagination::bootstrap-5') }}
                </div>

            </div>
            <style>
                .pagination {
                    margin-left: 40px;


                    display: flex;
                    justify-content: center;
                }

                .small text-muted {
                    margin: 10px;
                }

                /* Định dạng cho thẻ con */
                .first-div,
                .second-div {
                    background-color: #f8f9fa;
                    /* Màu nền */
                    border: 1px solid #ddd;
                    /* Viền */
                    padding: 10px;
                    /* Khoảng cách bên trong */
                    margin: 5px 0;
                    /* Khoảng cách giữa các thẻ con */

                    text-align: center;
                    /* Căn giữa nội dung */
                }
            </style>
        @endif
    </div>
@endsection
