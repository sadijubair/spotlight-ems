@extends('backend.layouts.app')

@section('title', 'All News')

@push('styles')
<link href="{{ asset('backend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">News</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">All News</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a href="{{ route('news.create') }}" class="btn btn-primary">
                <i class="bx bx-plus"></i> Add New News
            </a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center mb-3">
            <h5 class="mb-0">All News</h5>
        </div>
        <div class="table-responsive">
            <table id="newsTable" class="table table-striped table-bordered align-middle" style="width:100%">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Views</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($news as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('news.show', $item->slug) }}" class="fw-medium text-decoration-none">
                                {{ Str::limit($item->title, 50) }}
                            </a>
                            @if($item->is_featured)
                                <i class="bx bx-star text-warning" title="Featured"></i>
                            @endif
                        </td>
                        <td>
                            @if($item->category)
                                <span class="badge bg-{{ $item->category->color }}">{{ $item->category->name }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $item->user->name ?? 'N/A' }}</td>
                        <td><span class="badge bg-secondary">{{ $item->views }}</span></td>
                        <td>{{ $item->created_at->format('M d, Y') }}</td>
                        <td>
                            @if($item->status === 'published')
                                <span class="badge bg-success">Published</span>
                            @elseif($item->status === 'draft')
                                <span class="badge bg-warning text-dark">Draft</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-warning">Actions</button>
                                <button type="button" class="btn btn-sm btn-warning split-bg-warning dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('news.show', $item->slug) }}"><i class="bx bx-show"></i> View</a></li>
                                    <li><a class="dropdown-item" href="{{ route('news.edit', $item->id) }}"><i class="bx bx-edit"></i> Edit</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('news.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this news?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger"><i class="bx bx-trash"></i> Delete</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="bx bx-news font-50 text-muted"></i>
                            <p class="text-muted">No news found. <a href="{{ route('news.create') }}">Create your first news</a></p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('backend/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#newsTable').DataTable({
            order: [[5, 'desc']], // Sort by date column descending
            pageLength: 10,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            columnDefs: [
                { orderable: false, targets: 7 } // Disable sorting on Actions column
            ],
            language: {
                search: "Search news:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ news",
                infoEmpty: "No news available",
                infoFiltered: "(filtered from _MAX_ total news)",
                zeroRecords: "No matching news found"
            }
        });
    });
</script>
@endpush
