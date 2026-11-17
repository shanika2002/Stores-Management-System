<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    
    protected $table = 'location';

    protected $primaryKey = 'location_id'; // Specify the primary key column

    public $incrementing = false;
    
    protected $fillable = [
        //'location_id',	
        'name',	
        'airport_code',	
        'address',	
        'contact_info'
    ];

    public function department()
    {
        return $this->hasMany(Department::class, 'department_id');
    }

}
