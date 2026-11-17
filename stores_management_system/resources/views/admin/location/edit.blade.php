@extends('layouts.admin')

@section('title','Location Page')

@section('content')

<h1 class="mt-4">Locations</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Airports</li>
        </ol>
    
    <x-slot name="title">
        Edit Locations
    </x-slot>


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

                <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Edit Locations</h4>
                        <a href="{{ url('admin/location') }}" class="btn btn-primary">Back</a>
                        
                    </div>
                    <div class="card-body">
                    <form action="{{ url('admin/location/'.$location->location_id.'/edit') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- <div class="mb-3">
                                <label>Location ID</label>
                                <input type="text" name="location_id" class="form-control" value="{{ $location->location_id }}" />
                                @error('location_id') <span class="text-danger">{{ $message }}</span>| @enderror
                            </div> -->

                            <div class="mb-3">
                                <label>Location Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $location->name }}" />
                                @error('name') <span class="text-danger">{{ $message }}</span>| @enderror
                            </div>

                            <div class="mb-3">
                                <label>Airport Code</label>
                                <input type="text" name="airport_code" class="form-control" value="{{ $location->airport_code }}" />
                                @error('airport_code') <span class="text-danger">{{ $message }}</span>| @enderror
                            </div>

                            <div class="mb-3">
                                <label>Address</label>
                                <textarea name="address" class="form-control" rows="3">{{ $location->address }}</textarea>
                                @error('address') <span class="text-danger">{{ $message }}</span>| @enderror
                            </div>

                            <div class="mb-3">
                                <label>Contact Info</label>
                                <input type="text" name="contact_info" class="form-control" value="{{ $location->contact_info }}" />
                                @error('contact_info') <span class="text-danger">{{ $message }}</span>| @enderror
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