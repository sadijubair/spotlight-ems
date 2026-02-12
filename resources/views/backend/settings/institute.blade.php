@extends('backend.layouts.app')

@section('title', 'Institute Setting')

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Settings</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Institute Setting</li>
            </ol>
        </nav>
    </div>
</div>

<form action="{{ route('settings.institute.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header py-3">
                    <h5 class="mb-0">Institute Setting</h5>
                </div>
                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-primary" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" data-bs-toggle="tab" href="#primary" role="tab" aria-selected="true">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-info-circle font-18 me-1'></i></div>
                                    <div class="tab-title">Primary Information</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#contact" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-phone font-18 me-1'></i></div>
                                    <div class="tab-title">Contact Information</div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" data-bs-toggle="tab" href="#social" role="tab" aria-selected="false">
                                <div class="d-flex align-items-center">
                                    <div class="tab-icon"><i class='bx bx-share-alt font-18 me-1'></i></div>
                                    <div class="tab-title">Social Network</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    
                    <!-- Tab panes -->
                    <div class="tab-content pt-3">
                        <!-- Primary Information Tab -->
                        <div class="tab-pane fade show active" id="primary" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Institute Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           name="name" value="{{ old('name', $setting->name ?? '') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Name (বাংলা)</label>
                                    <input type="text" class="form-control @error('name_bangla') is-invalid @enderror" 
                                           name="name_bangla" value="{{ old('name_bangla', $setting->name_bangla ?? '') }}">
                                    @error('name_bangla')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Short Form</label>
                                    <input type="text" class="form-control @error('short_form') is-invalid @enderror" 
                                           name="short_form" value="{{ old('short_form', $setting->short_form ?? '') }}" 
                                           placeholder="e.g., DHAKA HS">
                                    @error('short_form')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Motto/Slogan</label>
                                    <input type="text" class="form-control @error('motto') is-invalid @enderror" 
                                           name="motto" value="{{ old('motto', $setting->motto ?? '') }}" 
                                           placeholder="e.g., Knowledge is Power">
                                    @error('motto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Medium</label>
                                    <select class="form-select @error('medium') is-invalid @enderror" name="medium">
                                        <option value="">Select Medium</option>
                                        <option value="Bangla" {{ old('medium', $setting->medium ?? '') == 'Bangla' ? 'selected' : '' }}>Bangla</option>
                                        <option value="English" {{ old('medium', $setting->medium ?? '') == 'English' ? 'selected' : '' }}>English</option>
                                        <option value="Both" {{ old('medium', $setting->medium ?? '') == 'Both' ? 'selected' : '' }}>Both</option>
                                    </select>
                                    @error('medium')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Establish Year</label>
                                    <input type="number" class="form-control @error('establish_year') is-invalid @enderror" 
                                           name="establish_year" value="{{ old('establish_year', $setting->establish_year ?? '') }}" 
                                           placeholder="e.g., 1990" min="1800" max="{{ date('Y') }}">
                                    @error('establish_year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">EIIN</label>
                                    <input type="text" class="form-control @error('eiin') is-invalid @enderror" 
                                           name="eiin" value="{{ old('eiin', $setting->eiin ?? '') }}">
                                    @error('eiin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">MPO Code</label>
                                    <input type="text" class="form-control @error('mpo_code') is-invalid @enderror" 
                                           name="mpo_code" value="{{ old('mpo_code', $setting->mpo_code ?? '') }}">
                                    @error('mpo_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Institute Code</label>
                                    <input type="text" class="form-control @error('institute_code') is-invalid @enderror" 
                                           name="institute_code" value="{{ old('institute_code', $setting->institute_code ?? '') }}">
                                    @error('institute_code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Institute Type</label>
                                    <select class="form-select @error('institute_type') is-invalid @enderror" name="institute_type">
                                        <option value="">Select Type</option>
                                        <option value="School" {{ old('institute_type', $setting->institute_type ?? '') == 'School' ? 'selected' : '' }}>School</option>
                                        <option value="College" {{ old('institute_type', $setting->institute_type ?? '') == 'College' ? 'selected' : '' }}>College</option>
                                        <option value="School & College" {{ old('institute_type', $setting->institute_type ?? '') == 'School & College' ? 'selected' : '' }}>School & College</option>
                                        <option value="Madrasha" {{ old('institute_type', $setting->institute_type ?? '') == 'Madrasha' ? 'selected' : '' }}>Madrasha</option>
                                    </select>
                                    @error('institute_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Board</label>
                                    <select class="form-select @error('board') is-invalid @enderror" name="board">
                                        <option value="">Select Board</option>
                                        <option value="Dhaka" {{ old('board', $setting->board ?? '') == 'Dhaka' ? 'selected' : '' }}>Dhaka</option>
                                        <option value="Rajshahi" {{ old('board', $setting->board ?? '') == 'Rajshahi' ? 'selected' : '' }}>Rajshahi</option>
                                        <option value="Cumilla" {{ old('board', $setting->board ?? '') == 'Cumilla' ? 'selected' : '' }}>Cumilla</option>
                                        <option value="Jashore" {{ old('board', $setting->board ?? '') == 'Jashore' ? 'selected' : '' }}>Jashore</option>
                                        <option value="Chittagong" {{ old('board', $setting->board ?? '') == 'Chittagong' ? 'selected' : '' }}>Chittagong</option>
                                        <option value="Barishal" {{ old('board', $setting->board ?? '') == 'Barishal' ? 'selected' : '' }}>Barishal</option>
                                        <option value="Sylhet" {{ old('board', $setting->board ?? '') == 'Sylhet' ? 'selected' : '' }}>Sylhet</option>
                                        <option value="Dinajpur" {{ old('board', $setting->board ?? '') == 'Dinajpur' ? 'selected' : '' }}>Dinajpur</option>
                                        <option value="Mymensingh" {{ old('board', $setting->board ?? '') == 'Mymensingh' ? 'selected' : '' }}>Mymensingh</option>
                                        <option value="Madrasah" {{ old('board', $setting->board ?? '') == 'Madrasah' ? 'selected' : '' }}>Madrasah</option>
                                        <option value="Technical" {{ old('board', $setting->board ?? '') == 'Technical' ? 'selected' : '' }}>Technical</option>
                                    </select>
                                    @error('board')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Affiliation</label>
                                    <input type="text" class="form-control @error('affiliation') is-invalid @enderror" 
                                           name="affiliation" value="{{ old('affiliation', $setting->affiliation ?? '') }}" 
                                           placeholder="e.g., National University">
                                    @error('affiliation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Logo</label>
                                    @if(isset($setting->logo) && $setting->logo)
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($setting->logo) }}" alt="Logo" class="img-thumbnail" style="max-height: 100px;">
                                    </div>
                                    @endif
                                    <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                                           name="logo" accept="image/*">
                                    <small class="text-muted">Recommended size: 200x200px (PNG, JPG, GIF, SVG)</small>
                                    @error('logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Favicon</label>
                                    @if(isset($setting->favicon) && $setting->favicon)
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($setting->favicon) }}" alt="Favicon" class="img-thumbnail" style="max-height: 50px;">
                                    </div>
                                    @endif
                                    <input type="file" class="form-control @error('favicon') is-invalid @enderror" 
                                           name="favicon" accept="image/x-icon,image/png">
                                    <small class="text-muted">Recommended size: 32x32px or 16x16px (ICO, PNG)</small>
                                    @error('favicon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Contact Information Tab -->
                        <div class="tab-pane fade" id="contact" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Telephone Number</label>
                                    <input type="text" class="form-control @error('telephone') is-invalid @enderror" 
                                           name="telephone" value="{{ old('telephone', $setting->telephone ?? '') }}" 
                                           placeholder="+880-2-XXXXXXXX">
                                    @error('telephone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Mobile Number</label>
                                    <input type="text" class="form-control @error('mobile') is-invalid @enderror" 
                                           name="mobile" value="{{ old('mobile', $setting->mobile ?? '') }}" 
                                           placeholder="+880-1XXXXXXXXX">
                                    @error('mobile')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Fax Number</label>
                                    <input type="text" class="form-control @error('fax') is-invalid @enderror" 
                                           name="fax" value="{{ old('fax', $setting->fax ?? '') }}">
                                    @error('fax')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Office Hours</label>
                                    <input type="text" class="form-control @error('office_hours') is-invalid @enderror" 
                                           name="office_hours" value="{{ old('office_hours', $setting->office_hours ?? '') }}" 
                                           placeholder="e.g., 9:00 AM - 5:00 PM">
                                    @error('office_hours')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Website URL</label>
                                    <input type="url" class="form-control @error('website_url') is-invalid @enderror" 
                                           name="website_url" value="{{ old('website_url', $setting->website_url ?? '') }}" 
                                           placeholder="https://example.com">
                                    @error('website_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           name="email" value="{{ old('email', $setting->email ?? '') }}" 
                                           placeholder="info@example.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" 
                                              name="address" rows="3" placeholder="Full address">{{ old('address', $setting->address ?? '') }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Google Map Embed Link</label>
                                    <textarea class="form-control @error('google_map_embed') is-invalid @enderror" 
                                              name="google_map_embed" rows="3" 
                                              placeholder='<iframe src="https://www.google.com/maps/embed?pb=..." width="600" height="450"...></iframe>'>{{ old('google_map_embed', $setting->google_map_embed ?? '') }}</textarea>
                                    <small class="text-muted">Paste the full iframe embed code from Google Maps</small>
                                    @error('google_map_embed')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Social Network Tab -->
                        <div class="tab-pane fade" id="social" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label"><i class="bx bxl-facebook-circle"></i> Facebook</label>
                                    <input type="url" class="form-control @error('facebook') is-invalid @enderror" 
                                           name="facebook" value="{{ old('facebook', $setting->facebook ?? '') }}" 
                                           placeholder="https://facebook.com/yourpage">
                                    @error('facebook')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><i class="bx bxl-twitter"></i> Twitter/X</label>
                                    <input type="url" class="form-control @error('twitter') is-invalid @enderror" 
                                           name="twitter" value="{{ old('twitter', $setting->twitter ?? '') }}" 
                                           placeholder="https://twitter.com/yourhandle">
                                    @error('twitter')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><i class="bx bxl-linkedin"></i> LinkedIn</label>
                                    <input type="url" class="form-control @error('linkedin') is-invalid @enderror" 
                                           name="linkedin" value="{{ old('linkedin', $setting->linkedin ?? '') }}" 
                                           placeholder="https://linkedin.com/company/yourcompany">
                                    @error('linkedin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><i class="bx bxl-instagram"></i> Instagram</label>
                                    <input type="url" class="form-control @error('instagram') is-invalid @enderror" 
                                           name="instagram" value="{{ old('instagram', $setting->instagram ?? '') }}" 
                                           placeholder="https://instagram.com/yourhandle">
                                    @error('instagram')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><i class="bx bxl-youtube"></i> YouTube</label>
                                    <input type="url" class="form-control @error('youtube') is-invalid @enderror" 
                                           name="youtube" value="{{ old('youtube', $setting->youtube ?? '') }}" 
                                           placeholder="https://youtube.com/c/yourchannel">
                                    @error('youtube')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><i class="bx bxl-whatsapp"></i> WhatsApp</label>
                                    <input type="text" class="form-control @error('whatsapp') is-invalid @enderror" 
                                           name="whatsapp" value="{{ old('whatsapp', $setting->whatsapp ?? '') }}" 
                                           placeholder="+880-1XXXXXXXXX">
                                    @error('whatsapp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><i class="bx bxl-tiktok"></i> TikTok</label>
                                    <input type="url" class="form-control @error('tiktok') is-invalid @enderror" 
                                           name="tiktok" value="{{ old('tiktok', $setting->tiktok ?? '') }}" 
                                           placeholder="https://tiktok.com/@yourhandle">
                                    @error('tiktok')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><i class="bx bxl-telegram"></i> Telegram</label>
                                    <input type="url" class="form-control @error('telegram') is-invalid @enderror" 
                                           name="telegram" value="{{ old('telegram', $setting->telegram ?? '') }}" 
                                           placeholder="https://t.me/yourgroup">
                                    @error('telegram')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary px-4"><i class="bx bx-save"></i> Save Settings</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
