@extends('layouts.user_sidebar')

@section('dashboard-content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
    /* ==========================
       MODAL STYLES - IMPROVED
    ========================== */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(3px);
        justify-content: center;
        align-items: center;
        z-index: 1050;
        animation: fadeIn 0.3s ease;
    }

    .modal-overlay.active {
        display: flex;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translate(-50%, -60%) scale(0.9);
        }
        to {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
    }

    .modal-content {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: white;
        padding: 0;
        border-radius: 16px;
        width: 90%;
        max-width: 600px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow:
            0 20px 60px rgba(0, 0, 0, 0.15),
            0 8px 25px rgba(0, 0, 0, 0.1);
        animation: slideIn 0.3s ease;
    }

    .modal-header {
        padding: 24px 24px 0 24px;
        border-bottom: 1px solid #e9ecef;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0;
    }

    .modal-header h3 {
        margin: 0 0 16px 0;
        color: #2c3e50;
        font-size: 20px;
        font-weight: 600;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 24px;
        color: #666;
        cursor: pointer;
        padding: 0;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.2s ease;
    }

    .modal-close:hover {
        background: #f8f9fa;
        color: #333;
    }

    .modal-body {
        padding: 24px;
        padding-top: 16px;
    }

    /* ==========================
       FORM STYLES - IMPROVED
    ========================== */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 24px;
    }

    .form-field {
        position: relative;
    }

    .form-field.full-width {
        grid-column: 1 / -1;
    }

    .form-field label {
        display: block;
        margin-bottom: 6px;
        font-weight: 500;
        color: #374151;
        font-size: 14px;
    }

    .form-field .input-wrapper {
        position: relative;
    }

    .form-field .input-wrapper i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 14px;
        z-index: 1;
    }

    .form-field input[type="text"],
    .form-field input[type="email"],
    .form-field input[type="tel"] {
        width: 100%;
        padding: 12px 12px 12px 36px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.2s ease;
        background: #fff;
    }

    .form-field input:focus {
        outline: none;
        border-color: #4CAF50;
        box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
    }

    .form-field input:focus + i {
        color: #4CAF50;
    }

    .checkbox-field {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px;
        background: #f8f9fa;
        border-radius: 8px;
        border: 2px solid #e9ecef;
        transition: all 0.2s ease;
    }

    .checkbox-field:hover {
        border-color: #4CAF50;
        background: #f0f9f0;
    }

    .checkbox-field input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: #4CAF50;
        cursor: pointer;
    }

    .checkbox-field label {
        margin: 0;
        cursor: pointer;
        font-weight: 500;
        color: #374151;
    }

    /* ==========================
       BUTTON STYLES - IMPROVED
    ========================== */
    .btn-group {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        padding-top: 20px;
        border-top: 1px solid #e9ecef;
        margin-top: 24px;
    }

    .btn {
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        min-width: 100px;
        justify-content: center;
    }

    .btn-primary {
        background: linear-gradient(135deg, #4CAF50, #45a049);
        color: white;
        border: 2px solid transparent;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #45a049, #3d8b40);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
    }

    .btn-secondary {
        background: #f8f9fa;
        color: #6c757d;
        border: 2px solid #e9ecef;
    }

    .btn-secondary:hover {
        background: #e9ecef;
        color: #495057;
        border-color: #dee2e6;
    }

    .btn-danger {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: white;
        border: 2px solid transparent;
    }

    .btn-danger:hover {
        background: linear-gradient(135deg, #c82333, #bd2130);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    .btn-info {
        background: linear-gradient(135deg, #17a2b8, #138496);
        color: white;
        border: 2px solid transparent;
    }

    .btn-info:hover {
        background: linear-gradient(135deg, #138496, #117a8b);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
        color: white;
        text-decoration: none;
    }

    /* ==========================
       ADDRESS CARD STYLES - ENHANCED
    ========================== */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 2px solid #e9ecef;
    }

    .page-title {
        font-size: 24px;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
    }

    .address-cards-container {
        padding: 20px 0;
    }

    .address-card {
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
        border: 1px solid #e3e6ea;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
        box-shadow:
            0 4px 6px rgba(0, 0, 0, 0.05),
            0 1px 3px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .address-card:hover {
        transform: translateY(-4px);
        box-shadow:
            0 12px 28px rgba(0, 0, 0, 0.12),
            0 6px 12px rgba(0, 0, 0, 0.08);
        border-color: #4CAF50;
    }

    .address-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, #4CAF50, #45a049);
        border-radius: 0 2px 2px 0;
    }

    .address-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .address-card-title {
        font-size: 18px;
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .address-card-title i {
        color: #4CAF50;
        font-size: 16px;
    }

    .default-badge {
        background: linear-gradient(135deg, #4CAF50, #45a049);
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 6px rgba(76, 175, 80, 0.3);
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .address-card-content {
        margin-bottom: 24px;
    }

    .address-info-row {
        display: flex;
        align-items: flex-start;
        margin-bottom: 12px;
        color: #555;
        font-size: 14px;
        line-height: 1.6;
    }

    .address-info-row i {
        width: 20px;
        color: #4CAF50;
        margin-right: 14px;
        font-size: 14px;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .address-info-row span {
        flex: 1;
        word-break: break-word;
    }

    .address-card-actions {
        display: flex;
        gap: 12px;
        padding-top: 20px;
        border-top: 1px solid #e9ecef;
        flex-wrap: wrap;
    }

    .no-addresses {
        text-align: center;
        padding: 80px 20px;
        color: #6c757d;
        background: #f8f9fa;
        border-radius: 16px;
        border: 2px dashed #dee2e6;
    }

    .no-addresses i {
        font-size: 64px;
        color: #dee2e6;
        margin-bottom: 20px;
        display: block;
    }

    .no-addresses h4 {
        margin-bottom: 12px;
        color: #495057;
        font-weight: 600;
        font-size: 20px;
    }

    .no-addresses p {
        margin: 0;
        font-size: 16px;
        color: #6c757d;
    }

    /* ==========================
       ALERT STYLES
    ========================== */
    .alert {
        padding: 16px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .alert-success::before {
        content: '\f00c';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        color: #28a745;
    }

    /* ==========================
       RESPONSIVE DESIGN
    ========================== */
    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .modal-content {
            width: 95%;
            margin: 20px;
        }

        .modal-header,
        .modal-body {
            padding: 20px;
        }

        .page-header {
            flex-direction: column;
            gap: 16px;
            align-items: flex-start;
        }

        .address-card {
            padding: 20px;
            margin-bottom: 20px;
        }

        .address-card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 12px;
        }

        .address-card-actions {
            justify-content: center;
        }

        .btn {
            flex: 1;
            min-width: 120px;
        }
    }

    @media (max-width: 576px) {
        .address-cards-container {
            padding: 10px 0;
        }

        .address-card {
            padding: 16px;
        }

        .address-info-row {
            font-size: 13px;
        }

        .address-card-actions {
            flex-direction: column;
        }

        .btn {
            min-width: 100%;
        }

        .btn-group {
            flex-direction: column;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <h1 class="page-title">
        <i class="fas fa-address-book"></i>
        Address Book
    </h1>
    <button class="btn btn-primary" onclick="openAddModal()">
        <i class="fas fa-plus"></i>
        Add New Address
    </button>
</div>

<!-- Success Alert -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Address Cards -->
<div class="address-cards-container">
    <div class="row">
        @forelse($addresses as $address)
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                <div class="address-card">
                    <div class="address-card-header">
                        <h6 class="address-card-title">
                            <i class="fas fa-user-circle"></i>
                            {{ $address->full_name ?? ($address->fname . ' ' . $address->lname) }}
                        </h6>
                        @if($address->default)
                            <span class="default-badge">
                                <i class="fas fa-star"></i>
                                Default
                            </span>
                        @endif
                    </div>

                    <div class="address-card-content">
                        <div class="address-info-row">
                            <i class="fas fa-phone"></i>
                            <span>{{ $address->phone_num ?? $address->phone }}</span>
                        </div>
                        <div class="address-info-row">
                            <i class="fas fa-envelope"></i>
                            <span>{{ $address->email }}</span>
                        </div>
                        <div class="address-info-row">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>
                                {{ $address->address }}{{ $address->apartment ? ', ' . $address->apartment : '' }}<br>
                                {{ $address->city }}, {{ $address->postal_code }}
                            </span>
                        </div>
                    </div>

                    <div class="address-card-actions">
                        <button class="btn btn-info" onclick="openEditModal({{ json_encode($address) }})">
                            <i class="fas fa-edit"></i>
                            Edit
                        </button>
                        <button class="btn btn-danger" onclick="confirmDelete({{ $address->id }})">
                            <i class="fas fa-trash"></i>
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="no-addresses">
                    <i class="fas fa-address-book"></i>
                    <h4>No Addresses Found</h4>
                    <p>You haven't added any addresses yet. Click "Add New Address" to create your first address.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Add Address Modal -->
<div class="modal-overlay" id="addModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Add New Address</h3>
            <button class="modal-close" onclick="closeAddModal()" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('storeAddress') }}" method="POST" id="addAddressForm">
                @csrf
                <div class="form-grid">
                    <div class="form-field">
                        <label for="add_fname">First Name</label>
                        <div class="input-wrapper">
                            <i class="fas fa-user"></i>
                            <input type="text" name="fname" id="add_fname" placeholder="Enter first name"
                                   value="{{ old('fname', auth()->user()->fname ?? '') }}" required>
                        </div>
                    </div>
                    <div class="form-field">
                        <label for="add_lname">Last Name</label>
                        <div class="input-wrapper">
                            <i class="fas fa-user"></i>
                            <input type="text" name="lname" id="add_lname" placeholder="Enter last name"
                                   value="{{ old('lname', auth()->user()->lname ?? '') }}" required>
                        </div>
                    </div>
                    <div class="form-field">
                        <label for="add_phone">Phone Number</label>
                        <div class="input-wrapper">
                            <i class="fas fa-phone"></i>
                            <input type="tel" name="phone" id="add_phone" placeholder="Enter phone number"
                                   value="{{ old('phone', auth()->user()->phone ?? auth()->user()->phone_num ?? '') }}" required>
                        </div>
                    </div>
                    <div class="form-field">
                        <label for="add_email">Email Address</label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" id="add_email" placeholder="Enter email address"
                                   value="{{ old('email', auth()->user()->email ?? '') }}" required>
                        </div>
                    </div>
                    <div class="form-field full-width">
                        <label for="add_address">Street Address</label>
                        <div class="input-wrapper">
                            <i class="fas fa-home"></i>
                            <input type="text" name="address" id="add_address" placeholder="Enter street address"
                                   value="{{ old('address', auth()->user()->address ?? '') }}" required>
                        </div>
                    </div>
                    <div class="form-field">
                        <label for="add_apartment">Apartment/Unit (Optional)</label>
                        <div class="input-wrapper">
                            <i class="fas fa-building"></i>
                            <input type="text" name="apartment" id="add_apartment" placeholder="Apt, Suite, Unit"
                                   value="{{ old('apartment') }}">
                        </div>
                    </div>
                    <div class="form-field">
                        <label for="add_city">City</label>
                        <div class="input-wrapper">
                            <i class="fas fa-city"></i>
                            <input type="text" name="city" id="add_city" placeholder="Enter city"
                                   value="{{ old('city') }}" required>
                        </div>
                    </div>
                    <div class="form-field">
                        <label for="add_postal_code">Postal Code</label>
                        <div class="input-wrapper">
                            <i class="fas fa-mail-bulk"></i>
                            <input type="text" name="postal_code" id="add_postal_code" placeholder="Enter postal code"
                                   value="{{ old('postal_code') }}" required>
                        </div>
                    </div>
                    <div class="form-field full-width">
                        <div class="checkbox-field">
                            <input type="checkbox" name="default" id="add_default" value="on">
                            <label for="add_default">Set as default address</label>
                        </div>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-danger" onclick="closeAddModal()">
                        <i class="fas fa-times"></i>
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i>
                        Save Address
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Address Modal -->
<div class="modal-overlay" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Edit Address</h3>
            <button class="modal-close" onclick="closeEditModal()" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('updateAddress') }}" method="POST" id="editAddressForm">
                @csrf
                <input type="hidden" name="address_id" id="edit_address_id">
                <div class="form-grid">
                    <div class="form-field">
                        <label for="edit_fname">First Name</label>
                        <div class="input-wrapper">
                            <i class="fas fa-user"></i>
                            <input type="text" name="fname" id="edit_fname" placeholder="Enter first name" required>
                        </div>
                    </div>
                    <div class="form-field">
                        <label for="edit_lname">Last Name</label>
                        <div class="input-wrapper">
                            <i class="fas fa-user"></i>
                            <input type="text" name="lname" id="edit_lname" placeholder="Enter last name" required>
                        </div>
                    </div>
                    <div class="form-field">
                        <label for="edit_phone">Phone Number</label>
                        <div class="input-wrapper">
                            <i class="fas fa-phone"></i>
                            <input type="tel" name="phone" id="edit_phone" placeholder="Enter phone number" required>
                        </div>
                    </div>
                    <div class="form-field">
                        <label for="edit_email">Email Address</label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" id="edit_email" placeholder="Enter email address" required>
                        </div>
                    </div>
                    <div class="form-field full-width">
                        <label for="edit_address">Street Address</label>
                        <div class="input-wrapper">
                            <i class="fas fa-home"></i>
                            <input type="text" name="address" id="edit_address" placeholder="Enter street address" required>
                        </div>
                    </div>
                    <div class="form-field">
                        <label for="edit_apartment">Apartment/Unit (Optional)</label>
                        <div class="input-wrapper">
                            <i class="fas fa-building"></i>
                            <input type="text" name="apartment" id="edit_apartment" placeholder="Apt, Suite, Unit">
                        </div>
                    </div>
                    <div class="form-field">
                        <label for="edit_city">City</label>
                        <div class="input-wrapper">
                            <i class="fas fa-city"></i>
                            <input type="text" name="city" id="edit_city" placeholder="Enter city" required>
                        </div>
                    </div>
                    <div class="form-field">
                        <label for="edit_postal_code">Postal Code</label>
                        <div class="input-wrapper">
                            <i class="fas fa-mail-bulk"></i>
                            <input type="text" name="postal_code" id="edit_postal_code" placeholder="Enter postal code" required>
                        </div>
                    </div>
                    <div class="form-field full-width">
                        <div class="checkbox-field">
                            <input type="checkbox" name="default" id="edit_default" value="on">
                            <label for="edit_default">Set as default address</label>
                        </div>
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-danger" onclick="closeEditModal()">
                        <i class="fas fa-times"></i>
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i>
                        Update Address
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal-overlay" id="deleteModal">
    <div class="modal-content" style="max-width: 400px;">
        <div class="modal-header">
            <h3>Confirm Delete</h3>
            <button class="modal-close" onclick="closeDeleteModal()" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div style="text-align: center; margin-bottom: 24px;">
                <i class="fas fa-exclamation-triangle" style="font-size: 48px; color: #dc3545; margin-bottom: 16px;"></i>
                <p style="font-size: 16px; color: #495057; margin: 0;">
                    Are you sure you want to delete this address? This action cannot be undone.
                </p>
            </div>
            <form id="deleteAddressForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="btn-group" style="border-top: none; margin-top: 0; padding-top: 0;">
                    <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">
                        <i class="fas fa-times"></i>
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        Delete Address
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Modal Management
    function openAddModal() {
        document.getElementById('addModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeAddModal() {
        document.getElementById('addModal').classList.remove('active');
        document.body.style.overflow = 'auto';
        document.getElementById('addAddressForm').reset();
    }

    function openEditModal(address) {
        // Handle both possible field name variations
        const firstName = address.fname || address.first_name || '';
        const lastName = address.lname || address.last_name || '';
        const phone = address.phone_num || address.phone || '';

        document.getElementById('edit_address_id').value = address.id;
        document.getElementById('edit_fname').value = firstName;
        document.getElementById('edit_lname').value = lastName;
        document.getElementById('edit_phone').value = phone;
        document.getElementById('edit_email').value = address.email || '';
        document.getElementById('edit_address').value = address.address || '';
        document.getElementById('edit_apartment').value = address.apartment || '';
        document.getElementById('edit_city').value = address.city || '';
        document.getElementById('edit_postal_code').value = address.postal_code || '';
        document.getElementById('edit_default').checked = address.default || false;

        document.getElementById('editModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.remove('active');
        document.body.style.overflow = 'auto';
        document.getElementById('editAddressForm').reset();
    }

    function confirmDelete(addressId) {
        const form = document.getElementById('deleteAddressForm');
        const action = '{{ route("address.delete", ":id") }}';
        form.action = action.replace(':id', addressId);

        document.getElementById('deleteModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(event) {
        const modals = ['addModal', 'editModal', 'deleteModal'];

        modals.forEach(modalId => {
            const modal = document.getElementById(modalId);
            if (event.target === modal) {
                modal.classList.remove('active');
                document.body.style.overflow = 'auto';

                // Reset forms when closing
                if (modalId === 'addModal') {
                    document.getElementById('addAddressForm').reset();
                } else if (modalId === 'editModal') {
                    document.getElementById('editAddressForm').reset();
                }
            }
        });
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const activeModal = document.querySelector('.modal-overlay.active');
            if (activeModal) {
                activeModal.classList.remove('active');
                document.body.style.overflow = 'auto';

                // Reset forms when closing
                if (activeModal.id === 'addModal') {
                    document.getElementById('addAddressForm').reset();
                } else if (activeModal.id === 'editModal') {
                    document.getElementById('editAddressForm').reset();
                }
            }
        }
    });

    // Form validation
    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('form');

        forms.forEach(form => {
            form.addEventListener('submit', function(event) {
                const requiredFields = form.querySelectorAll('input[required]');
                let isValid = true;

                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.style.borderColor = '#dc3545';
                        field.focus();
                    } else {
                        field.style.borderColor = '#e5e7eb';
                    }
                });

                if (!isValid) {
                    event.preventDefault();
                    // You can add a toast notification here
                    console.log('Please fill in all required fields');
                }
            });
        });

        // Real-time validation
        document.querySelectorAll('input[required]').forEach(field => {
            field.addEventListener('blur', function() {
                if (!this.value.trim()) {
                    this.style.borderColor = '#dc3545';
                } else {
                    this.style.borderColor = '#e5e7eb';
                }
            });

            field.addEventListener('input', function() {
                if (this.value.trim()) {
                    this.style.borderColor = '#4CAF50';
                }
            });
        });
    });

    // Auto-hide success alerts
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.remove();
                }, 500);
            }, 5000);
        });
    });
</script>

@endsection
