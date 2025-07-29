@extends('AdminDashboard.master')

@section('content')
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Edit Delivery Fee</h2>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('fees.update', ['fee' => $fee->id]) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="feeAmount" class="form-label">Fee Amount</label>
                    <input type="number" class="form-control" id="feeAmount" name="fee"
                           value="{{ old('fee', $fee->fee) }}" step="0.01" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Fee</button>
                <a href="{{ route('fees.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </form>
        </div>
    </div>
@endsection
