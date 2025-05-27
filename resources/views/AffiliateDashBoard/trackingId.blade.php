@extends ('AffiliateDashBoard.affmaster')

@section('content')
<!DOCTYPE html>
<html lang="en">
<body>

<!-- Display Flash Messages -->
<div class="container pt-4 px-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title card-title">Tracking ID</h2>
                <p>Create, view, or delete Tracking ID</p>
            </div>
            <div>
                <input type="text" placeholder="Search Raffle Tickets" class="form-control bg-white" />
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <h4>Create Raffle Ticket</h4>
                        <form action="{{ route('tracking_id_store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="tracking_id" class="form-label">User ID <span class="text-danger">*</span></label>
                                <input type="string" id="tracking_id" name="tracking_id" placeholder="Enter user ID" class="form-control" required />
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Create Tracking ID</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-9">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Token</th>
                                        <th>Created At</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($raffleTickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->id }}</td>
                                            <td>{{ $ticket->token }}</td>
                                            <td>{{ $ticket->created_at->format('Y-m-d') }}</td>
                                            <td class="text-end">
                                                
                                                <form action="{{ route('raffletickets.destroy', $ticket->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this ticket?')" title="Delete">
                                                        <i class="icon material-icons md-delete"></i>
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
            </div>
        </div>
    </section>

    <footer class="main-footer font-xs">
        <div class="row pb-30 pt-15">
            <div class="col-sm-6">
                <script>
                    document.write(new Date().getFullYear());
                </script>
                &copy; e-support Technologies.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end">All rights reserved</div>
            </div>
        </div>
    </footer>

    <script src="backend/assets/js/vendors/jquery-3.6.0.min.js"></script>
    <script src="backend/assets/js/vendors/bootstrap.bundle.min.js"></script>
    <script src="backend/assets/js/vendors/select2.min.js"></script>
    <script src="backend/assets/js/vendors/perfect-scrollbar.js"></script>
    <script src="backend/assets/js/vendors/jquery.fullscreen.min.js"></script>
    <script src="backend/assets/js/main.js?v=6.0" type="text/javascript"></script>
</body>
</html>
@endsection
