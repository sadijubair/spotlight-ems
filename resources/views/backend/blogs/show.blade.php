@extends('backend.layouts.app')

@section('title', 'View Blog')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Blogs</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}">Blogs</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Blog</li>
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            <a href="{{ route('blogs.index') }}" class="btn btn-secondary">
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
                    <h4 class="mb-0">{{ $blog->title }}</h4>
                    <div class="ms-auto">
                        @if($blog->status === 'published')
                            <span class="badge bg-success px-3 py-2">Published</span>
                        @elseif($blog->status === 'draft')
                            <span class="badge bg-warning text-dark px-3 py-2">Draft</span>
                        @else
                            <span class="badge bg-secondary px-3 py-2">{{ ucfirst($blog->status) }}</span>
                        @endif
                    </div>
                </div>
                
                <div class="d-flex gap-3 mb-4">
                    <div class="text-muted">
                        <i class="bx bx-calendar"></i> {{ $blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y') }}
                    </div>
                    <div class="text-muted">
                        <i class="bx bx-user"></i> {{ $blog->user->name ?? 'Unknown' }}
                    </div>
                    @if($blog->category)
                    <div class="text-muted">
                        <i class="bx bx-category"></i> {{ $blog->category->name }}
                    </div>
                    @endif
                    <div class="text-muted">
                        <i class="bx bx-show"></i> {{ $blog->views }} views
                    </div>
                </div>

                <hr>

                @if($blog->featured_image)
                <div class="mb-4">
                    <img src="{{ Storage::url($blog->featured_image) }}" alt="{{ $blog->title }}" class="img-fluid rounded">
                </div>
                @endif

                <div class="blog-content">
                    {!! $blog->content !!}
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-3">Blog Details</h6>
                <div class="mb-3">
                    <small class="text-muted">Status</small>
                    <div class="mt-1">
                        @if($blog->status === 'published')
                            <span class="badge bg-success">Published</span>
                        @elseif($blog->status === 'draft')
                            <span class="badge bg-warning text-dark">Draft</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($blog->status) }}</span>
                        @endif
                    </div>
                </div>
                @if($blog->category)
                <div class="mb-3">
                    <small class="text-muted">Category</small>
                    <div class="mt-1">
                        <span class="badge bg-{{ $blog->category->color }}">{{ $blog->category->name }}</span>
                    </div>
                </div>
                @endif
                <div class="mb-3">
                    <small class="text-muted">Published Date</small>
                    <div class="mt-1">{{ $blog->published_at ? $blog->published_at->format('M d, Y') : 'Not published' }}</div>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Author</small>
                    <div class="mt-1">{{ $blog->user->name ?? 'Unknown' }}</div>
                </div>
                <div class="mb-3">
                    <small class="text-muted">Views</small>
                    <div class="mt-1"><span class="badge bg-info">{{ $blog->views }}</span></div>
                </div>
                <hr>
                <div class="d-grid gap-2">
                    <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-outline-warning">
                        <i class="bx bx-edit"></i> Edit Blog
                    </a>
                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100">
                            <i class="bx bx-trash"></i> Delete Blog
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
                            <i class="bx bx-printer"></i> Print Blog
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="javascript:;" class="text-decoration-none">
                            <i class="bx bx-share"></i> Share Blog
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
