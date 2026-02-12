@extends('backend.layouts.app')

@section('title', 'Edit Notice')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Notices</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('notices.index') }}">Notices</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Notice</li>
            </ol>
        </nav>
    </div>
</div>

<form action="{{ route('notices.update', $notice->id) }}" method="POST" enctype="multipart/form-data" id="noticeForm">
@csrf
@method('PUT')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header py-3">
                <div class="row align-items-center g-3">
                    <div class="col-12 col-lg-6">
                        <h5 class="mb-0">Edit Notice</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label">Notice Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" 
                               placeholder="Enter notice title" value="{{ old('title', $notice->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Notice Content</label>
                        <div id="editor">
                            {!! old('content', $notice->content) !!}
                        </div>
                        <input type="hidden" name="content" id="content">
                        @error('content')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">File Attachment (Drive/Dropbox Link)</label>
                        <input type="url" class="form-control @error('file_attachment') is-invalid @enderror" 
                               name="file_attachment" placeholder="https://drive.google.com/file/d/..." 
                               value="{{ old('file_attachment', $notice->file_attachment) }}">
                        <small class="text-muted">Paste a link to Google Drive, Dropbox, or any cloud storage file</small>
                        @error('file_attachment')
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
                            <option value="draft" {{ old('status', $notice->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $notice->status) == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ old('status', $notice->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Category</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $notice->category_id) == $category->id ? 'selected' : '' }}>
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
                               name="publish_date" value="{{ old('publish_date', $notice->published_at ? $notice->published_at->format('Y-m-d') : '') }}">
                        @error('publish_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" 
                                   value="1" {{ old('is_featured', $notice->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">
                                Mark as Featured Notice
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success" onclick="setStatus('published')"><i class="bx bx-check-circle"></i> Publish Notice</button>
                            <button type="submit" class="btn btn-warning" onclick="setStatus('draft')"><i class="bx bx-save"></i> Save as Draft</button>
                            <button type="submit" class="btn btn-secondary" onclick="setStatus('archived')"><i class="bx bx-archive"></i> Archive Notice</button>
                            <a href="{{ route('notices.show', $notice->slug) }}" class="btn btn-outline-info"><i class="bx bx-show"></i> View Notice</a>
                            <a href="{{ route('notices.index') }}" class="btn btn-outline-danger"><i class="bx bx-x"></i> Cancel</a>
                        </div>
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

    document.getElementById('noticeForm').addEventListener('submit', function(e) {
        document.getElementById('content').value = editor.html.get();
    });

    function setStatus(status) {
        document.querySelector('select[name="status"]').value = status;
    }
</script>
@endpush
