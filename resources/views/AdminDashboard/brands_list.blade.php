@extends('AdminDashboard.master')

@section('content')
    <style>
        .brand-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>

    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Brands</h2>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBrandModal">
            Create Brand
        </button>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Brand Name</th>
                            <th>Slug</th>
                            <th>Image</th>
                            <th>Top Brand</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>{{ $brand->slug }}</td>
                                <td>
                                    @if ($brand->image)
                                        <img src="{{ asset('storage/' . $brand->image) }}" class="brand-image"
                                            alt="{{ $brand->name }}">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $brand->is_top_brand ? 'success' : 'secondary' }}">
                                        {{ $brand->is_top_brand ? 'Yes' : 'No' }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-warning btn-sm me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form id="deleteForm{{ $brand->id }}"
                                        action="{{ route('brands.destroy', $brand->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete('deleteForm{{ $brand->id }}', 'Are you sure you want to delete this brand?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Create Brand Modal -->
    <div class="modal fade" id="createBrandModal" tabindex="-1" aria-labelledby="createBrandLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createBrandForm" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="brandName" class="form-label">Brand Name</label>
                            <input type="text" class="form-control" name="name" id="brandName" required>
                        </div>

                        <div class="mb-3">
                            <label for="brandSlug" class="form-label">Slug</label>
                            <input type="text" class="form-control" name="slug" id="brandSlug" required>
                        </div>

                        <div class="mb-3">
                            <label for="brandImage" class="form-label">Image</label>
                            <input type="file" class="form-control" name="image" id="brandImage" accept="image/*">
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" name="is_top_brand" id="isTopBrand"
                                value="1">
                            <label class="form-check-label" for="isTopBrand">Top Brand</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="saveBrandBtn">Save Brand</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('saveBrandBtn').addEventListener('click', function() {
            const form = document.getElementById('createBrandForm');
            const formData = new FormData(form);

            fetch('{{ route('brands.store') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        var modal = bootstrap.Modal.getInstance(document.getElementById('createBrandModal'));
                        modal.hide();
                        Swal.fire('Success', 'Brand created successfully!', 'success').then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', data.message || 'Failed to create brand.', 'error');
                    }
                })
                .catch(error => {
                    console.error(error);
                    Swal.fire('Error', 'An error occurred while saving.', 'error');
                });
        });

        function confirmDelete(formId, message) {
            Swal.fire({
                title: 'Are you sure?',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        }
    </script>
@endsection
