@extends('layouts.admin')

@section('title', 'Edit Sub Category Page')

@section('content')

    <h1 class="mt-4">Sub Categories</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Category</li>
    </ol>

    <x-slot name="title">
        Edit Sub Categories
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
                <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Edit Sub Categories</h4>
                            <a href="{{ url('admin/sub_category') }}" class="btn btn-primary float-end">Back</a>
                        
                    </div>
                    <div class="card-body">
                        <form action="{{ url('admin/sub_category/'.$sub_category->subCategory_id.'/edit') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- <div class="mb-3">
                                <label>SubCategory ID</label>
                                <input type="text" name="subCategory_id" class="form-control" value="{{ $sub_category->subCategory_id }}" />
                                @error('subCategory_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div> -->

                            <div class="mb-3">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $sub_category->name }}" />
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label>Description</label>
                                <textarea name="description" class="form-control" rows="3">{{ $sub_category->description }}</textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="categoryDropdown" class="form-control select2" required>
                                    <option value="" disabled>Select Category</option>
                                    @foreach($category as $cat)
                                        <option value="{{ $cat->category_id }}" 
                                            {{ $sub_category->category_id == $cat->category_id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Is Active</label>
                                <input type="checkbox" name="is_active" {{ $sub_category->is_active ? 'checked' : '' }} />
                                @error('is_active') <span class="text-danger">{{ $message }}</span> @enderror
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

    <!-- Include jQuery and Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#categoryDropdown').select2({
                placeholder: "Select Category",
                allowClear: true
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
