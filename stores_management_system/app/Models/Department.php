<?php

namespace App\Models;

use App\Models\Stores;
use App\Models\Admin; // Updated from Employee to Admin
use App\Models\Location;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'department';
    protected $primaryKey = 'department_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'department_name',
        'status',
        'location_id',
        'employee_id',
        'store_id',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function admin() // Updated from employee to admin
    {
        return $this->belongsTo(Admin::class, 'employee_id'); // Still uses employee_id column
    }

    public function stores()
    {
        return $this->belongsTo(Stores::class, 'store_id');
    }
}