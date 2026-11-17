@extends('layouts.admin')

@section('title', 'Edit Job')

@section('content')

<h1 class="mt-4">Edit Job #{{ $job->id }}</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('admin.jobs.index') }}">Jobs</a></li>
    <li class="breadcrumb-item active">Edit</li>
</ol>

<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form method="POST"
                  action="@if(auth('admin')->user()->role === 'Technician')
                              {{ route('admin.jobs.updateStatus', $job->id) }}
                          @elseif(auth('admin')->user()->role === 'Management Assistance')
                              {{ route('admin.jobs.assign', $job->id) }}
                          @else
                              {{ route('admin.jobs.update', $job->id) }}
                          @endif">

                @csrf
                @method('PUT')

                @if(in_array(auth('admin')->user()->role, ['Technician', 'Admin', 'Manager']))
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        @foreach(['pending', 'in_progress', 'on_hold', 'completed', 'returned'] as $status)
                            <option value="{{ $status }}" {{ $job->status == $status ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif

                @if(in_array(auth('admin')->user()->role, ['Management Assistance', 'Admin', 'Manager']))
<div class="mb-3">
    <label class="form-label">Assign Technician(s)</label>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Select</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach($technicians as $technician)
            <tr>
                <td>
                    <input type="checkbox" name="assigned_to[]" value="{{ $technician->id }}"
                        {{ $job->technicians->contains('id', $technician->id) ? 'checked' : '' }}>
                </td>
                <td>{{ $technician->name }}</td>
                <td>{{ $technician->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif


                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

@endsection



<style>
    .edit-job-form .form-label {
        font-weight: 600;
    }

    .edit-job-form input[type="number"],
    .edit-job-form select {
        padding: 10px;
        font-size: 15px;
    }

    .edit-job-form .btn-primary {
        padding: 8px 20px;
        font-size: 16px;
        border-radius: 5px;
    }

    .edit-job-form .btn-primary:hover {
        background-color: #0056b3;
    }

    .card {
        border-radius: 8px;
    }

    .breadcrumb {
        background: none;
        padding-left: 0;
    }
</style>
