@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <h1>Sửa danh mục</h1>

        {{-- Hiển thị thông báo lỗi --}}
        {{-- Hiển thị thông báo lỗi --}}
        @if ($errors->any())
            <div class="alert alert-danger bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form sửa Video --}}
        <form action="{{ route('admin.videos.update', $video->id) }}" method="POST">
            @csrf
            {{-- Sử dụng phương thức PUT cho việc cập nhật --}}
            @method('PUT')

            {{-- Trường Tiêu Đề --}}
            <div class="form-group mb-4">
                <label for="tieu_de" class="block text-gray-700 font-semibold mb-2">Tiêu đề Video</label>
                <input type="text" name="tieu_de" id="tieu_de"
                    class="form-control w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('tieu_de', $video->tieu_de) }}" required>
            </div>

            {{-- Trường URL Video --}}
            <div class="form-group mb-4">
                <label for="url" class="block text-gray-700 font-semibold mb-2">URL Video (Link YouTube/Video)</label>
                <input type="url" name="url" id="url"
                    class="form-control w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                    value="{{ old('url', $video->url) }}" required>
            </div>

            {{-- Trường Trạng Thái --}}
            <div class="form-group mb-4">
                <label for="trang_thai" class="block text-gray-700 font-semibold mb-2">Trạng thái</label>
                <select
                    class="form-control w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                    id="trang_thai" name="trang_thai" required>
                    {{--
                    Giả định trang_thai là integer (1: Hoạt động, 0: Không hoạt động).
                    Tuy nhiên, dựa trên template cũ, tôi giữ lại giá trị chuỗi
                    và kiểm tra trạng thái hiện tại.
                --}}
                    <option value="Hoạt động" {{ old('trang_thai', $video->trang_thai) == 'Hoạt động' ? 'selected' : '' }}>
                        Hoạt động</option>
                    <option value="Không hoạt động"
                        {{ old('trang_thai', $video->trang_thai) == 'Không hoạt động' ? 'selected' : '' }}>Không hoạt động
                    </option>
                </select>
            </div>

            {{-- Nếu bạn muốn giữ lại trường mô tả (mo_ta), bạn có thể dùng đoạn sau: --}}
            {{--
        <div class="form-group mb-4">
            <label for="mo_ta" class="block text-gray-700 font-semibold mb-2">Mô tả</label>
            <textarea name="mo_ta" id="mo_ta" class="form-control w-full p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" rows="3">{{ old('mo_ta', $video->mo_ta) }}</textarea>
        </div>
        --}}

            <div class="flex space-x-3 mt-6">
                <button type="submit"
                    class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow transition duration-150">
                    Cập nhật Video
                </button>
                {{-- Quay lại trang danh sách video --}}
                <a href="{{ route('admin.videos.danhsachvideoadmin') }}"
                    class="btn btn-secondary bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded shadow transition duration-150">
                    Quay lại
                </a>
            </div>
        </form>
    </div>

@endsection
