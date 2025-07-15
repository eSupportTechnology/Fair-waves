<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Image Upload Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="email"], input[type="file"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #ff3c00;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #e63400;
        }
        .profile-preview {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #ff3c00;
            margin: 10px 0;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <h1>Profile Image Upload Test</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Current Profile Image:</label>
            @if(auth()->user()->profile_image)
                <img src="{{ auth()->user()->profile_image_url }}" alt="Current Profile" class="profile-preview">
                <p>Image Path: {{ auth()->user()->profile_image }}</p>
                <p>Full URL: {{ auth()->user()->profile_image_url }}</p>
            @else
                <p>No profile image uploaded yet.</p>
                <img src="{{ asset('backend/assets/images/default-user.png') }}" alt="Default Profile" class="profile-preview">
            @endif
        </div>
        
        <div class="form-group">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" value="{{ auth()->user()->name }}" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" required>
        </div>
        
        <div class="form-group">
            <label for="profile_image">Profile Image:</label>
            <input type="file" id="profile_image" name="profile_image" accept="image/*">
            <small>Max size: 2MB. Supported formats: JPEG, PNG, JPG</small>
        </div>
        
        <button type="submit">Update Profile</button>
    </form>
    
    <hr>
    
    <h2>Debug Information</h2>
    <p><strong>User ID:</strong> {{ auth()->user()->id }}</p>
    <p><strong>User Name:</strong> {{ auth()->user()->name }}</p>
    <p><strong>User Email:</strong> {{ auth()->user()->email }}</p>
    <p><strong>Profile Image Column:</strong> {{ auth()->user()->profile_image ?? 'NULL' }}</p>
    <p><strong>Storage Path:</strong> {{ storage_path('app/public/profile_images') }}</p>
    <p><strong>Public Path:</strong> {{ public_path('storage/profile_images') }}</p>
    
    <script>
        // Preview image before upload
        document.getElementById('profile_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Create preview
                    const preview = document.createElement('img');
                    preview.src = e.target.result;
                    preview.className = 'profile-preview';
                    preview.style.marginTop = '10px';
                    
                    // Remove existing preview
                    const existingPreview = document.getElementById('imagePreview');
                    if (existingPreview) {
                        existingPreview.remove();
                    }
                    
                    // Add new preview
                    preview.id = 'imagePreview';
                    e.target.parentElement.appendChild(preview);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
