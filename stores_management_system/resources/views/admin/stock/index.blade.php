@extends('layouts.admin')

@section('title', 'Stock Transactions')

@section('content')
    <h1 class="mt-4">Stock Transaction</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Stock</li>
    </ol>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="page-header mb-4">
                    <h1 class="text-center fw-bold">Stock Transactions</h1>
                    <p class="text-center text-muted">Manage and track all stock movements</p>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 fw-light"><i class="fas fa-exchange-alt me-2"></i>Transaction List</h4>
                            <a href="{{ route('admin.stock.create') }}" class="btn btn-outline-light btn-sm">
                                <i class="fas fa-plus me-1"></i>Add Transaction
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-hover table-custom">
                                <thead>
                                    <tr class="text-uppercase text-muted">
                                        <th>Reference</th>
                                        <th>Items</th>
                                        <th>Type</th>
                                        <th>From Store</th>
                                        <th>To Store</th>
                                        <th>Date</th>
                                        <th>Employee</th>
                                        <th>Manager</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stock_transactions as $reference => $transactions)
                                        <tr class="align-middle">
                                            <td class="fw-bold">{{ $reference }}</td>
                                            <td>
                                                <ul class="list-unstyled mb-0">
                                                    @foreach ($transactions as $transaction)
                                                        <li>
                                                            <span class="badge bg-light text-dark">
                                                                {{ $transaction->item->name }} 
                                                                <span class="text-muted">(Qty: {{ $transaction->quantity }})</span>
                                                            </span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $transactions->first()->transaction_type == 'IN' ? 'success' : 'warning' }}">
                                                    {{ $transactions->first()->transaction_type }}
                                                </span>
                                            </td>
                                            <td>{{ $transactions->first()->fromStore ? $transactions->first()->fromStore->name : '-' }}</td>
                                            <td>{{ $transactions->first()->toStore->name }}</td>
                                            <td>
                                                <span class="text-muted">
                                                    <i class="fas fa-calendar-alt me-1"></i>
                                                    {{ $transactions->first()->transaction_date }}
                                                </span>
                                            </td>
                                            <td>{{ $transactions->first()->admin->name }}</td> <!-- Updated from employee to admin -->
                                            <td>{{ $transactions->first()->manager ? $transactions->first()->manager->name : '-' }}</td> <!-- Updated to use admin -->
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.stock.edit', $reference) }}" 
                                                       class="btn btn-outline-success btn-sm" 
                                                       title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('admin.stock.delete', $reference) }}" 
                                                       class="btn btn-outline-danger btn-sm" 
                                                       onclick="return confirm('Are you sure?')" 
                                                       title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <a href="{{ route('admin.stock.receipt', $reference) }}" 
                                                        class="btn btn-outline-secondary btn-sm" 
                                                        title="Receipt">
                                                            <i class="fas fa-receipt"></i>
                                                        </a>
                                                </div>
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
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="//cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                "pageLength": 10,
                "order": [[0, "desc"]],
                "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                "language": {
                    "search": "Filter records:",
                    "lengthMenu": "Show _MENU_ entries"
                }
            });
        });
    </script>

    <style>
        body {
            background-color: #f4f7fa;
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
        }
        .page-header h1 {
            color: #2c3e50;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
        .card {
            border-radius: 15px;
            background: #ffffff;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .bg-primary {
            background-color: #007bff;
            border: none;
        }
        .table-custom th {
            background: #f8f9fa;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            padding: 15px;
        }
        .table-custom td {
            padding: 15px;
            border-bottom: 1px solid #f1f3f5;
        }
        .btn-outline-success, .btn-outline-danger, .btn-outline-secondary {
            border-width: 2px;
            transition: all 0.3s ease;
        }
        .btn-outline-success {
            border-color: #28a745;
            color: #28a745;
        }
        .btn-outline-success:hover {
            background: #28a745;
            color: white;
        }
        .btn-outline-danger {
            border-color: #dc3545;
            color: #dc3545;
        }
        .btn-outline-danger:hover {
            background: #dc3545;
            color: white;
        }
        .btn-outline-secondary {
            border-color: #6c757d;
            color: #6c757d;
        }
        .btn-outline-secondary:hover {
            background: #6c757d;
            color: white;
        }
        .badge {
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 12px;
        }
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }
    </style>
@endsection