@extends('AdminDashboard.master')

@section('content')
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Delivery Fees</h2>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createFeeModal">
            Add Delivery Fee
        </button>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fee (Rs)</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fees as $fee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>Rs. {{ number_format($fee->fee, 2) }}</td>
                                <td class="text-end">
                                    <a href="{{ route('fees.edit', $fee) }}" class="btn btn-warning btn-sm me-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form id="deleteForm{{ $fee->id }}"
                                        action="{{ route('fees.destroy', $fee->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete('deleteForm{{ $fee->id }}', 'Are you sure you want to delete this fee?')">
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

    <!-- Create Fee Modal -->
    <div class="modal fade" id="createFeeModal" tabindex="-1" aria-labelledby="createFeeLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="createFeeForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Delivery Fee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="feeAmount" class="form-label">Fee Amount (Rs)</label>
                            <input type="number" class="form-control" name="fee" id="feeAmount" required step="0.01" min="0">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveFeeBtn">Save Fee</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('saveFeeBtn').addEventListener('click', function () {
            const form = document.getElementById('createFeeForm');
            const formData = new FormData(form);

            fetch('{{ route('fees.store') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    var modal = bootstrap.Modal.getInstance(document.getElementById('createFeeModal'));
                    modal.hide();
                    Swal.fire('Success', 'Fee added successfully!', 'success').then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', data.message || 'Failed to create fee.', 'error');
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
