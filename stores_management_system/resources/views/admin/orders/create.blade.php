@extends('layouts.admin')

@section('title', 'Orders Page')

@section('content')

    <h1 class="mt-4">Orders</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Stocks</li>
    </ol>

    <x-slot name="title">
        Add Orders
    </x-slot>

    <!-- Include Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Add Orders</h4>
                            <a href="{{ url('admin/orders') }}" class="btn btn-primary float-end">Back</a>
                        
                    </div>
                    <div class="card-body">
                        <form action="{{ url('admin/orders/create') }}" method="POST">
                            @csrf

                            <!-- <div class="mb-3">
                                <label>Order ID</label>
                                <input type="text" name="order_id" class="form-control" value="{{ old('order_id') }}" />
                                @error('order_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div> -->

                            <div class="mb-3">
                                <label>Order Name</label>
                                <input type="text" name="order_name" class="form-control" value="{{ old('order_name') }}" />
                                @error('order_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label>Order Date</label>
                                <input type="date" name="order_date" class="form-control" value="{{ old('order_date') }}" />
                                @error('order_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Shipped" {{ old('status') == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="Delivered" {{ old('status') == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label>Total Cost</label>
                                <input type="text" name="total_cost" class="form-control" value="{{ old('total_cost') }}" />
                                @error('total_cost') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label>Expected Delivery Date</label>
                                <input type="date" name="expected_delivery_date" class="form-control" value="{{ old('expected_delivery_date') }}" />
                                @error('expected_delivery_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="supplier_id">Supplier</label>
                                <select name="supplier_id" id="supplierDropdown" class="form-control select2" required>
                                    <option value="" disabled selected>Select Supplier</option>
                                    @foreach($supplier as $supplier)
                                        <option value="{{ $supplier->supplier_id }}" 
                                            {{ isset($orders) && $orders->order_id == $supplier->supplier_id ? 'selected' : '' }}>
                                            {{ $supplier->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="store_id">Stores</label>
                                <select name="store_id" id="storesDropdown" class="form-control select2" required>
                                    <option value="" disabled selected>Select Stores</option>
                                    @foreach($stores as $stores)
                                        <option value="{{ $stores->store_id }}" 
                                            {{ isset($orders) && $orders->order_id == $stores->store_id ? 'selected' : '' }}>
                                            {{ $stores->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery and Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#supplierDropdown, #storesDropdown').select2({
                placeholder: "Select an option",
                allowClear: true,
    });
    });

    </script>

<style>
    .select2-container .select2-selection--single {
        height: 35px !important; 
        padding: 5px; 
        font-size: 14px; 
    }

    .select2-container {
        width: 100% !important; 
    }

    .select2-container--default .select2-results__option {
        padding: 10px 15px;
        font-size: 14px;
    }

    body, h1, h4, label, .breadcrumb-item, .alert, .text-danger {
        color: black !important;
    }
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .card-header .btn-primary {
        margin-left: auto;
    }


</style>



@endsection
