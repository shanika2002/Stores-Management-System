<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Job;
use App\Models\User;
use App\Models\Admin;
use App\Models\JobHistory;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Barcode;
use App\Models\SerialNumber;
use App\Models\Item;

class JobController extends Controller
{
    // Show all jobs
    public function index()
    {
        $jobs = Job::with('technicians', 'history')->latest()->get();
        return view('admin.jobs.index', compact('jobs'));
    }

    // Show create form
    public function create()
{
    return view('admin.jobs.create');
}


    // Store a new job
    public function store(Request $request)
{
    $request->validate([
        'asset_code' => 'required|string',
        'job_description' => 'required|string',
        'division' => 'required|string',
        'name' => 'required|string',
        'contact' => 'required|string',
    ]);

    // Find item_id using barcode or serial number
    $item = Item::whereHas('barcodes', function ($query) use ($request) {
        $query->where('barcode', $request->asset_code);
    })->orWhereHas('serialNumbers', function ($query) use ($request) {
        $query->where('serial_number', $request->asset_code);
    })->first();

    if (!$item) {
        return redirect()->back()->withErrors(['asset_code' => 'Asset code not found in system.']);
    }

    Job::create([
        'item_id' => $item->item_id, 
        'asset_code' => $request->asset_code,
        'job_description' => $request->job_description,
        'division' => $request->division,
        'name' => $request->name,
        'contact' => $request->contact,
        'status' => 'pending'
    ]);

    return redirect()->route('admin.jobs.index')->with('success', 'Job created successfully.');
}

    // Show one job
    public function show($id)
    {
        $job = Job::with('history', 'technicians')->findOrFail($id);
        return view('admin.jobs.show', compact('job'));
    }

    // Show edit form (common to all, but restrict logic inside view)
public function edit($id)
{
    $job = Job::findOrFail($id);
    $technicians = Admin::where('role', 'Technician')->get();

    return view('admin.jobs.edit', compact('job', 'technicians'));
}


// Technician only - Update job status
public function updateStatus(Request $request, $id)
{
    $user = Auth::guard('admin')->user();
    if (!in_array($user->role, ['Technician', 'Admin', 'Manager'])) {
        abort(403, 'Unauthorized to update status.');
    }

    $request->validate([
        'status' => 'required|in:pending,in_progress,on_hold,completed,returned',
    ]);

    $job = Job::findOrFail($id);
    $job->status = $request->status;
    $job->save();

    return redirect()->route('admin.jobs.index')->with('success', 'Status updated successfully.');
}

// Management Assistance only - Assign technician
public function assignTechnician(Request $request, $id)
{
    $job = Job::findOrFail($id);
    $technicianIds = $request->input('assigned_to', []);
    $job->technicians()->sync($technicianIds);

    return redirect()->route('admin.jobs.index')->with('success', 'Technicians assigned successfully.');
}


// Admin or Manager - Full update (optional fallback)
public function update(Request $request, $id)
{
    $user = Auth::guard('admin')->user();
    if (!in_array($user->role, ['Admin', 'Manager'])) {
        abort(403, 'Unauthorized to update job.');
    }

    $request->validate([
        'status' => 'required|in:pending,in_progress,on_hold,completed,returned',
        'assigned_to' => 'nullable|integer|exists:admins,id',
    ]);

    $job = Job::findOrFail($id);
    $job->update([
        'status' => $request->status,
        'assigned_to' => $request->assigned_to,
    ]);

    return redirect()->route('admin.jobs.index')->with('success', 'Job updated successfully.');
}


    // Optional: Delete job (manager only)
    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return redirect()->route('admin.jobs.index')->with('success', 'Job deleted.');
    }

    public function generatePdf($id)
    {
        $job = Job::with('technicians', 'history')->findOrFail($id);
        $pdf = Pdf::loadView('admin.jobs.job_pdf', compact('job'));
        return $pdf->download('job_card_'.$job->id.'.pdf');
    }
}
