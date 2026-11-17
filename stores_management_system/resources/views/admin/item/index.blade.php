@extends('layouts.admin')

@section('title', 'Item Page')

@section('content')

    <h1 class="mt-4">Items</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Category</li>
    </ol>

    <!-- External CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <div class="container mt-5">
        <!-- Total Items Count -->
        <div class="alert alert-info shadow-sm rounded-3 mb-4">
            Total Items: <strong>{{ $totalItemsCount }}</strong>
        </div>

        <!-- Filter Form -->
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-header d-flex justify-content-between align-items-center rounded-top-3">
                <h4 class="mb-0">Filter Items</h4>
                <button type="button" class="btn btn-primary btn-sm rounded-pill" data-bs-toggle="collapse" data-bs-target="#filterCollapse">Toggle Filters</button>
            </div>
            <div id="filterCollapse" class="card-body p-4 collapse show">
                <form id="filterForm" method="GET" action="{{ url('admin/item') }}">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Sub Category</label>
                            <select name="subCategory_id" class="form-control select2 rounded-3 shadow-sm">
                                <option value="">All Sub Categories</option>
                                @foreach($sub_category as $sub)
                                    <option value="{{ $sub->subCategory_id }}" {{ request('subCategory_id') == $sub->subCategory_id ? 'selected' : '' }}>
                                        {{ $sub->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Store</label>
                            <select name="store_id" class="form-control select2 rounded-3 shadow-sm">
                                <option value="">All Stores</option>
                                @foreach($stores as $store)
                                    <option value="{{ $store->store_id }}" {{ request('store_id') == $store->store_id ? 'selected' : '' }}>
                                        {{ $store->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm w-100">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Items Table -->
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header d-flex justify-content-between align-items-center rounded-top-3">
                <h4 class="mb-0">Items</h4>
                <a href="{{ url('admin/item/create') }}" class="btn btn-primary btn-sm rounded-pill"><i class="fas fa-plus"></i> Add Item</a>
            </div>
            <div class="card-body p-4">
                <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Item ID</th>
                            <th>Name</th>
                            <th>Identifiers</th>
                            <th>Model</th>
                            <th>Unit Price</th>
                            <th>Stock Quantity</th>
                            <th>Is Active</th>
                            <th>Threshold</th>
                            <th>Sub Category</th>
                            <th>Store</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item as $item)
                        <tr>
                            <td>{{ $item->item_id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @if($item->barcodes->isNotEmpty())
                                    <div><strong>Barcodes:</strong></div>
                                    @foreach($item->barcodes as $barcode)
                                        <div class="mb-1">
                                            @if(Storage::disk('public')->exists('barcodes/' . $barcode->id . '.png'))
                                                <img src="{{ asset('storage/barcodes/' . $barcode->id . '.png') }}" alt="Barcode" class="img-fluid" style="max-width: 100px;">
                                            @else
                                                <p>Barcode image not found</p>
                                            @endif
                                            <span class="barcode-text">{{ $barcode->barcode }}</span>
                                        </div>
                                    @endforeach
                                @endif
                                @if($item->serialNumbers->isNotEmpty())
    <div><strong>Serial Numbers:</strong></div>
    @foreach($item->serialNumbers as $serial)
        <div class="mb-1">
            @if(Storage::disk('public')->exists('barcodes/serial_' . $serial->id . '.png'))
                <img src="{{ asset('storage/barcodes/serial_' . $serial->id . '.png') }}" alt="Serial QR" class="img-fluid" style="max-width: 40px;">
            @else
                <p>Serial QR not found (URL: {{ asset('storage/barcodes/serial_' . $serial->id . '.png') }})</p>
            @endif
            <span class="barcode-text">{{ $serial->serial_number }}</span>
        </div>
    @endforeach
@endif
                                @if($item->barcodes->isEmpty() && $item->serialNumbers->isEmpty())
                                    <span>No identifiers available</span>
                                @endif
                            </td>
                            <td>{{ $item->make_model }}</td>
                            <td>{{ number_format($item->unit_price, 2) }}</td>
                            <td>{{ $item->stock_quantity }}</td>
                            <td>
                                <span class="badge {{ $item->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $item->is_active ? 'Active' : 'In-Active' }}
                                </span>
                            </td>
                            <td>{{ $item->threshold }}</td>
                            <td>{{ $item->sub_category ? $item->sub_category->name : 'N/A' }}</td>
                            <td>{{ $item->stores ? $item->stores->name : 'N/A' }}</td>
                            <td class="action-buttons">
                                <a href="{{ url('admin/item/'.$item->item_id.'/edit') }}" class="btn btn-success btn-sm mx-1" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="{{ url('admin/item/'.$item->item_id.'/delete') }}" class="btn btn-danger btn-sm mx-1" title="Delete" onclick="return confirm('Are you sure you want to delete this item?')"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- External JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            // Initialize DataTable
            $('#myTable').DataTable({
                order: [[0, 'desc']], // Sort by Item ID descending
                pageLength: 10,
                responsive: true
            });

            // Initialize Select2 for dropdowns
            $('.select2').select2({
                placeholder: "Select an option",
                allowClear: true,
                width: '100%'
            });

            // Auto-submit filter form on change
            $('#filterForm select').on('change', function() {
                $('#filterForm').submit();
            });
        });
    </script>

@endsection

<style>
    .container {
        margin-top: 50px;
        padding-left: 15px;
        padding-right: 15px;
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #5c6bc0;
        color: white;
        padding: 15px 20px;
        border-radius: 10px 10px 0 0;
        font-size: 18px;
    }

    .btn {
        padding: 8px 15px;
        font-size: 14px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #218838;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #c82333;
    }

    table th, table td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: left;
        font-size: 14px;
        vertical-align: middle;
    }

    table thead {
        background-color: #5c6bc0;
        color: white;
    }

    table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .barcode-text {
        display: block;
        font-size: 12px;
        margin-top: 5px;
    }

    .action-buttons {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        gap: 5px;
    }

    .form-control, .form-select {
        border: 1px solid #ced4da;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #80bdff;
        box-shadow: 0 0 6px rgba(0, 123, 255, 0.25);
    }

    .badge {
        padding: 5px 10px;
        font-size: 12px;
    }
</style>
