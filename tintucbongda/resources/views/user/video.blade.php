@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>{{ $video->tieu_de }}</h1>

        <div class="ratio ratio-21x9 mb-4">
            {!! $video->url !!}
        </div>
    </div>
    <style>
        .ratio.ratio-21x9 {
            height: 600px;
            /* tăng chiều cao khung video */
        }

        .ratio.ratio-21x9 iframe {
            width: 100%;
            height: 100%;
        }

        .container.mt-5 {
            max-width: 1200px;
            /* tăng chiều rộng tối đa */
        }

        h1 {
            font-size: 3rem;
            /* tăng kích thước chữ */
            font-weight: bold;
            /* chữ đậm */
            text-align: center;
            /* căn giữa */
            margin-bottom: 20px;
            /* khoảng cách dưới */
            color: #2c3e50;
            /* màu chữ đẹp hơn */
        }

        .ratio iframe {
            width: 100%;
            height: 100%;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection
