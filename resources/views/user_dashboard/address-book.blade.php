@extends('layouts.user_sidebar')

@section('dashboard-content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        /* Center popup container */
        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .popup-content {
            background: white;
            padding: 20px;
            border-radius: 25px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .popup-content h2 {
            margin-top: 0;
            text-align: center;
        }
        .form-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            position: relative;
            justify-content: center;
        }
        .form-container .icon-input {
            position: relative;
            width: 95%;
        }
        .form-container .icon-input i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #ccc;
        }
        .form-container input {
            width: 100%;
            padding: 10px 10px 10px 40px;
            border-radius: 25px;
            border: 1px solid #ccc;
            outline: none;
        }
        .close-popup {
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 25px;
            color: #333;
        }
        .form-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }
        .form-buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .save-btn {
            background-color: #4CAF50;
            color: white;
        }
        .address-card {
            border: 1px solid hsl(12, 96%, 49%);
            background: #f8fbff;
        }
        
        .custom-red-btn {
             color: red !important; /* Text color set to red */
        }
        .btn-primary {
             background-color: #ff3c00 !important;
             border-color:#ff3c00!important;
        }
                
    </style>


<h4 class="px-2 py-2">Address Book</h4>

<button class="mt-3 btn btn-primary" onclick="openPopup()">+ Add New</button>

<!-- Displaying Address Cards -->
<div class="mt-4 row">
    <div class="mb-3 col-md-4">
        <div class="card address-card" style="margin-top:20px;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 card-title">John Doe</h6>
                </div>
                <p class="card-text">
                    123-456-7890<br>
                    john.doe@example.com<br>
                    123 Main St, Apt 101<br>
                    New York<br>
                    10001
                </p>
                <div class="d-flex">
                    <button class="btn btn-sm custom-red-btn" onclick="openEditPopup()">Edit</button>
                    <button class="btn btn-sm custom-red-btn" onclick="showDeleteModal()">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Address Modal -->
<div class="popup" id="popup">
    <div class="popup-content">
        <span class="close-popup" onclick="closePopup()">&times;</span>
        <h3>Add Address</h3>
        <form id="addAddressForm">
            <div class="form-container">
                <div class="icon-input">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="First name" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-phone"></i>
                    <input type="text" placeholder="Phone" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-envelope"></i>
                    <input type="email" placeholder="Email" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-home"></i>
                    <input type="text" placeholder="Street Address" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-home"></i>
                    <input type="text" placeholder="Apartment, Suite, Unit (Optional)">
                </div>
                <div class="icon-input">
                    <i class="fas fa-city"></i>
                    <input type="text" placeholder="City" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-mail-bulk"></i>
                    <input type="text" placeholder="Postal code" required>
                </div>
                <div class="icon-input checkbox-container" style="display: flex; align-items: center; padding-left: 30px;">
                    <input type="checkbox" id="default" style="margin-right: 10px; width: auto;">
                    <label for="default" style="margin: 0;">Set as default address</label>
                </div>
            </div>
            <div class="form-buttons">
                <button type="button" class="save-btn" onclick="closePopup()">
                    <i class="fas fa-check"></i> Save
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Edit Address Modal -->
<div class="popup" id="editPopup">
    <div class="popup-content">
        <span class="close-popup" onclick="closeEditPopup()">&times;</span>
        <h4>Edit Address</h4>
        <form id="editAddressForm">
            <div class="form-container">
                <div class="icon-input">
                    <i class="fas fa-user"></i>
                    <input type="text" id="edit_first_name" placeholder="First name" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-phone"></i>
                    <input type="text" id="edit_phone" placeholder="Phone" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="edit_email" placeholder="Email" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-home"></i>
                    <input type="text" id="edit_address" placeholder="Street Address" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-home"></i>
                    <input type="text" id="edit_apartment" placeholder="Apartment, Suite, Unit (Optional)">
                </div>
                <div class="icon-input">
                    <i class="fas fa-city"></i>
                    <input type="text" id="edit_city" placeholder="City" required>
                </div>
                <div class="icon-input">
                    <i class="fas fa-mail-bulk"></i>
                    <input type="text" id="edit_postal_code" placeholder="Postal code" required>
                </div>
                <div class="icon-input checkbox-container" style="display: flex; align-items: center; padding-left: 30px;">
                    <input type="checkbox" id="edit_default" style="margin-right: 10px; width: auto;">
                    <label for="edit_default" style="margin: 0;">Set as default address</label>
                </div>
            </div>
            <div class="form-buttons">
                <button type="button" class="save-btn" onclick="closeEditPopup()">
                    <i class="fas fa-check"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this address?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" onclick="closeDeleteModal()">Delete</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function openPopup() {
        document.getElementById("popup").style.display = "flex";
    }
    function closePopup() {
        document.getElementById("popup").style.display = "none";
    }
    function openEditPopup() {
        document.getElementById("editPopup").style.display = "flex";
    }
    function closeEditPopup() {
        document.getElementById("editPopup").style.display = "none";
    }
    function showDeleteModal() {
        $('#deleteModal').modal('show');
    }
    function closeDeleteModal() {
        $('#deleteModal').modal('hide');
    }
</script>



@endsection