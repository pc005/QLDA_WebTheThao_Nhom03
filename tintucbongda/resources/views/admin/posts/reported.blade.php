@extends('admin.layouts.admin')

@section('content')
<style>
    .table-custom { border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    .table-custom thead { background: #f9fafb; }
    .badge-pending { background: #fbbf24; color: #111827; font-weight: 600; }
    .badge-resolved { background: #10b981; color: white; font-weight: 600; }
    .btn-sm { padding: 6px 12px; font-size: 13px; border-radius: 6px; }
    .action-btns { display: flex; gap: 8px; }
</style>

<div class="page-inner">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h4 class="dashboard-title">Danh sách bài viết bị tố cáo</h4>
        <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary">Quay lại</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card table-custom">
        <div class="table-responsive">
            <table class="table mb-0 table-hover">
                <thead>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 25%;">Bài viết</th>
                        <th style="width: 20%;">Người tố cáo</th>
                        <th style="width: 20%;">Lý do</th>
                        <th style="width: 15%;">Trạng thái</th>
                        <th style="width: 15%;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reports as $report)
                        <tr>
                            <td class="text-muted">{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $report->baiViet->tieu_de ?? 'N/A' }}</strong>
                                <br>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($report->created_at)->format('d/m/Y H:i') }}</small>
                            </td>
                            <td>{{ $report->user->ho_ten ?? 'N/A' }}</td>
                            <td>{{ $report->ly_do }}</td>
                            <td>
                                @if ($report->trang_thai === 'Chưa xử lý')
                                    <span class="badge badge-pending">Chưa xử lý</span>
                                @elseif ($report->trang_thai === 'Đã xử lý')
                                    <span class="badge badge-resolved">Đã xử lý</span>
                                @else
                                    <span class="badge bg-secondary">{{ $report->trang_thai }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-btns">
                                    @if ($report->trang_thai === 'Chưa xử lý')
                                        <button type="button" class="btn btn-success btn-sm" onclick="markResolved({{ $report->id }})">Đã xử lý</button>
                                    @endif
                                    <a href="{{ route('admin.posts.show', $report->doi_tuong_id) }}" class="btn btn-info btn-sm" title="Xem bài viết">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 text-center text-muted">
                                <i class="fas fa-flag" style="font-size: 32px;"></i>
                                <p class="mt-2">Chưa có bài viết bị tố cáo nào</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if ($reports->hasPages())
        <div class="mt-4 d-flex justify-content-center">
            {{ $reports->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function markResolved(reportId) {
    Swal.fire({
        title: 'Xác nhận đã xử lý?',
        text: "Báo cáo này sẽ được đánh dấu là đã xử lý!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Đã xử lý',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit form to mark as resolved
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/reports/${reportId}/resolve`;
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>

@endsection
