@extends('backend.layouts.app')

@section('title', 'Edit Blog')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Blogs</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}">Blogs</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Blog</li>
            </ol>
        </nav>
    </div>
</div>

<form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data" id="blogForm">
@csrf
@method('PUT')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header py-3">
                <div class="row align-items-center g-3">
                    <div class="col-12 col-lg-6">
                        <h5 class="mb-0">Edit Blog</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Blog Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" 
                               placeholder="Enter blog title" value="{{ old('title', $blog->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Blog Content <span class="text-danger">*</span></label>
                        <div id="editor">
                            {!! old('content', $blog->content) !!}
                        </div>
                        <input type="hidden" name="content" id="content" required>
                        @error('content')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Excerpt</label>
                        <textarea class="form-control @error('excerpt') is-invalid @enderror" name="excerpt" rows="3" 
                                  placeholder="Short description (optional)">{{ old('excerpt', $blog->excerpt) }}</textarea>
                        @error('excerpt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h6 class="mb-0">Publish</h6>
                </div>
                <hr>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status', $blog->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Category</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Publish Date</label>
                        <input type="date" class="form-control @error('publish_date') is-invalid @enderror" 
                               name="publish_date" value="{{ old('publish_date', $blog->published_at ? $blog->published_at->format('Y-m-d') : '') }}">
                        @error('publish_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" 
                                   value="1" {{ old('is_featured', $blog->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">
                                Mark as Featured Blog
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success" onclick="setStatus('published')"><i class="bx bx-check-circle"></i> Publish Blog</button>
                            <button type="submit" class="btn btn-warning" onclick="setStatus('draft')"><i class="bx bx-save"></i> Save as Draft</button>
                            <button type="submit" class="btn btn-secondary" onclick="setStatus('archived')"><i class="bx bx-archive"></i> Archive Blog</button>
                            <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-outline-info"><i class="bx bx-show"></i> View Blog</a>
                            <a href="{{ route('blogs.index') }}" class="btn btn-outline-danger"><i class="bx bx-x"></i> Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <h6 class="mb-3">Featured Image</h6>
                @if($blog->featured_image)
                <div class="mb-3 text-center">
                    <img src="{{ Storage::url($blog->featured_image) }}" alt="{{ $blog->title }}" class="img-fluid rounded" id="currentImage">
                    <p class="mt-2 mb-0 small text-muted">Current Featured Image</p>
                </div>
                @endif
                <div class="border rounded p-3 text-center">
                    <i class="bx bx-image font-50 text-muted"></i>
                    <p class="mb-2 text-muted">{{ $blog->featured_image ? 'Change featured image' : 'Upload featured image' }}</p>
                    <input type="file" class="form-control" name="featured_image" accept="image/*" onchange="previewImage(this)">
                    <div id="imagePreview" class="mt-3" style="display:none;">
                        <img src="" alt="Preview" class="img-fluid rounded">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection

@push('scripts')
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
<script>
    var editor = new FroalaEditor('#editor', {
        heightMin: 300,
        heightMax: 600,
        toolbarButtons: {
            'moreText': {
                'buttons': ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting']
            },
            'moreParagraph': {
                'buttons': ['alignLeft', 'alignCenter', 'alignRight', 'alignJustify', 'formatOLSimple', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote']
            },
            'moreRich': {
                'buttons': ['insertLink', 'insertImage', 'insertVideo', 'insertTable', 'emoticons', 'fontAwesome', 'specialCharacters', 'embedly', 'insertFile', 'insertHR']
            },
            'moreMisc': {
                'buttons': ['undo', 'redo', 'fullscreen', 'print', 'getPDF', 'spellChecker', 'selectAll', 'html', 'help'],
                'align': 'right',
                'buttonsVisible': 2
            }
        },
        imageUploadURL: '/upload_image',
        imageUploadParams: {
            _token: '{{ csrf_token() }}'
        }
    });

    document.getElementById('blogForm').addEventListener('submit', function(e) {
        document.getElementById('content').value = editor.html.get();
    });

    function setStatus(status) {
        document.querySelector('select[name="status"]').value = status;
    }

    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').style.display = 'block';
                document.getElementById('imagePreview').querySelector('img').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
