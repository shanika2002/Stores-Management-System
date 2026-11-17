@extends('layouts.admin')

@section('title','Supplier Page')

@section('content')

<h1 class="mt-4">Suppliers</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Users</li>
        </ol>
    
    <x-slot name="title">
        Edit Suppliers
    </x-slot>


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

                <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Edit Suppliers </h4>
                        <a href="{{ url('admin/supplier') }}" class="btn btn-primary float-end">Back</a>
                       
                    </div>
                    <div class="card-body">
                    <form action="{{ url('admin/supplier/'.$supplier->supplier_id.'/edit') }}" method="POST">

                            @csrf
                            @method('PUT')

                            <!-- <div class="mb-3">
                                <label>Supplier ID</label>
                                <input type="text" name="supplier_id" class="form-control" value="{{ $supplier->supplier_id }}" />
                                @error('supplier_id') <span class="text-danger">{{ $message }}</span>| @enderror
                            </div> -->

                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $supplier->name }}" />
                                @error('name') <span class="text-danger">{{ $message }}</span>| @enderror
                            </div>

                            <div class="mb-3">
                                <label>Contact Name</label>
                                <input type="text" name="contact_name" class="form-control" value="{{ $supplier->contact_name }}" />
                                @error('contact_name') <span class="text-danger">{{ $message }}</span>| @enderror
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" value="{{ $supplier->email }}" />
                                @error('email') <span class="text-danger">{{ $message }}</span>| @enderror
                            </div>

                            <div class="mb-3">
                                <label>Address</label>
                                <textarea name="address" class="form-control" rows="3">{{ $supplier->address }}</textarea>
                                @error('address') <span class="text-danger">{{ $message }}</span>| @enderror
                            </div>

                            <div class="mb-3">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{ $supplier->phone }}" />
                                @error('phone') <span class="text-danger">{{ $message }}</span>| @enderror
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
    

    <style>
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