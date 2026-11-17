@extends('layouts.admin')

@section('title', 'Job Details')

@section('content')

    <h1 class="mt-4">Job Details - #{{ $job->id }}</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.jobs.index') }}">Jobs</a></li>
        <li class="breadcrumb-item active">Details</li>
    </ol>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="message-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Messages --}}
    @if($errors->any())
        <div class="message-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Job Info --}}
    <div class="job-details card p-4 mb-4 shadow-sm">
        <p><strong>Asset Code:</strong> {{ $job->asset_code }}</p>
        <p><strong>Asset Name:</strong> {{ optional($job->item)->name ?? 'Unknown' }}</p>
        <p><strong>Make & Model:</strong> {{ optional($job->item)->make_model ?? 'N/A' }}</p>
        <p><strong>Description:</strong> {{ $job->job_description }}</p>
        <p><strong>Division:</strong> {{ $job->division }}</p>
        <p><strong>Requested By:</strong> {{ $job->name }} | {{ $job->contact }}</p>
        <p><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $job->status)) }}</p>
        <p><strong>Technician(s):</strong> 
            @if($job->technicians->isNotEmpty())
                {{ $job->technicians->pluck('name')->join(', ') }}
            @elseif(optional($job->technician)->name)
                {{ $job->technician->name }}
            @else
                Not Assigned
            @endif
        </p>
    </div>

    {{-- Job History --}}
    <h4>Job History</h4>
    @if($job->history->count())
        <ul class="job-history">
            @foreach($job->history as $entry)
                <li>{{ $entry->work_done }} <small>({{ $entry->created_at->format('d-m-Y') }})</small></li>
            @endforeach
        </ul>
    @else
        <p>No job history yet.</p>
    @endif

    {{-- Add New Work History --}}
    @if(auth('admin')->user()->role === 'Technician')
    <h5 class="mt-4">Add Work History</h5>
        <form action="{{ route('admin.jobs.history.store', $job->id) }}" method="POST" class="history-form mb-4">
            @csrf
            <input type="text" name="work_done" placeholder="e.g. Replaced RAM" required>
            <button type="submit">Add</button>
        </form>
    @endif


@endsection

<style>
    .job-details p {
        font-size: 16px;
        margin: 8px 0;
    }

    .message-success {
        color: green;
        background-color: #e8f5e9;
        padding: 10px;
        border-radius: 5px;
    }

    .message-error {
        color: red;
        background-color: #fdecea;
        padding: 10px;
        border-radius: 5px;
    }

    .job-history {
        list-style: disc;
        margin-left: 20px;
        margin-bottom: 20px;
        font-size: 15px;
    }

    .history-form input[type="text"] {
        width: 300px;
        padding: 8px;
        margin-right: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .history-form button {
        padding: 8px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
    }

    .history-form button:hover {
        background-color: #0056b3;
    }
</style>
