@extends ('AffiliateDashBoard.affmaster')

@section('content')

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Update Bank Account</h2>
        <p>Link your new bank account for withdrawals</p>
    </div>
</div>

<style>
    .add-bank-account-container {
        padding: 30px;
        margin-top:5%;
        margin-left: 25%; /* Increased margin for more left space */
        background-color: #f9f9f9;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        max-width: 600px;
    }

    .add-bank-account-container h1 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
    }

    .form-group label {
        font-weight: 600;
        color: #555;
    }

    .form-group input[type="text"] {
        border: 1px solid #ccc;
        border-radius: 6px;
        padding: 10px;
        transition: border-color 0.3s ease;
    }

    .form-group input[type="text"]:focus {
        border-color: #007bff;
        outline: none;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

<div class="add-bank-account-container">
    
    <form action="{{ route('updatebank') }}" method="POST">
        @csrf
        <!-- Bank Name -->
        <div class="form-group">
            <label for="bank_name">Bank Name</label>
            <input type="text" class="form-control" id="bank_name" name="bank_name" required>
        </div>

        <!-- Branch Name -->
        <div class="form-group">
            <label for="branch">Branch</label>
            <input type="text" class="form-control" id="branch" name="branch" required>
        </div>

        <!-- Account Holder Name -->
        <div class="form-group">
            <label for="account_name">Account Holder Name</label>
            <input type="text" class="form-control" id="account_name" name="account_name" required>
        </div>

        <!-- Account Number -->
        <div class="form-group">
            <label for="account_number">Account Number</label>
            <input type="text" class="form-control" id="account_number" name="account_number" required>
        </div>

        <!-- Submit Button -->
        <div style="display: flex; justify-content: center; margin-top: 20px;">
            <button type="submit" class="btn btn-primary">Add Bank Account</button>
        </div>
    </form>
</div>

@endsection
