@extends('layouts.user_sidebar')

@section('dashboard-content')
<div class="container">
    <h4 class="mb-4"><i class="fas fa-bell text-warning me-2"></i>Your Notifications</h4>

    @forelse ($notifications as $note)
        <div class="alert {{ $note->is_read ? 'alert-secondary' : 'alert-info' }}">
            <strong>{{ $note->type }}</strong>: {{ $note->message }}
            <br><small class="text-muted">{{ $note->created_at->diffForHumans() }}</small>
        </div>
    @empty
        <p class="text-muted">You have no notifications.</p>
    @endforelse
</div>
@endsection
