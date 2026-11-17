<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_code',
        'job_description',
        'division',
        'name',
        'contact',
        'status',
        'assigned_to',
        'item_id',
    ];

    public function history()
    {
        return $this->hasMany(JobHistory::class);
    }

    public function technicians()
    {
        return $this->belongsToMany(Admin::class, 'job_technician', 'job_id', 'technician_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'item_id');
    }

}
