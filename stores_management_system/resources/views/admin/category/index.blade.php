@extends('layouts.admin')

@section('title', 'Category Page')

@section('content')

    <h1 class="mt-4">Main Categories</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Categories</li>
    </ol>

    <x-slot name="title">
        Main Categories
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Main Categories</h4>
                        <a href="{{ url('admin/category/create') }}" class="btn btn-primary float-end">Add Category</a>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Category ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Is Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $item)
                                <tr>
                                    <td>{{ $item->category_id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        @if($item->is_active)
                                            Active
                                        @else
                                            In-Active
                                        @endif
                                    </td>
                                    <td class="action-buttons">
                                        <a href="{{ url('admin/category/'.$item->category_id.'/edit') }}" class="btn btn-success mx-2">Edit</a>
                                        <a
                                            href="{{ url('admin/category/'.$item->category_id.'/delete') }}"
                                            class="btn btn-danger mx-1"
                                            onclick="return confirm('Are you sure?')"
                                            >
                                            Delete
                                        </a>
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>

@endsection

<style>
    /* Container adjustments */
    .container {
        margin-top: 50px;
        padding-left: 15px;
        padding-right: 15px;
    }

    /* Card Styling */
    .card {
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    /* Header Styling */
    .card-header {
        background-color: #151B54;
        color: black;
        padding: 20px;
        border-radius: 10px 10px 0 0;
        font-size: 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Button Styling */
    .btn {
        padding: 8px 15px;
        font-size: 14px;
        text-align: center;
        text-decoration: none;
        border-radius: 5px;
        margin: 5px;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-success {
        background-color: #28a745;
        color: white;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    /* Table Styling */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th, table td {
        padding: 10px 12px;
        border: 1px solid #ddd;
        text-align: left;
        font-size: 14px;
    }

    table thead {
        background-color: #0041C2;
        color: white;
        font-weight: bold;
    }

    /* Hover effect on table rows */
    table tbody tr {
        transition: background-color 0.3s ease;
    }

    table tbody tr:hover {
        background-color: #f1f1f1;
    }

    /* Additional styling for action buttons */
    table tbody td .btn {
        padding: 6px 12px;
    }

    /* Margin adjustments for action buttons */
    .mx-2 {
        margin-left: 10px;
        margin-right: 10px;
    }

    .mx-1 {
        margin-left: 5px;
        margin-right: 5px;
    }

    /* Float-end class for right alignment */
    .float-end {
        margin-left: auto;
    }

    /* Flexbox for action buttons */
    .action-buttons {
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }
</style>
