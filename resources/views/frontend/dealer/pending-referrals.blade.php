@extends('layouts.user_sidebar')

@section('dashboard-content')
<div class="container">
    <h4 class="mb-4"><i class="fas fa-user-plus text-primary me-2"></i>Pending Referral Approvals</h4>

    @if($referrals->isEmpty())
        <p class="text-muted">No pending referrals.</p>
    @else
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registered</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($referrals as $ref)
                    <tr>
                        <td>{{ $ref->referred->name }}</td>
                        <td>{{ $ref->referred->email }}</td>
                        <td>{{ $ref->referred->created_at->diffForHumans() }}</td>
                        <td>
                            <form method="POST" action="{{ route('dealer.referrals.approve', $ref->id) }}" class="d-inline">
                                @csrf
                                <button class="btn btn-success btn-sm">Approve</button>
                            </form>
                            <form method="POST" action="{{ route('dealer.referrals.reject', $ref->id) }}" class="d-inline ms-1">
                                @csrf
                                <button class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
