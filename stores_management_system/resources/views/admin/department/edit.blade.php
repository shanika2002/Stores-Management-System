@extends('layouts.admin')

@section('title', 'Edit Department Page')

@section('content')
    <h1 class="mt-4">Departments</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Airports</li>
    </ol>

    <x-slot name="title">
        Edit Departments
    </x-slot>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                @if(session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Edit Departments</h4>
                        <a href="{{ url('admin/department') }}" class="btn btn-primary float-end">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('admin/department/'.$department->department_id.'/edit') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label>Department Name</label>
                                <input type="text" name="department_name" class="form-control" value="{{ $department->department_name }}" />
                                @error('department_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label>Status</label>
                                <input type="checkbox" name="status" {{ $department->status ? 'checked' : '' }} />
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="location_id">Location</label>
                                <select name="location_id" id="locationDropdown" class="form-control select2" required>
                                    <option value="" disabled>Select Location</option>
                                    @foreach($location as $loc)
                                        <option value="{{ $loc->location_id }}"
                                            {{ $department->location_id == $loc->location_id ? 'selected' : '' }}>
                                            {{ $loc->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('location_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="store_id">Store</label>
                                <select name="store_id" id="storeDropdown" class="form-control select2" required>
                                    <option value="" disabled>Select Store</option>
                                    @foreach($stores as $sto)
                                        <option value="{{ $sto->store_id }}"
                                            {{ $department->store_id == $sto->store_id ? 'selected' : '' }}>
                                            {{ $sto->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('store_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="employee_id">Manager</label>
                                <select name="employee_id" id="employeeDropdown" class="form-control select2" required>
                                    <option value="" disabled>Select Manager</option>
                                    @foreach($admins as $admin) <!-- Updated from $employee to $admins -->
                                        <option value="{{ $admin->id }}"
                                            {{ $department->employee_id == $admin->id ? 'selected' : '' }}>
                                            {{ $admin->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('employee_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#locationDropdown, #employeeDropdown, #storeDropdown').select2({
                placeholder: "Select an option",
                allowClear: true,
            });
        });
    </script>

    <style>
        .select2-container .select2-selection--single {
            height: 38px !important;
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