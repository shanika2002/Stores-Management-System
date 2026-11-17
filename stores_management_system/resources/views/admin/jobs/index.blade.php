@extends('layouts.admin')

@section('title', 'Job Management')

@section('content')

    <h1 class="mt-4">Job History</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Workshop</li>
    </ol>

    <div class="container mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Job List</h5>
                <a href="{{ route('admin.jobs.create') }}" class="btn btn-light btn-sm">+ New Job</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="jobTable" class="table table-striped table-bordered align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Asset Code</th>
                                <th>Division</th>
                                <th>Status</th>
                                <th>Technician</th>
                                <th style="width: 180px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobs as $job)
                                <tr>
                                    <td>{{ $job->id }}</td>
                                    <td>{{ $job->asset_code }}</td>
                                    <td>{{ $job->division }}</td>
                                    <td>
                                        @php
                                            $status = $job->status ?? 'not_available';
                                            $badgeClass = match($status) {
                                                'completed' => 'bg-success text-white',
                                                'pending' => 'bg-secondary text-white',
                                                'in_progress' => 'bg-info text-white',
                                                'on_hold' => 'bg-warning text-dark',
                                                'returned' => 'bg-dark text-white',
                                                default => 'bg-light text-dark',
                                            };
                                            $label = $status === 'not_available' ? 'N/A' : ucwords(str_replace('_', ' ', $status));
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            {{ $label }}
                                        </span>
                                    </td>
                                   <td>
                                        @if($job->technicians->count() > 0)
                                            {{ $job->technicians->pluck('name')->join(', ') }}
                                        @else
                                            Not Assigned
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('admin.jobs.show', $job->id) }}" class="btn btn-outline-success btn-sm mx-1">View</a>
                                        <a href="{{ route('admin.jobs.edit', $job->id) }}" class="btn btn-outline-warning btn-sm mx-1">Edit</a>
                                        <a href="{{ route('admin.jobs.pdf', $job->id) }}" class="btn btn-outline-info btn-sm mx-1">PDF</a>
                                        <form action="{{ route('admin.jobs.delete', $job->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm mx-1" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="//cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#jobTable').DataTable({
                responsive: true,
                autoWidth: false,
                pageLength: 10
            });
        });
    </script>

@endsection
