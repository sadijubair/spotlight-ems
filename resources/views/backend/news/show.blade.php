@extends('backend.layouts.app')

@section('title', 'View News')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">News</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('news.index') }}">News</a></li>
                <li class="breadcrumb-item active" aria-current="page">View News</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a href="{{ route('news.index') }}" class="btn btn-secondary">
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
                    <h4 class="mb-0">{{ $news->title }}</h4>
                    <div class="ms-auto">
                        @if($news->status === 'published')
                            <span class="badge bg-success px-3 py-2">Published</span>
                        @elseif($news->status === 'draft')
                            <span class="badge bg-warning text-dark px-3 py-2">Draft</span>
                        @else
                            <span class="badge bg-secondary px-3 py-2">{{ ucfirst($news->status) }}</span>
                        @endif
                    </div>
                </div>
                
                <div class="d-flex gap-3 mb-4">
                    <div class="text-muted">
                        <i class="bx bx-calendar"></i> {{ $news->published_at ? $news->published_at->format('M d, Y') : $news->created_at->format('M d, Y') }}
                    </div>
                    <div class="text-muted">
                        <i class="bx bx-user"></i> {{ $news->user->name ?? 'Unknown' }}
                    </div>
                    @if($news->category)
                    <div class="text-muted">
                        <i class="bx bx-category"></i> {{ $news->category->name }}
                    </div>
                    @endif
                    <div class="text-muted">
                        <i class="bx bx-show"></i> {{ $news->views }} views
                    </div>
                </div>

                <hr>

                @if($news->featured_image)
                <div class="mb-4">
                    <img src="{{ Storage::url($news->featured_image) }}" alt="{{ $news->title }}" class="img-fluid rounded">
                </div>
                @endif

                <div class="news-content">
                    {!! $news->content !!}
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-3">News Details</h6>
                <div class="mb-3">
                    <small class="text-muted">Status</small>
                    <div class="mt-1">
                        @if($news->status === 'published')
                            <span class="badge bg-success">Published</span>
                        @elseif($news->status === 'draft')
                            <span class="badge bg-warning text-dark">Draft</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($news->status) }}</span>
                        @endif
                    </div>
                </div>
                @if($news->category)
                <div class="mb-3">
                    <small class="text-muted">Category</small>
                    <div class="mt-1">
                        <span class="badge bg-{{ $news->category->color }}">{{ $news->category->name }}</span>
                    </div>
                </div>
                @endif
                <div class="mb-3">
                    <small class="text-muted">Published Date</small>
                    <div class="mt-1">{{ $news->published_at ? $news->published_at->format('M d, Y') : 'Not published' }}</div>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Author</small>
                    <div class="mt-1">{{ $news->user->name ?? 'Unknown' }}</div>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Views</small>
                    <div class="mt-1"><span class="badge bg-info">{{ $news->views }}</span></div>
                </div>
                <hr>
                <div class="d-grid gap-2">
                    <a href="{{ route('news.edit', $news->id) }}" class="btn btn-outline-warning">
                        <i class="bx bx-edit"></i> Edit News
                    </a>
                    <form action="{{ route('news.destroy', $news->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this news?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="bx bx-trash"></i> Delete News
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
                            <i class="bx bx-printer"></i> Print News
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="javascript:;" class="text-decoration-none">
                            <i class="bx bx-share"></i> Share News
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
