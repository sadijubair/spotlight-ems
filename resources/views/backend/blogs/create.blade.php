@extends('backend.layouts.app')

@section('title', 'Add New Blog')

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
                <li class="breadcrumb-item active" aria-current="page">Add New Blog</li>
            </ol>
        </nav>
    </div>
</div>

<form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data" id="blogForm">
@csrf
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header py-3">
                <div class="row align-items-center g-3">
                    <div class="col-12 col-lg-6">
                        <h5 class="mb-0">Add New Blog</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Blog Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" 
                               placeholder="Enter blog title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Blog Content <span class="text-danger">*</span></label>
                        <div id="editor">
                            {!! old('content', '<p>Write blog content here...</p>') !!}
                        </div>
                        <input type="hidden" name="content" id="content" required>
                        @error('content')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Excerpt</label>
                        <textarea class="form-control @error('excerpt') is-invalid @enderror" name="excerpt" rows="3" 
                                  placeholder="Short description (optional)">{{ old('excerpt') }}</textarea>
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
                    <div class="fs-5 ms-auto dropdown">
                        <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots"></i>
                        </div>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status">
                            <option value="draft" selected>Draft</option>
                            <option value="published">Published</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Category</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                               name="publish_date" value="{{ old('publish_date', date('Y-m-d')) }}">
                        @error('publish_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" 
                                   value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">
                                Mark as Featured Blog
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success" onclick="setStatus('published')"><i class="bx bx-check-circle"></i> Publish Blog</button>
                            <button type="submit" class="btn btn-warning" onclick="setStatus('draft')"><i class="bx bx-save"></i> Save as Draft</button>
                            <a href="{{ route('blogs.index') }}" class="btn btn-outline-danger"><i class="bx bx-x"></i> Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <h6 class="mb-3">Featured Image</h6>
                <div class="border rounded p-3 text-center">
                    <i class="bx bx-image font-50 text-muted"></i>
                    <p class="mb-2 text-muted">Upload featured image</p>
                    <input type="file" class="form-control @error('featured_image') is-invalid @enderror" 
                           name="featured_image" accept="image/*" onchange="previewImage(event)">
                    @error('featured_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="imagePreview" class="mt-3" style="display: none;">
                        <img id="preview" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
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
    // Initialize Froala Editor
    var editor = new FroalaEditor('#editor', {
        heightMin: 250,
        toolbarButtons: {
            'moreText': {
                'buttons': ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting']
            },
            'moreParagraph': {
                'buttons': ['alignLeft', 'alignCenter', 'formatOLSimple', 'alignRight', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote']
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
        events: {
            'contentChanged': function () {
                saveContent();
            }
        }
    });

    function saveContent() {
        var content = editor.html.get();
        document.getElementById('content').value = content;
    }

    // Save content before form submission
    document.querySelector('#blogForm').onsubmit = function() {
        saveContent();
        return true;
    };

    // Image preview function
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    }

    // Initialize content on page load
    window.addEventListener('load', function() {
        saveContent();
    });

    // Set status before form submission
    function setStatus(status) {
        document.querySelector('select[name="status"]').value = status;
    }
</script>
@endpush
