@extends('backend.layouts.app')

@section('title', 'User Settings')

@push('styles')
<link href="{{ asset('backend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" />
<style>
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,.1);
    }
    .avatar-upload {
        position: relative;
        display: inline-block;
    }
    .avatar-upload-btn {
        position: absolute;
        bottom: 0;
        right: 0;
        background: #0d6efd;
        color: white;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: 3px solid #fff;
    }
</style>
@endpush

@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Settings</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">User Settings</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- Tabs Navigation -->
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="pill" href="#all-users-tab" role="tab" aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-user font-18 me-1'></i></div>
                                <div class="tab-title">All Users</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="pill" href="#add-new-user-tab" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-user-plus font-18 me-1'></i></div>
                                <div class="tab-title">Add New User</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="pill" href="#role-manager-tab" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-bell font-18 me-1'></i></div>
                                <div class="tab-title">Role Manager</div>
                            </div>
                        </a>
                    </li>
                </ul>
                <hr/>

                <!-- Tabs Content -->
                <div class="tab-content">
                    <!-- All Users Tab -->
                    <div class="tab-pane fade show active" id="all-users-tab" role="tabpanel">
                        <!-- Filter Card -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="mb-0"><i class='bx bx-filter-alt me-2'></i>Filter Users</h6>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" id="reset-filters">
                                        <i class='bx bx-reset me-1'></i>Reset Filters
                                    </button>
                                </div>
                                
                                <div class="row g-3">
                                    <!-- Role Filter -->
                                    <div class="col-md-7">
                                        <label class="form-label fw-bold">
                                            <i class='bx bx-user-circle me-1'></i>Filter by Role:
                                        </label>
                                        <div class="d-flex gap-3 flex-wrap">
                                            <div class="form-check">
                                                <input class="form-check-input role-checkbox" type="checkbox" id="role_admin" value="admin">
                                                <label class="form-check-label" for="role_admin">
                                                    Admin
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input role-checkbox" type="checkbox" id="role_employee" value="employee">
                                                <label class="form-check-label" for="role_employee">
                                                    Employee
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input role-checkbox" type="checkbox" id="role_student" value="student">
                                                <label class="form-check-label" for="role_student">
                                                    Student
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input role-checkbox" type="checkbox" id="role_guardian" value="guardian">
                                                <label class="form-check-label" for="role_guardian">
                                                    Guardian
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input role-checkbox" type="checkbox" id="role_user" value="user">
                                                <label class="form-check-label" for="role_user">
                                                    User
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Status Filter -->
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">
                                            <i class='bx bx-check-circle me-1'></i>Status:
                                        </label>
                                        <select class="form-select" id="status-filter">
                                            <option value="all" selected>All Status</option>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                            <option value="suspended">Suspended</option>
                                        </select>
                                    </div>

                                    <!-- Quick Search -->
                                    <div class="col-md-2">
                                        <label class="form-label fw-bold">
                                            <i class='bx bx-search-alt me-1'></i>Quick Search:
                                        </label>
                                        <input type="text" class="form-control" id="quick-search" placeholder="Search...">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="usersTable" class="table table-striped table-bordered" style="width:100%">
                                <thead class="table-primary">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>ID Number</th>
                                        <th>Type</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users ?? [] as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            {{ $user->name }}
                                            @if($user->is_super_admin)
                                                <span class="badge bg-danger ms-1">Super Admin</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->user_type === 'employee')
                                                <strong>{{ $user->employee_id }}</strong>
                                            @elseif($user->user_type === 'student')
                                                <strong>{{ $user->student_id }}</strong>
                                            @elseif($user->user_type === 'guardian')
                                                <strong>{{ $user->guardian_id }}</strong>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->user_type === 'employee' && $user->employeeType)
                                                <span class="badge bg-primary">{{ $user->employeeType->name }}</span>
                                            @else
                                                <span class="badge bg-info">{{ ucfirst($user->user_type) }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone ?? 'N/A' }}</td>
                                        <td>
                                            @if($user->status === 'active')
                                                <span class="badge bg-success">Active</span>
                                            @elseif($user->status === 'inactive')
                                                <span class="badge bg-secondary">Inactive</span>
                                            @elseif($user->status === 'suspended')
                                                <span class="badge bg-warning">Suspended</span>
                                            @else
                                                <span class="badge bg-danger">Terminated</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-sm btn-warning">Actions</button>
                                                <button type="button" class="btn btn-sm btn-warning split-bg-warning dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <span class="visually-hidden">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item open-login-modal" href="#" 
                                                           data-user-id="{{ $user->id }}"
                                                           data-user-name="{{ $user->name }}"
                                                           data-username="{{ $user->username }}"
                                                           data-contact="{{ $user->phone ?? $user->contact }}"
                                                           data-email="{{ $user->email }}"
                                                           data-is-super-admin="{{ $user->is_super_admin ? 'true' : 'false' }}"
                                                           data-login-status="{{ $user->login_enabled ? 'true' : 'false' }}">
                                                            <i class="bx bx-show"></i> Login Info
                                                        </a>
                                                    </li>
                                                    @if(Auth::user()->isSuperAdmin() && $user->user_type === 'employee' && !$user->isAdmin())
                                                        <li><a class="dropdown-item" href="#"><i class="bx bx-shield"></i> Promote to Admin</a></li>
                                                    @endif
                                                    <li>
                                                        <a class="dropdown-item open-status-modal" href="#" 
                                                           data-user-id="{{ $user->id }}"
                                                           data-user-name="{{ $user->name }}"
                                                           data-current-status="{{ $user->status }}"
                                                           data-is-super-admin="{{ $user->is_super_admin ? 'true' : 'false' }}">
                                                            <i class="bx bx-edit"></i> Change Status
                                                        </a>
                                                    </li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item text-danger" href="#"><i class="bx bx-trash"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No users found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>ID Number</th>
                                        <th>Type</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- Add New User Tab -->
                    <div class="tab-pane fade" id="add-new-user-tab" role="tabpanel">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                            <div class="card border-primary border-bottom border-3 border-0">
                                <div class="card-body">
                                    <h4 class="card-title text-primary text-center">Add New User</h4>
                                    <div class="text-center">
                                        <span class="text-muted">Create Employee, Student, Guardian or User Account</span>
                                    </div>
                                    <hr>
                                <form id="addUserForm" method="POST" action="{{ route('settings.user.store') }}">
                                    @csrf
                                    <!-- User Type Selection -->
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label class="form-label fw-bold">User Type <span class="text-danger">*</span></label>
                                            <div class="d-flex gap-3 flex-wrap">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="user_type" id="type_employee" value="employee" checked>
                                                    <label class="form-check-label" for="type_employee">
                                                        Employee
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="user_type" id="type_student" value="student">
                                                    <label class="form-check-label" for="type_student">
                                                        Student
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="user_type" id="type_guardian" value="guardian">
                                                    <label class="form-check-label" for="type_guardian">
                                                        Guardian
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="user_type" id="type_user" value="user">
                                                    <label class="form-check-label" for="type_user">
                                                        User
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Employee Type Selection (shown only for employees) -->
                                    <div class="row mb-3" id="employee_type_section">
                                        <div class="col-12">
                                            <label for="employee_type_id" class="form-label fw-bold">Employee Type <span class="text-danger">*</span></label>
                                            <select class="form-select" id="employee_type_id" name="employee_type_id">
                                                <option value="">Select Employee Type</option>
                                                @foreach($employeeTypes ?? [] as $empType)
                                                    <option value="{{ $empType->id }}">{{ $empType->name }} (Code: {{ $empType->code }})</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback"></div>
                                            <small class="text-muted">Employee ID will be auto-generated based on type</small>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" name="username">
                                            <div class="invalid-feedback"></div>
                                            <small class="text-muted">Leave blank to auto-generate</small>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" id="password" name="password" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="contact" class="form-label">Contact <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="contact" name="contact" required>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control" id="address" name="address" rows="2"></textarea>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <!-- Date of Joining (shown only for employees) -->
                                    <div class="row mb-3" id="date_joining_section">
                                        <div class="col-md-6">
                                            <label for="date_of_joining" class="form-label">Date of Joining</label>
                                            <input type="date" class="form-control" id="date_of_joining" name="date_of_joining" value="{{ date('Y-m-d') }}">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <button type="reset" class="btn btn-inverse-primary"><i class='bx bx-reset me-1'></i>Reset</button>
                                        <button type="submit" class="btn btn-primary"><i class='bx bx-user-plus me-1'></i>Add User</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
                        </div>    
                    </div>
                        
                    </div>

                    <!-- Role Manager Tab -->
                    <div class="tab-pane fade" id="role-manager-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="mb-4">Role & Permissions Manager</h5>
                                <p class="text-muted">Manage user roles and permissions here.</p>
                                <div class="alert alert-info">
                                    <i class='bx bx-info-circle me-2'></i>Role manager functionality coming soon...
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Login Info Modal -->
<div class="modal fade" id="loginInfoModal" tabindex="-1" aria-labelledby="loginInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="loginInfoModalLabel">
                    <i class='bx bx-key me-2'></i>Generate Login For: <span id="modal-user-name"></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="loginInfoForm">
                @csrf
                <input type="hidden" id="modal-user-id" name="user_id">
                <input type="hidden" id="modal-is-super-admin" name="is_super_admin">
                <div class="modal-body">
                    <!-- Super Admin Warning -->
                    <div class="alert alert-warning d-none" id="super-admin-warning">
                        <i class='bx bx-info-circle me-2'></i>
                        <strong>Super Admin:</strong> Login access cannot be disabled for Super Admin accounts.
                    </div>

                    <div class="mb-3" id="login-status-section">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="login_status" name="login_status" checked>
                            <label class="form-check-label fw-bold" for="login_status">
                                Login Status <small class="text-muted">(Allow user to login to the system)</small>
                            </label>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">Username:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-user'></i></span>
                                <input type="text" class="form-control" id="modal-username" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label fw-bold">Contact No.:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-phone'></i></span>
                                <input type="text" class="form-control" id="modal-contact" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-9">
                            <label for="modal_password" class="form-label fw-bold">Password:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-lock'></i></span>
                                <input type="text" class="form-control" id="modal_password" name="password" required>
                                <button type="button" class="btn btn-outline-secondary" id="toggle-password">
                                    <i class='bx bx-hide' id="password-icon"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="button" class="btn btn-info w-100" id="generate-password">
                                <i class='bx bx-refresh'></i>
                            </button>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <label for="modal_confirm_password" class="form-label fw-bold">Confirm Password:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class='bx bx-lock-alt'></i></span>
                                <input type="text" class="form-control" id="modal_confirm_password" name="confirm_password" required>
                            </div>
                            <div class="invalid-feedback" id="password-match-error"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="button" class="btn btn-link text-decoration-none" id="generate-secure-link">
                            <i class='bx bx-shield me-1'></i>Generate More Secure Password
                        </button>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="send_sms" name="send_sms">
                        <label class="form-check-label" for="send_sms">
                            Send SMS
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class='bx bx-x me-1'></i>Close
                    </button>
                    <button type="submit" class="btn btn-primary" id="generateLoginBtn">
                        <i class='bx bx-save me-1'></i>Generate
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Status Change Modal -->
<div class="modal fade" id="statusChangeModal" tabindex="-1" aria-labelledby="statusChangeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="statusChangeModalLabel">
                    <i class='bx bx-edit me-2'></i>Change User Status
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="statusChangeForm">
                @csrf
                <input type="hidden" id="status-user-id" name="user_id">
                <input type="hidden" id="status-is-super-admin" value="false">
                <div class="modal-body">
                    <div class="alert alert-warning" id="super-admin-status-warning" style="display: none;">
                        <i class='bx bx-error me-2'></i>
                        <strong>Warning:</strong> Super Admin status cannot be changed to protect system access.
                    </div>
                    
                    <div class="alert alert-info">
                        <i class='bx bx-info-circle me-2'></i>
                        <strong>User:</strong> <span id="status-user-name"></span><br>
                        <strong>Current Status:</strong> <span id="status-current" class="badge"></span>
                    </div>
                    
                    <div class="mb-3">
                        <label for="status-select" class="form-label fw-bold">New Status: <span class="text-danger">*</span></label>
                        <select class="form-select" id="status-select" name="status" required>
                            <option value="">-- Select Status --</option>
                            <option value="active">✓ Active</option>
                            <option value="inactive">✗ Inactive</option>
                            <option value="suspended">⚠ Suspended</option>
                            <option value="terminated">⛔ Terminated</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="status-reason" class="form-label">Reason (Optional):</label>
                        <textarea class="form-control" id="status-reason" name="reason" rows="3" placeholder="Enter reason for status change..."></textarea>
                    </div>
                    
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="notify-user" name="notify_user">
                        <label class="form-check-label" for="notify-user">
                            Notify user via email
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class='bx bx-x me-1'></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-warning" id="confirmStatusChangeBtn">
                        <i class='bx bx-check me-1'></i>Confirm Change
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('backend/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTable with Buttons
        var table = $('#usersTable').DataTable({
            dom: 'Brtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ],
            responsive: true,
            pageLength: 10,
            order: [[0, 'desc']]
        });

        // Style the buttons
        $('.dt-buttons .btn').removeClass('btn-secondary').addClass('btn-outline-primary btn-sm');

        // Custom filter function
        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
            // Get selected roles
            var selectedRoles = [];
            $('.role-checkbox:checked').each(function() {
                selectedRoles.push($(this).val().toLowerCase());
            });

            // Get selected status
            var selectedStatus = $('#status-filter').val();

            // Get row data
            var roleColumn = data[3]; // Role column (index 3)
            var statusColumn = data[6]; // Status column (index 6)

            // Extract text from HTML
            var role = roleColumn.toLowerCase().replace(/<[^>]*>/g, '').trim();
            var status = statusColumn.toLowerCase().replace(/<[^>]*>/g, '').trim();

            // Check role filter
            var roleMatch = selectedRoles.length === 0 || selectedRoles.some(function(r) {
                return role.includes(r);
            });

            // Check status filter
            var statusMatch = selectedStatus === 'all' || status.includes(selectedStatus);

            return roleMatch && statusMatch;
        });

        // Role checkbox change event
        $('.role-checkbox').on('change', function() {
            table.draw();
        });

        // Status dropdown change event
        $('#status-filter').on('change', function() {
            table.draw();
        });

        // Quick search functionality
        $('#quick-search').on('keyup', function() {
            table.search(this.value).draw();
        });

        // Reset filters button
        $('#reset-filters').on('click', function() {
            // Uncheck all role checkboxes
            $('.role-checkbox').prop('checked', false);
            // Reset status to "all"
            $('#status-filter').val('all');
            // Clear quick search
            $('#quick-search').val('');
            // Clear table search
            table.search('').draw();
            // Redraw table with no filters
            table.draw();
        });

        // Initial draw with default filters
        table.draw();

        // User Type Change Handler
        $('input[name="user_type"]').on('change', function() {
            var userType = $(this).val();
            
            if (userType === 'employee') {
                $('#employee_type_section').show();
                $('#date_joining_section').show();
                $('#employee_type_id').attr('required', true);
            } else {
                $('#employee_type_section').hide();
                $('#date_joining_section').hide();
                $('#employee_type_id').attr('required', false);
            }
        });

        // Trigger on page load
        $('input[name="user_type"]:checked').trigger('change');

        // Add New User Form Submission
        $('#addUserForm').on('submit', function(e) {
            e.preventDefault();
            
            // Clear previous errors
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            
            var form = $(this);
            var submitBtn = form.find('button[type="submit"]');
            var originalBtnText = submitBtn.html();
            
            // Disable submit button
            submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span>Creating...');
            
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    if(response.success) {
                        // Show success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                        
                        // Reset form
                        form[0].reset();
                        
                        // Reload page after 2 seconds to show new user in table
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                },
                error: function(xhr) {
                    if(xhr.status === 422) {
                        // Validation errors
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(field, messages) {
                            var input = $('#' + field);
                            input.addClass('is-invalid');
                            input.siblings('.invalid-feedback').text(messages[0]);
                        });
                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            text: 'Please check the form and try again.'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong. Please try again.'
                        });
                    }
                },
                complete: function() {
                    // Re-enable submit button
                    submitBtn.prop('disabled', false).html(originalBtnText);
                }
            });
        });

        // Login Info Modal Functionality
        $('.open-login-modal').on('click', function(e) {
            e.preventDefault();
            
            var userId = $(this).data('user-id');
            var userName = $(this).data('user-name');
            var username = $(this).data('username');
            var contact = $(this).data('contact');
            var loginStatus = $(this).data('login-status');
            var isSuperAdmin = $(this).data('is-super-admin');
            
            // Populate modal
            $('#modal-user-id').val(userId);
            $('#modal-is-super-admin').val(isSuperAdmin);
            $('#modal-user-name').text(userName);
            $('#modal-username').val(username || 'N/A');
            $('#modal-contact').val(contact || 'N/A');
            $('#login_status').prop('checked', loginStatus === 'true' || loginStatus === true);
            
            // Handle Super Admin
            if (isSuperAdmin === 'true' || isSuperAdmin === true) {
                $('#super-admin-warning').removeClass('d-none');
                $('#login_status').prop('checked', true).prop('disabled', true);
                $('#login-status-section .form-check-label').append(' <span class="badge bg-danger">Always Enabled</span>');
            } else {
                $('#super-admin-warning').addClass('d-none');
                $('#login_status').prop('disabled', false);
                $('#login-status-section .form-check-label .badge').remove();
            }
            
            // Clear password fields
            $('#modal_password').val('');
            $('#modal_confirm_password').val('');
            $('#password-match-error').text('');
            
            // Show modal
            $('#loginInfoModal').modal('show');
        });

        // Generate Random Password
        function generatePassword(length = 12, secure = false) {
            if (secure) {
                // More secure password with special characters
                const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+-=[]{}|;:,.<>?';
                let password = '';
                for (let i = 0; i < length; i++) {
                    password += chars.charAt(Math.floor(Math.random() * chars.length));
                }
                return password;
            } else {
                // Simple password
                const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                let password = '';
                for (let i = 0; i < length; i++) {
                    password += chars.charAt(Math.floor(Math.random() * chars.length));
                }
                return password;
            }
        }

        // Generate Password Button
        $('#generate-password').on('click', function() {
            const password = generatePassword(10, false);
            $('#modal_password').val(password);
            $('#modal_confirm_password').val(password);
            $('#modal_password').attr('type', 'text');
            $('#password-icon').removeClass('bx-hide').addClass('bx-show');
        });

        // Generate Secure Password Link
        $('#generate-secure-link').on('click', function() {
            const password = generatePassword(16, true);
            $('#modal_password').val(password);
            $('#modal_confirm_password').val(password);
            $('#modal_password').attr('type', 'text');
            $('#password-icon').removeClass('bx-hide').addClass('bx-show');
        });

        // Toggle Password Visibility
        $('#toggle-password').on('click', function() {
            const passwordField = $('#modal_password');
            const icon = $('#password-icon');
            
            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                icon.removeClass('bx-hide').addClass('bx-show');
            } else {
                passwordField.attr('type', 'password');
                icon.removeClass('bx-show').addClass('bx-hide');
            }
        });

        // Password Match Validation
        $('#modal_confirm_password').on('keyup', function() {
            const password = $('#modal_password').val();
            const confirmPassword = $(this).val();
            
            if (password !== confirmPassword && confirmPassword.length > 0) {
                $(this).addClass('is-invalid');
                $('#password-match-error').text('Passwords do not match');
            } else {
                $(this).removeClass('is-invalid');
                $('#password-match-error').text('');
            }
        });

        // Submit Login Info Form
        $('#loginInfoForm').on('submit', function(e) {
            e.preventDefault();
            
            // Validate passwords match
            const password = $('#modal_password').val();
            const confirmPassword = $('#modal_confirm_password').val();
            
            if (password !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Passwords do not match!'
                });
                return;
            }
            
            const userId = $('#modal-user-id').val();
            const loginStatus = $('#login_status').is(':checked') ? 1 : 0;
            const sendSms = $('#send_sms').is(':checked') ? 1 : 0;
            const submitBtn = $('#generateLoginBtn');
            const originalBtnText = submitBtn.html();
            
            // Disable submit button
            submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span>Processing...');
            
            $.ajax({
                url: '{{ route("settings.user.update-login") }}',
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    user_id: userId,
                    password: password,
                    login_status: loginStatus,
                    send_sms: sendSms
                },
                success: function(response) {
                    if(response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                        
                        // Close modal
                        $('#loginInfoModal').modal('hide');
                        
                        // Reload table
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                },
                error: function(xhr) {
                    let errorMsg = 'Something went wrong. Please try again.';
                    if(xhr.status === 422 && xhr.responseJSON.errors) {
                        errorMsg = Object.values(xhr.responseJSON.errors)[0][0];
                    } else if(xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: errorMsg
                    });
                },
                complete: function() {
                    // Re-enable submit button
                    submitBtn.prop('disabled', false).html(originalBtnText);
                }
            });
        });

        // Status Change Modal Functionality
        $('.open-status-modal').on('click', function(e) {
            e.preventDefault();
            
            const userId = $(this).data('user-id');
            const userName = $(this).data('user-name');
            const currentStatus = $(this).data('current-status');
            const isSuperAdmin = $(this).data('is-super-admin') === 'true';
            
            console.log('Opening status modal for:', { userId, userName, currentStatus, isSuperAdmin });
            
            // Set modal data
            $('#status-user-id').val(userId);
            $('#status-user-name').text(userName);
            $('#status-is-super-admin').val(isSuperAdmin);
            
            // Set current status badge
            const currentBadge = $('#status-current');
            currentBadge.removeClass('bg-success bg-secondary bg-warning bg-danger');
            switch(currentStatus) {
                case 'active':
                    currentBadge.addClass('bg-success').text('Active');
                    break;
                case 'inactive':
                    currentBadge.addClass('bg-secondary').text('Inactive');
                    break;
                case 'suspended':
                    currentBadge.addClass('bg-warning').text('Suspended');
                    break;
                case 'terminated':
                    currentBadge.addClass('bg-danger').text('Terminated');
                    break;
            }
            
            // Handle Super Admin protection
            if(isSuperAdmin) {
                $('#super-admin-status-warning').show();
                $('#status-select').prop('disabled', true);
                $('#confirmStatusChangeBtn').prop('disabled', true);
            } else {
                $('#super-admin-status-warning').hide();
                $('#status-select').prop('disabled', false);
                $('#confirmStatusChangeBtn').prop('disabled', false);
            }
            
            // Reset form
            $('#status-select').val('');
            $('#status-reason').val('');
            $('#notify-user').prop('checked', false);
            
            // Show modal
            $('#statusChangeModal').modal('show');
        });

        // Validate status selection change
        $('#status-select').on('change', function() {
            const currentStatus = $('#status-current').text().toLowerCase();
            const newStatus = $(this).val();
            
            console.log('Status selected:', newStatus, 'Current:', currentStatus);
            
            if(newStatus && currentStatus === newStatus) {
                Swal.fire({
                    icon: 'info',
                    title: 'No Change',
                    text: 'User is already ' + newStatus + '.'
                });
                $(this).val('');
            }
        });

        // Handle status change form submission
        $('#statusChangeForm').on('submit', function(e) {
            e.preventDefault();
            
            const isSuperAdmin = $('#status-is-super-admin').val() === 'true';
            
            // Double check Super Admin protection
            if(isSuperAdmin) {
                Swal.fire({
                    icon: 'error',
                    title: 'Access Denied',
                    text: 'Super Admin status cannot be changed!'
                });
                return;
            }
            
            const newStatus = $('#status-select').val();
            
            if(!newStatus) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Missing Selection',
                    text: 'Please select a new status.'
                });
                return;
            }
            
            const submitBtn = $('#confirmStatusChangeBtn');
            const originalBtnText = submitBtn.html();
            
            // Disable submit button
            submitBtn.prop('disabled', true).html('<span class=\"spinner-border spinner-border-sm me-1\"></span>Processing...');
            
            const formData = $(this).serialize();
            console.log('Submitting status change:', formData);
            
            $.ajax({
                url: '{{ route("settings.user.update-status") }}',
                method: 'POST',
                data: formData,
                success: function(response) {
                    console.log('Status change response:', response);
                    if(response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                        
                        // Close modal
                        $('#statusChangeModal').modal('hide');
                        
                        // Reload table
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                },
                error: function(xhr) {
                    console.error('Status change error:', xhr);
                    let errorMsg = 'Something went wrong. Please try again.';
                    
                    if(xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                        // Validation errors
                        errorMsg = 'Validation Error: ' + xhr.responseJSON.message;
                    } else if(xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: errorMsg,
                        footer: xhr.status ? 'Status Code: ' + xhr.status : ''
                    });
                },
                complete: function() {
                    // Re-enable submit button
                    submitBtn.prop('disabled', false).html(originalBtnText);
                }
            });
        });
    });
</script>
@endpush
