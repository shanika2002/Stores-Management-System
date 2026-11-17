<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobHistory;
use Illuminate\Support\Facades\Auth;

class JobHistoryController extends Controller
{
    // Store job history
    public function store(Request $request, $job_id)
{
    $role = Auth::guard('admin')->user()->role;

    if ($role !== 'Technician') {
        abort(403, 'Only technicians can add job history.');
    }

    $request->validate([
        'work_done' => 'required|string',
    ]);

    $job = Job::findOrFail($job_id);

    JobHistory::create([
        'job_id' => $job->id,
        'work_done' => $request->work_done,
    ]);

    return redirect()->route('admin.jobs.show', $job->id)
                     ->with('success', 'Work history added.');
}

}
