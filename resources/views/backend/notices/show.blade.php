@extends('backend.layouts.app')

@section('title', 'View Notice')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Notices</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('notices.index') }}">Notices</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Notice</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a href="{{ route('notices.index') }}" class="btn btn-secondary">
                <i class="bx bx-left-arrow-alt"></i> Back to List
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="mb-0">{{ $notice->title }}</h4>
                    <div class="ms-auto">
                        @if($notice->status === 'published')
                            <span class="badge bg-success px-3 py-2">Published</span>
                        @elseif($notice->status === 'draft')
                            <span class="badge bg-warning text-dark px-3 py-2">Draft</span>
                        @else
                            <span class="badge bg-secondary px-3 py-2">{{ ucfirst($notice->status) }}</span>
                        @endif
                    </div>
                </div>
                
                <div class="d-flex gap-3 mb-4">
                    <div class="text-muted">
                        <i class="bx bx-calendar"></i> {{ $notice->published_at ? $notice->published_at->format('M d, Y') : $notice->created_at->format('M d, Y') }}
                    </div>
                    <div class="text-muted">
                        <i class="bx bx-user"></i> {{ $notice->user->name ?? 'Unknown' }}
                    </div>
                    @if($notice->category)
                    <div class="text-muted">
                        <i class="bx bx-category"></i> {{ $notice->category->name }}
                    </div>
                    @endif
                    <div class="text-muted">
                        <i class="bx bx-show"></i> {{ $notice->views }} views
                    </div>
                </div>

                <hr>

                <div class="notice-content">
                    {!! $notice->content !!}
                </div>
                
                @if($notice->file_attachment)
                <div class="mt-4">
                    <div class="alert alert-info">
                        <h6 class="mb-2"><i class="bx bx-link"></i> File Attachment</h6>
                        <a href="{{ $notice->file_attachment }}" target="_blank" class="text-decoration-none">
                            <i class="bx bx-cloud-download"></i> {{ $notice->file_attachment }}
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-3">Notice Details</h6>
                <div class="mb-3">
                    <small class="text-muted">Status</small>
                    <div class="mt-1">
                        @if($notice->status === 'published')
                            <span class="badge bg-success">Published</span>
                        @elseif($notice->status === 'draft')
                            <span class="badge bg-warning text-dark">Draft</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($notice->status) }}</span>
                        @endif
                    </div>
                </div>
                @if($notice->category)
                <div class="mb-3">
                    <small class="text-muted">Category</small>
                    <div class="mt-1">
                        <span class="badge bg-{{ $notice->category->color }}">{{ $notice->category->name }}</span>
                    </div>
                </div>
                @endif
                <div class="mb-3">
                    <small class="text-muted">Published Date</small>
                    <div class="mt-1">{{ $notice->published_at ? $notice->published_at->format('M d, Y') : 'Not published' }}</div>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Author</small>
                    <div class="mt-1">{{ $notice->user->name ?? 'Unknown' }}</div>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Views</small>
                    <div class="mt-1"><span class="badge bg-info">{{ $notice->views }}</span></div>
                </div>
                @if($notice->file_attachment)
                <div class="mb-3">
                    <small class="text-muted">File Attachment</small>
                    <div class="mt-1">
                        <a href="{{ $notice->file_attachment }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="bx bx-link"></i> Open File
                        </a>
                    </div>
                </div>
                @endif
                <hr>
                <div class="d-grid gap-2">
                    <a href="{{ route('notices.edit', $notice->id) }}" class="btn btn-outline-warning">
                        <i class="bx bx-edit"></i> Edit Notice
                    </a>
                    <form action="{{ route('notices.destroy', $notice->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this notice?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="bx bx-trash"></i> Delete Notice
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h6 class="mb-3">Actions</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <a href="javascript:;" class="text-decoration-none">
                            <i class="bx bx-printer"></i> Print Notice
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="javascript:;" class="text-decoration-none">
                            <i class="bx bx-share"></i> Share Notice
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="javascript:;" class="text-decoration-none">
                            <i class="bx bx-download"></i> Download PDF
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
