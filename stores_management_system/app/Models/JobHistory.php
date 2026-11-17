<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'work_done'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
