@extends('layouts.admin')

@section('title','Add Category Page')

@section('content')

    <h1 class="mt-4">Categories</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    
    <x-slot name="title">
        Add Categories
    </x-slot>


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

                <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Add Categories</h4>
                        <a href="{{ url('admin/category') }}" class="btn btn-primary float-end">Back</a>
                        
                    </div>
                    <div class="card-body">
                        <form action="{{ url('admin/category/create') }}" method="POST">
                            @csrf

                            <!-- <div class="mb-3">
                                <label>Category ID</label>
                                <input type="text" name="category_id" class="form-control" value="{{ old('category_id') }}" />
                                @error('category_id') <span class="text-danger">{{ $message }}</span>| @enderror
                            </div> -->

                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
                                @error('name') <span class="text-danger">{{ $message }}</span>| @enderror
                            </div>

                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span>| @enderror
                            </div>

                            <div class="mb-3">
                                <label>Is Active</label>
                                <input type="checkbox" name="is_active" {{ old('is_active') == true ? checked:'' }} />
                                @error('is_active') <span class="text-danger">{{ $message }}</span>| @enderror
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