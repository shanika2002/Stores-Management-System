<!DOCTYPE html>
<html>
<head>
    <title>Job Card</title>
</head>
<body>
    <div class="header">
        <h1>Job Card</h1>
        <p>ID: <strong>#{{ $job->id }}</strong></p>
    </div>

    <div class="info-box">
        <p><span class="label">Asset Code:</span> {{ $job->asset_code }}</p>
        <p><span class="label">Description:</span> {{ $job->job_description }}</p>
        <p><span class="label">Division:</span> {{ $job->division }}</p>
        <p><span class="label">Status:</span> {{ ucfirst(str_replace('_', ' ', $job->status)) }}</p>
        <p><span class="label">Technician:</span>
            @if($job->technicians->count())
                {{ $job->technicians->pluck('name')->join(', ') }}
            @else
                Not Assigned
            @endif
        </p>
    </div>

    <div class="history-section">
        <h2>Job History</h2>
        @if($job->history->count())
            <table class="history-table">
                <thead>
                    <tr>
                        <th>Work Done</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($job->history as $entry)
                        <tr>
                            <td>{{ $entry->work_done }}</td>
                            <td>{{ $entry->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No job history available.</p>
        @endif
    </div>
</body>

<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 14px;
        color: #333;
        margin: 40px;
    }

    .header {
        text-align: center;
        margin-bottom: 30px;
    }

    .header h1 {
        font-size: 26px;
        color: #2c3e50;
        margin: 0;
    }

    .info-box {
        border: 1px solid #ccc;
        padding: 15px;
        border-radius: 8px;
        background-color: #f9f9f9;
        margin-bottom: 25px;
    }

    .info-box p {
        margin: 8px 0;
    }

    .info-box .label {
        font-weight: bold;
        width: 140px;
        display: inline-block;
        color: #555;
    }

    .history-section h2 {
        font-size: 18px;
        margin-bottom: 10px;
        color: #2c3e50;
        border-bottom: 1px solid #ccc;
        padding-bottom: 5px;
    }

    .history-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    .history-table th,
    .history-table td {
        border: 1px solid #aaa;
        padding: 10px;
        font-size: 13px;
    }

    .history-table th {
        background-color: #e8f0fe;
        font-weight: 600;
        text-align: left;
    }

    .history-table tr:nth-child(even) {
        background-color: #f6f6f6;
    }
</style>
</html>
