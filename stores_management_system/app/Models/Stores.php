<?php

namespace App\Models;

use App\Models\Orders;
use App\Models\Admin; // Updated from Employee to Admin
use App\Models\Location;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    protected $table = 'stores';
    protected $primaryKey = 'store_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'name',
        'code',
        'status',
        'location_id',
        'employee_id'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function admin() // Updated from employee to admin
    {
        return $this->belongsTo(Admin::class, 'employee_id'); // Still uses employee_id column
    }

    public function department()
    {
        return $this->hasMany(Department::class, 'store_id'); // Adjusted foreign key to store_id
    }

    public function item()
    {
        return $this->hasMany(Item::class, 'store_id'); // Assuming items are linked by store_id
    }

    public function orders()
    {
        return $this->hasMany(Orders::class, 'store_id'); // Adjusted to hasMany if applicable
    }

    public function stock_transactions()
    {
        return $this->hasMany(StockTransaction::class, 'to_store_id'); // Adjusted to hasMany
    }
}