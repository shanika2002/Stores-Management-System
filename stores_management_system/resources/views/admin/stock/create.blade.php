@extends('layouts.admin')

@section('title', 'Add Stock Transaction')

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <div class="container mt-5">
        <h1 class="mb-4 text-center">Add Stock Transaction</h1>
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">New Transaction</h4>
                <a href="{{ route('admin.stock.index') }}" class="btn btn-light">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.stock.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label fw-bold">Transaction Reference</label>
                        <input type="text" name="transaction_reference" class="form-control" value="{{ old('transaction_reference', 'TXN-' . time()) }}" required />
                        @error('transaction_reference')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Items</label>
                        <div id="itemsContainer">
                            <div class="row mb-3 item-row align-items-center">
                                <div class="col-md-8">
                                    <select name="items[0][item_id]" class="form-control select2" required>
                                        <option value="" disabled selected>Select Item</option>
                                        @foreach ($items as $item)
                                            <option value="{{ $item->item_id }}">{{ $item->name }} (Stock: {{ $item->stock_quantity }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" name="items[0][quantity]" class="form-control" placeholder="Quantity" required min="1" />
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger remove-item">×</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="addItem" class="btn btn-success mt-2">Add Another Item</button>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Transaction Type</label>
                        <select name="transaction_type" id="transactionType" class="form-control" required>
                            <option value="" disabled selected>Select Type</option>
                            <option value="IN">IN</option>
                            <option value="OUT">OUT</option>
                            <option value="TRANSFER">TRANSFER</option>
                        </select>
                    </div>

                    <div class="mb-4" id="fromStoreField" style="display: none;">
                        <label class="form-label fw-bold">From Store</label>
                        <select name="from_store_id" class="form-control select2">
                            <option value="" disabled selected>Select Store</option>
                            @foreach ($stores as $store)
                                <option value="{{ $store->store_id }}">{{ $store->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">To Store</label>
                        <select name="to_store_id" class="form-control select2" required>
                            <option value="" disabled selected>Select Store</option>
                            @foreach ($stores as $store)
                                <option value="{{ $store->store_id }}">{{ $store->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Transaction Date</label>
                        <input type="date" name="transaction_date" class="form-control" value="{{ old('transaction_date') }}" required />
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Employee</label>
                        <select name="employee_id" class="form-control select2" required>
                            <option value="" disabled selected>Select Employee</option>
                            @foreach ($admins as $admin) <!-- Updated from $employees to $admins -->
                                <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Manager</label>
                        <select name="manager_id" class="form-control select2">
                            <option value="" disabled selected>Select Manager (Optional)</option>
                            @foreach ($managers as $man)
                                <option value="{{ $man->id }}">{{ $man->name }}</option> <!-- Updated to use id and name -->
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Save Transaction</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
            let itemIndex = 1;

            $('#addItem').click(function () {
                const newRow = `
                    <div class="row mb-3 item-row align-items-center">
                        <div class="col-md-8">
                            <select name="items[${itemIndex}][item_id]" class="form-control select2" required>
                                <option value="" disabled selected>Select Item</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->item_id }}">{{ $item->name }} (Stock: {{ $item->stock_quantity }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="items[${itemIndex}][quantity]" class="form-control" placeholder="Quantity" required min="1" />
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger remove-item">×</button>
                        </div>
                    </div>
                `;
                $('#itemsContainer').append(newRow);
                $('.select2').select2();
                itemIndex++;
            });

            $(document).on('click', '.remove-item', function () {
                if ($('.item-row').length > 1) {
                    $(this).closest('.item-row').remove();
                }
            });

            $('#transactionType').change(function () {
                if ($(this).val() === 'TRANSFER') {
                    $('#fromStoreField').show();
                    $('select[name="from_store_id"]').prop('required', true);
                } else {
                    $('#fromStoreField').hide();
                    $('select[name="from_store_id"]').prop('required', false);
                }
            });
        });
    </script>

    <style>
        body {
            background-color: #f4f7fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 900px;
        }
        .card {
            border-radius: 15px;
            overflow: hidden;
        }
        .card-header {
            padding: 15px 20px;
        }
        .form-label {
            color: #333;
        }
        .form-control, .btn {
            border-radius: 8px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
        .select2-container .select2-selection--single {
            height: 38px;
            padding: 5px;
        }
        .select2-container {
            width: 100% !important;
        }
    </style>
@endsection