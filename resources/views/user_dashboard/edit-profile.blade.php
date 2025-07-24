@extends('layouts.user_sidebar')

@section('dashboard-content')
@if (!Auth::check())
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
    @php exit; @endphp
@endif
<style>
    .btn-primary {
        background-color: #ff3c00 !important;
        border-color: #ff3c00 !important;
    }

    .form-control:focus, .form-select:focus {
        border-color: hsl(14, 72%, 69%) !important;
        box-shadow: 0 0 0 0.2rem hsla(12, 81%, 40%, 0.251) !important;
    }

    #profileImageInput {
        display: none;
    }

    .profile-image-container {
        position: relative;
        display: inline-block;
    }

    .profile-image-wrapper {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .profile-image-preview {
        cursor: pointer;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .profile-image-preview:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 20px rgba(255, 60, 0, 0.4) !important;
    }

    .profile-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        opacity: 0;
        transition: opacity 0.3s ease;
        font-size: 14px;
    }

    .profile-image-wrapper:hover .profile-image-overlay {
        opacity: 1;
    }

    .profile-image-overlay i {
        font-size: 24px;
        margin-bottom: 5px;
    }

    .upload-success {
        color: #10b981;
        font-weight: 500;
    }

    .upload-error {
        color: #ef4444;
        font-weight: 500;
    }

    .edit-profile-header {
        margin-top: 50px;
    }
</style>

<h4 class="px-2 py-2 edit-profile-header">Edit Profile</h4>
<div class="container p-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
        @csrf
        @method('PUT')

        <div class="mb-3 text-center">
            <!-- Profile image preview -->
            <div class="profile-image-container mb-3">
                <div class="profile-image-wrapper" onclick="document.getElementById('profileImageInput').click();">
                    @if($user->profile_image)
                        <img src="{{ $user->profile_image_url }}" 
                             alt="Profile Image" 
                             class="profile-image-preview" 
                             id="profileImagePreview"
                             style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 4px solid #ff3c00; cursor: pointer; box-shadow: 0 4px 12px rgba(255, 60, 0, 0.3);">
                    @else
                        <div class="profile-image-placeholder" 
                             id="profileImagePreview"
                             style="width: 150px; height: 150px; border-radius: 50%; background: linear-gradient(135deg, #ff3c00, #ff6b3d); display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 4px 12px rgba(255, 60, 0, 0.3); color: white; font-size: 60px;">
                            <i class="fas fa-user"></i>
                        </div>
                    @endif
                    <div class="profile-image-overlay">
                        <i class="fas fa-camera"></i>
                        <span>Click to upload</span>
                    </div>
                </div>
            </div>
            
            <p class="text-muted small mb-4">
                <i class="fas fa-info-circle me-1"></i>
                Click on the image to upload a new profile picture<br>
                <small>Accepted formats: JPG, PNG, JPEG (Max: 2MB)</small>
            </p>

            <!-- Hidden file input for image upload -->
            <input type="file" id="profileImageInput" name="profile_image" accept="image/*" style="display: none;">
            
            <!-- Upload status message -->
            <div id="uploadStatus" class="mt-2"></div>
        </div>

        <div class="mb-3">
            <label for="fullName" class="form-label">Full Name</label>
            <input
                type="text"
                class="form-control"
                id="fullName"
                name="full_name"
                value="{{ old('full_name', $user->name) }}"
                placeholder="Enter your full name"
            >
        </div>

        <div class="row ">
            <div class="mb-3 col-md-6">
                <label for="email" class="form-label">Email Address</label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    placeholder="Enter your email"
                >
            </div>
            <div class="mb-3 col-md-6">
                <label for="mobile" class="form-label">Mobile</label>
                <input
                    type="tel"
                    class="form-control"
                    id="mobile"
                    name="phone_num"
                    value="{{ old('phone_num', $user->phone) }}"
                    placeholder="Enter your mobile number"
                >
            </div>
        </div>

        <div class="row mt-3">
            <div class="mb-3 col-md-6">
                <label for="birthday" class="form-label">Birthday</label>
                <input
                    type="date"
                    class="form-control"
                    id="birthday"
                    name="date_of_birth"
                    value="{{ old('date_of_birth', $user->dob) }}"
                >
            </div>
            <div class="mb-3 col-md-6">
            <label for="address" class="form-label">Address</label>
            <input
                type="text"
                class="form-control"
                id="address"
                name="address"
                value="{{ old('address', $user->address) }}"
                placeholder="Enter your address"
            >
        </div>
        </div>

        <button type="submit" class="mt-3 btn btn-primary">Save Changes</button>
    </form>

    <!-- Bank Details Section (Only for Dealers) -->
    @if(Auth::user()->role === 'dealer')
    <div class="card mt-4">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="fas fa-university me-2"></i>Bank Details</h5>
        </div>
        <div class="card-body">
            @if(Auth::user()->bankDetail)
                <!-- Show existing bank details with status -->
                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i>
                    Bank Details Status: 
                    <strong>
                        @if(Auth::user()->bankDetail->bank_status === 'approved')
                            <span class="text-success">Approved</span>
                        @elseif(Auth::user()->bankDetail->bank_status === 'rejected')
                            <span class="text-danger">Rejected</span>
                        @else
                            <span class="text-warning">Pending</span>
                        @endif
                    </strong>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Bank Name:</strong> {{ Auth::user()->bankDetail->bank_name }}</p>
                        <p><strong>Account Name:</strong> {{ Auth::user()->bankDetail->account_name }}</p>
                        <p><strong>Account Number:</strong> {{ Auth::user()->bankDetail->account_number }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Bank Branch:</strong> {{ Auth::user()->bankDetail->bank_branch }}</p>
                        <p><strong>Account Type:</strong> {{ Auth::user()->bankDetail->account_type }}</p>
                    </div>
                </div>

                @if(Auth::user()->bankDetail->bank_status === 'pending')
                    <button class="btn btn-warning" disabled>
                        <i class="fas fa-clock me-2"></i>Status: Approval Pending
                    </button>
                @elseif(Auth::user()->bankDetail->bank_status === 'rejected')
                    <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#updateBankDetails">
                        <i class="fas fa-edit me-2"></i>Update Bank Details
                    </button>
                @endif
                
            @else
                <!-- Show bank details form if no details exist -->
                <form action="{{ route('dealer.bank.store') }}" method="POST" enctype="multipart/form-data" id="bankDetailsForm">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="bank_name" class="form-label">Bank Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="bank_name" name="bank_name" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="bank_branch" class="form-label">Bank Branch <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="bank_branch" name="bank_branch" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="account_name" class="form-label">Account Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="account_name" name="account_name" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="account_number" class="form-label">Account Number <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="account_number" name="account_number" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="account_type" class="form-label">Account Type <span class="text-danger">*</span></label>
                            <select class="form-control" id="account_type" name="account_type" required>
                                <option value="">Select Account Type</option>
                                <option value="savings">Savings</option>
                                <option value="current">Current</option>
                                <option value="business">Business</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="bank_front_image" class="form-label">Bank Front Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="bank_front_image" name="bank_front_image" accept="image/*" required>
                            <small class="text-muted">Upload bank document front image (Max: 2MB)</small>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-2"></i>Submit Bank Details
                    </button>
                </form>
            @endif

            <!-- Collapsible Update Form for Rejected Status -->
            @if(Auth::user()->bankDetail && Auth::user()->bankDetail->bank_status === 'rejected')
            <div class="collapse mt-3" id="updateBankDetails">
                <div class="card card-body">
                    <h6>Update Bank Details</h6>
                    <form action="{{ route('dealer.bank.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="update_bank_name" class="form-label">Bank Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="update_bank_name" name="bank_name" 
                                       value="{{ Auth::user()->bankDetail->bank_name }}" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="update_bank_branch" class="form-label">Bank Branch <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="update_bank_branch" name="bank_branch" 
                                       value="{{ Auth::user()->bankDetail->bank_branch }}" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="update_account_name" class="form-label">Account Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="update_account_name" name="account_name" 
                                       value="{{ Auth::user()->bankDetail->account_name }}" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="update_account_number" class="form-label">Account Number <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="update_account_number" name="account_number" 
                                       value="{{ Auth::user()->bankDetail->account_number }}" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="update_account_type" class="form-label">Account Type <span class="text-danger">*</span></label>
                                <select class="form-control" id="update_account_type" name="account_type" required>
                                    <option value="">Select Account Type</option>
                                    <option value="savings" {{ Auth::user()->bankDetail->account_type === 'savings' ? 'selected' : '' }}>Savings</option>
                                    <option value="current" {{ Auth::user()->bankDetail->account_type === 'current' ? 'selected' : '' }}>Current</option>
                                    <option value="business" {{ Auth::user()->bankDetail->account_type === 'business' ? 'selected' : '' }}>Business</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="update_bank_front_image" class="form-label">Bank Front Image</label>
                                <input type="file" class="form-control" id="update_bank_front_image" name="bank_front_image" accept="image/*">
                                <small class="text-muted">Leave empty to keep current image</small>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Bank Details
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- KYC Section (Only for Dealers) -->
    @if (Auth::user()->role == 'dealer')
    <div class="card mt-4">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="fas fa-id-card me-2"></i>KYC (Know Your Customer)</h5>
        </div>
    <div class="card-body">
        @if (Auth::user()->kycDetail)
            @if (Auth::user()->kycDetail->kyc_status == 'approved')
                <!-- KYC Approved - Show details only -->
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>KYC Approved!</strong> Your KYC verification has been approved.
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Document Type:</strong> {{ Auth::user()->kycDetail->kyc_doc_type }}</p>
                        <p><strong>Document Number:</strong> {{ Auth::user()->kycDetail->kyc_doc_number }}</p>
                        <p><strong>Status:</strong> <span class="badge bg-success">Approved</span></p>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Front of Document</label>
                        <img src="{{ asset('storage/' . Auth::user()->kycDetail->kyc_doc_front) }}" class="img-fluid rounded border" alt="Front Document" style="max-height: 150px;">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Back of Document</label>
                        <img src="{{ asset('storage/' . Auth::user()->kycDetail->kyc_doc_back) }}" class="img-fluid rounded border" alt="Back Document" style="max-height: 150px;">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Selfie with Document</label>
                        <img src="{{ asset('storage/' . Auth::user()->kycDetail->selfie) }}" class="img-fluid rounded border" alt="Selfie" style="max-height: 150px;">
                    </div>
                </div>
                
            @elseif (Auth::user()->kycDetail->kyc_status == 'pending')
                <!-- KYC Pending -->
                <div class="alert alert-warning" role="alert">
                    <i class="fas fa-clock me-2"></i>
                    <strong>KYC Under Review!</strong> Your KYC submission is currently being reviewed. Please wait for approval.
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Document Type:</strong> {{ Auth::user()->kycDetail->kyc_doc_type }}</p>
                        <p><strong>Document Number:</strong> {{ Auth::user()->kycDetail->kyc_doc_number }}</p>
                        <p><strong>Status:</strong> <span class="badge bg-warning text-dark">Pending</span></p>
                        <p><strong>Submitted:</strong> {{ Auth::user()->kycDetail->created_at->format('M d, Y h:i A') }}</p>
                    </div>
                </div>
                
            @else
                <!-- KYC Rejected - Show form for resubmission -->
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>KYC Rejected!</strong> Please review the reason below and resubmit your documents.
                </div>
                
                @if (Auth::user()->kycDetail->kyc_reject_reason)
                    <div class="alert alert-info">
                        <strong>Rejection Reason:</strong> {{ Auth::user()->kycDetail->kyc_reject_reason }}
                    </div>
                @endif
                
                <!-- KYC Form for resubmission -->
                <form action="{{ route('user.kyc.submit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kyc_doc_type" class="form-label">Document Type <span class="text-danger">*</span></label>
                            <select class="form-select" id="kyc_doc_type" name="kyc_doc_type" required>
                                <option value="">Select Document Type</option>
                                <option value="NIC" {{ old('kyc_doc_type', Auth::user()->kycDetail->kyc_doc_type) == 'NIC' ? 'selected' : '' }}>National Identity Card (NIC)</option>
                                <option value="DL" {{ old('kyc_doc_type', Auth::user()->kycDetail->kyc_doc_type) == 'DL' ? 'selected' : '' }}>Driving License (DL)</option>
                                <option value="Passport" {{ old('kyc_doc_type', Auth::user()->kycDetail->kyc_doc_type) == 'Passport' ? 'selected' : '' }}>Passport</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kyc_doc_number" class="form-label">Document Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="kyc_doc_number" name="kyc_doc_number" value="{{ old('kyc_doc_number', Auth::user()->kycDetail->kyc_doc_number) }}" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="kyc_doc_front" class="form-label">Front of Document <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="kyc_doc_front" name="kyc_doc_front" accept="image/*" required>
                            <small class="text-muted">Upload clear image of document front (Max: 2MB)</small>
                            @if (Auth::user()->kycDetail->kyc_doc_front)
                                <div class="mt-2">
                                    <small class="text-success">Current: Document uploaded</small>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="kyc_doc_back" class="form-label">Back of Document <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="kyc_doc_back" name="kyc_doc_back" accept="image/*" required>
                            <small class="text-muted">Upload clear image of document back (Max: 2MB)</small>
                            @if (Auth::user()->kycDetail->kyc_doc_back)
                                <div class="mt-2">
                                    <small class="text-success">Current: Document uploaded</small>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="selfie" class="form-label">Selfie with Document <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="selfie" name="selfie" accept="image/*" required>
                            <small class="text-muted">Take a selfie holding the document (Max: 2MB)</small>
                            @if (Auth::user()->kycDetail->selfie)
                                <div class="mt-2">
                                    <small class="text-success">Current: Selfie uploaded</small>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload me-2"></i>Resubmit KYC Documents
                        </button>
                    </div>
                </form>
            @endif
        @else
            <!-- No KYC submitted yet - Show form -->
            <div class="alert alert-info" role="alert">
                <i class="fas fa-info-circle me-2"></i>
                Please submit your KYC documents for verification. This is required for dealer account activation.
            </div>
            
            <form action="{{ route('user.kyc.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kyc_doc_type" class="form-label">Document Type <span class="text-danger">*</span></label>
                        <select class="form-select" id="kyc_doc_type" name="kyc_doc_type" required>
                            <option value="">Select Document Type</option>
                            <option value="NIC" {{ old('kyc_doc_type') == 'NIC' ? 'selected' : '' }}>National Identity Card (NIC)</option>
                            <option value="DL" {{ old('kyc_doc_type') == 'DL' ? 'selected' : '' }}>Driving License (DL)</option>
                            <option value="Passport" {{ old('kyc_doc_type') == 'Passport' ? 'selected' : '' }}>Passport</option>
                        </select>
                        @error('kyc_doc_type')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="kyc_doc_number" class="form-label">Document Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="kyc_doc_number" name="kyc_doc_number" value="{{ old('kyc_doc_number') }}" required>
                        @error('kyc_doc_number')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="kyc_doc_front" class="form-label">Front of Document <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="kyc_doc_front" name="kyc_doc_front" accept="image/*" required>
                        <small class="text-muted">Upload clear image of document front (Max: 2MB)</small>
                        @error('kyc_doc_front')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="kyc_doc_back" class="form-label">Back of Document <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="kyc_doc_back" name="kyc_doc_back" accept="image/*" required>
                        <small class="text-muted">Upload clear image of document back (Max: 2MB)</small>
                        @error('kyc_doc_back')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="selfie" class="form-label">Selfie with Document <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="selfie" name="selfie" accept="image/*" required>
                        <small class="text-muted">Take a selfie holding the document (Max: 2MB)</small>
                        @error('selfie')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Important:</strong> Please ensure all images are clear and readable. Documents with poor quality may be rejected.
                </div>
                
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload me-2"></i>Submit KYC Documents
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>
@endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const profileImageInput = document.getElementById('profileImageInput');
    const profileImagePreview = document.getElementById('profileImagePreview');
    const uploadStatus = document.getElementById('uploadStatus');
    
    // Handle file selection
    profileImageInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        
        if (file) {
            // Validate file
            if (!validateFile(file)) {
                return;
            }
            
            // Show preview
            showImagePreview(file);
            
            // Show success message
            showStatus('Image selected successfully! Click "Save Changes" to upload.', 'success');
        }
    });
    
    function validateFile(file) {
        // Check file size (2MB limit)
        if (file.size > 2 * 1024 * 1024) {
            showStatus('File size must be less than 2MB', 'error');
            profileImageInput.value = '';
            return false;
        }
        
        // Check file type
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!allowedTypes.includes(file.type)) {
            showStatus('Please select a valid image file (JPG, PNG, JPEG)', 'error');
            profileImageInput.value = '';
            return false;
        }
        
        return true;
    }
    
    function showImagePreview(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const imageUrl = e.target.result;
            
            // Create new image element
            const newImg = document.createElement('img');
            newImg.src = imageUrl;
            newImg.alt = 'Profile Image';
            newImg.className = 'profile-image-preview';
            newImg.id = 'profileImagePreview';
            newImg.style.cssText = 'width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 4px solid #ff3c00; cursor: pointer; box-shadow: 0 4px 12px rgba(255, 60, 0, 0.3);';
            
            // Replace current element with new image
            const wrapper = profileImagePreview.parentElement;
            wrapper.replaceChild(newImg, profileImagePreview);
        };
        reader.readAsDataURL(file);
    }
    
    function showStatus(message, type) {
        uploadStatus.innerHTML = `<div class="alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show" role="alert">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>`;
        
        // Auto-hide after 3 seconds
        setTimeout(() => {
            const alert = uploadStatus.querySelector('.alert');
            if (alert) {
                alert.remove();
            }
        }, 3000);
    }
    
    // Form submission handler
    document.getElementById('profileForm').addEventListener('submit', function(e) {
        const formData = new FormData(this);
        const file = formData.get('profile_image');
        
        if (file && file.size > 0) {
            console.log('Uploading profile image:', file.name, 'Size:', file.size);
            showStatus('Uploading profile image...', 'info');
        }
    });

    // KYC file validation
    const kycFileInputs = ['kyc_doc_front', 'kyc_doc_back', 'selfie'];
    
    kycFileInputs.forEach(inputId => {
        const input = document.getElementById(inputId);
        if (input) {
            input.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    validateKycFile(file, this);
                }
            });
        }
    });
    
    function validateKycFile(file, inputElement) {
        // Check file size (2MB limit)
        if (file.size > 2 * 1024 * 1024) {
            showKycError(inputElement, 'File size must be less than 2MB');
            inputElement.value = '';
            return false;
        }
        
        // Check file type
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!allowedTypes.includes(file.type)) {
            showKycError(inputElement, 'Please select a valid image file (JPG, PNG, JPEG)');
            inputElement.value = '';
            return false;
        }
        
        // Clear any previous error
        clearKycError(inputElement);
        showKycSuccess(inputElement, 'File selected successfully');
        return true;
    }
    
    function showKycError(inputElement, message) {
        clearKycError(inputElement);
        const errorDiv = document.createElement('div');
        errorDiv.className = 'text-danger small mt-1 kyc-error';
        errorDiv.textContent = message;
        inputElement.parentNode.appendChild(errorDiv);
    }
    
    function showKycSuccess(inputElement, message) {
        clearKycError(inputElement);
        const successDiv = document.createElement('div');
        successDiv.className = 'text-success small mt-1 kyc-error';
        successDiv.innerHTML = '<i class="fas fa-check me-1"></i>' + message;
        inputElement.parentNode.appendChild(successDiv);
    }
    
    function clearKycError(inputElement) {
        const existingErrors = inputElement.parentNode.querySelectorAll('.kyc-error');
        existingErrors.forEach(error => error.remove());
    }
});
</script>
@endsection
