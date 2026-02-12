@extends('backend.layouts.app')

@section('title', 'My Profile')

@push('styles')
<style>
    .profile-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 40px 0;
        border-radius: 10px;
        margin-bottom: 30px;
        color: white;
    }
    .profile-avatar-lg {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,.2);
    }
    .profile-card {
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,.1);
        margin-bottom: 20px;
    }
    .profile-card .card-header {
        background-color: #f8f9fa;
        border-bottom: 2px solid #e9ecef;
        font-weight: 600;
    }
    .info-label {
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 5px;
    }
    .info-value {
        font-size: 1.1rem;
        color: #212529;
    }
    .badge-role {
        font-size: 0.9rem;
        padding: 8px 15px;
    }
    .id-badge {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px;
        border-radius: 10px;
        font-size: 1.3rem;
        font-weight: bold;
        letter-spacing: 2px;
        text-align: center;
        margin-bottom: 20px;
    }
</style>
@endpush

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">User</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">My Profile</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Profile Header -->
<div class="profile-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-auto">
                @if($user->avatar ?? false)
                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="Profile" class="profile-avatar-lg">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=150&background=random" alt="Profile" class="profile-avatar-lg">
                @endif
            </div>
            <div class="col">
                <h2 class="mb-1">{{ $user->name }}</h2>
                <p class="mb-2 opacity-75">
                    <i class='bx bx-envelope me-1'></i> {{ $user->email }}
                    @if($user->phone)
                        <span class="ms-3"><i class='bx bx-phone me-1'></i> {{ $user->phone }}</span>
                    @endif
                </p>
                <div class="d-flex gap-2 flex-wrap">
                    @if($user->user_type === 'employee' && $user->employeeType)
                        <span class="badge bg-light text-dark badge-role">
                            <i class='bx bx-briefcase me-1'></i> {{ $user->employeeType->name }}
                        </span>
                    @else
                        <span class="badge bg-light text-dark badge-role">
                            <i class='bx bx-user me-1'></i> {{ ucfirst($user->user_type) }}
                        </span>
                    @endif
                    
                    @if($user->is_super_admin)
                        <span class="badge bg-danger badge-role">
                            <i class='bx bx-shield me-1'></i> Super Admin
                        </span>
                    @elseif($user->isAdmin())
                        <span class="badge bg-warning text-dark badge-role">
                            <i class='bx bx-shield me-1'></i> Admin
                        </span>
                    @endif

                    <span class="badge badge-role {{ $user->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                        <i class='bx bx-check-circle me-1'></i> {{ ucfirst($user->status) }}
                    </span>
                </div>
            </div>
            <div class="col-auto">
                <a href="{{ route('settings.user') }}" class="btn btn-light">
                    <i class='bx bx-edit me-1'></i> Edit Profile
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Left Column -->
    <div class="col-lg-4">
        <!-- ID Card -->
        @if($user->employee_id || $user->student_id || $user->guardian_id)
        <div class="card profile-card">
            <div class="card-body">
                <h6 class="text-center text-muted mb-3">ID Number</h6>
                <div class="id-badge">
                    @if($user->employee_id)
                        {{ $user->employee_id }}
                    @elseif($user->student_id)
                        {{ $user->student_id }}
                    @elseif($user->guardian_id)
                        {{ $user->guardian_id }}
                    @endif
                </div>
                <small class="text-muted d-block text-center">
                    Registered: {{ $user->created_at->format('M d, Y') }}
                </small>
            </div>
        </div>
        @endif

        <!-- Quick Stats -->
        <div class="card profile-card">
            <div class="card-header">
                <i class='bx bx-line-chart me-2'></i> Quick Stats
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                    <div>
                        <small class="text-muted">Account Age</small>
                        <h5 class="mb-0">{{ $user->created_at->diffForHumans(null, true) }}</h5>
                    </div>
                    <div class="text-primary">
                        <i class='bx bx-time-five' style="font-size: 2rem;"></i>
                    </div>
                </div>
                @if($user->date_of_joining)
                <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                    <div>
                        <small class="text-muted">Date of Joining</small>
                        <h5 class="mb-0">{{ $user->date_of_joining->format('M d, Y') }}</h5>
                    </div>
                    <div class="text-success">
                        <i class='bx bx-calendar' style="font-size: 2rem;"></i>
                    </div>
                </div>
                @endif
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Last Updated</small>
                        <h6 class="mb-0">{{ $user->updated_at->diffForHumans() }}</h6>
                    </div>
                    <div class="text-info">
                        <i class='bx bx-refresh' style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="card profile-card">
            <div class="card-header">
                <i class='bx bx-phone me-2'></i> Contact Information
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="info-label">Email</div>
                    <div class="info-value">
                        <i class='bx bx-envelope me-2 text-primary'></i>
                        <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                    </div>
                </div>
                @if($user->phone)
                <div class="mb-3">
                    <div class="info-label">Phone</div>
                    <div class="info-value">
                        <i class='bx bx-phone me-2 text-success'></i>
                        <a href="tel:{{ $user->phone }}">{{ $user->phone }}</a>
                    </div>
                </div>
                @endif
                @if($user->contact && $user->contact !== $user->phone)
                <div class="mb-3">
                    <div class="info-label">Alternate Contact</div>
                    <div class="info-value">
                        <i class='bx bx-phone-call me-2 text-info'></i>
                        {{ $user->contact }}
                    </div>
                </div>
                @endif
                @if($user->address)
                <div>
                    <div class="info-label">Address</div>
                    <div class="info-value">
                        <i class='bx bx-map me-2 text-warning'></i>
                        {{ $user->address }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Right Column -->
    <div class="col-lg-8">
        <!-- Personal Information -->
        <div class="card profile-card">
            <div class="card-header">
                <i class='bx bx-user me-2'></i> Personal Information
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="info-label">First Name</div>
                        <div class="info-value">{{ $user->first_name ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="info-label">Last Name</div>
                        <div class="info-value">{{ $user->last_name ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="info-label">Full Name</div>
                        <div class="info-value">{{ $user->name }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="info-label">Username</div>
                        <div class="info-value">
                            <span class="badge bg-light text-dark">{{ $user->username ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Role & Type Information -->
        <div class="card profile-card">
            <div class="card-header">
                <i class='bx bx-id-card me-2'></i> Role & Type Information
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="info-label">User Type</div>
                        <div class="info-value">
                            <span class="badge bg-info">{{ ucfirst($user->user_type) }}</span>
                        </div>
                    </div>
                    @if($user->user_type === 'employee' && $user->employeeType)
                    <div class="col-md-6 mb-3">
                        <div class="info-label">Employee Type</div>
                        <div class="info-value">
                            <span class="badge bg-primary">{{ $user->employeeType->name }}</span>
                            <small class="text-muted ms-2">(Code: {{ $user->employeeType->code }})</small>
                        </div>
                    </div>
                    @endif
                    @if($user->employee_id)
                    <div class="col-md-6 mb-3">
                        <div class="info-label">Employee ID</div>
                        <div class="info-value">
                            <strong class="text-primary">{{ $user->employee_id }}</strong>
                        </div>
                    </div>
                    @endif
                    @if($user->student_id)
                    <div class="col-md-6 mb-3">
                        <div class="info-label">Student ID</div>
                        <div class="info-value">
                            <strong class="text-success">{{ $user->student_id }}</strong>
                        </div>
                    </div>
                    @endif
                    @if($user->guardian_id)
                    <div class="col-md-6 mb-3">
                        <div class="info-label">Guardian ID</div>
                        <div class="info-value">
                            <strong class="text-warning">{{ $user->guardian_id }}</strong>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-6 mb-3">
                        <div class="info-label">Status</div>
                        <div class="info-value">
                            @if($user->status === 'active')
                                <span class="badge bg-success"><i class='bx bx-check-circle'></i> Active</span>
                            @elseif($user->status === 'inactive')
                                <span class="badge bg-secondary"><i class='bx bx-x-circle'></i> Inactive</span>
                            @elseif($user->status === 'suspended')
                                <span class="badge bg-warning"><i class='bx bx-error-circle'></i> Suspended</span>
                            @else
                                <span class="badge bg-danger"><i class='bx bx-block'></i> Terminated</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        @if($user->bio)
        <div class="card profile-card">
            <div class="card-header">
                <i class='bx bx-info-circle me-2'></i> About
            </div>
            <div class="card-body">
                <p class="mb-0">{{ $user->bio }}</p>
            </div>
        </div>
        @endif

        <!-- Account Security -->
        <div class="card profile-card">
            <div class="card-header">
                <i class='bx bx-shield me-2'></i> Account Security
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="info-label">Password</div>
                        <div class="info-value">
                            <span class="text-muted">••••••••</span>
                            <a href="{{ route('settings.user') }}" class="btn btn-sm btn-outline-primary ms-2">Change Password</a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="info-label">Email Verified</div>
                        <div class="info-value">
                            @if($user->email_verified_at)
                                <span class="badge bg-success"><i class='bx bx-check-circle'></i> Verified</span>
                                <small class="text-muted ms-2">{{ $user->email_verified_at->format('M d, Y') }}</small>
                            @else
                                <span class="badge bg-warning"><i class='bx bx-error-circle'></i> Not Verified</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
