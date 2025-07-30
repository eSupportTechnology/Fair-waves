@extends('AdminDashboard.master')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        /* Style for the export button */
        #exportBtn {
            background: linear-gradient(45deg, #28a745, #20c997);
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            text-decoration: none;
            color: white;
        }
        
        #exportBtn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <section class="content-main">
        <div class="content-header">
            <div>
                <h2 class="content-title">Report - Customers</h2>
            </div>
            <div>
                <a href="{{ route('customers.export', request()->query()) }}" id="exportBtn" class="btn btn-primary rounded font-md">
                    <i class="fas fa-file-excel me-2"></i>Export to Excel
                </a>
            </div>
        </div>

        <!-- Customer Report Table -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- Customer Table -->
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="tableData" class="table table-hover display">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>DOB</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customers as $index=> $customer)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $customer->name }} </td>
                                        <td>{{ $customer->dob }} </td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->address }}</td>

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

    <!-- JavaScript to handle delete confirmation -->
    <script>
        $(document).ready(function() {
            var table = $('#tableData').DataTable({
                dom: 'Bfrtip', // Layout for DataTables with Buttons
                buttons: [{
                        extend: 'copyHtml5',
                        footer: true
                    },
                    {
                        extend: 'excelHtml5',
                        footer: true
                    },
                    {
                        extend: 'csvHtml5',
                        footer: true
                    },
                    {
                        extend: 'pdfHtml5',
                        footer: true,
                        title: 'Customer Report',
                        customize: function(doc) {
                            // Set a margin for the footer
                            doc.content[1].margin = [0, 0, 0, 20];
                        }
                    },
                    {
                        extend: 'print',
                        footer: true,
                        title: 'Customer Report',
                    }
                ],

            });


        });
    </script>



</body>

</html>
@endsection