<?php

namespace App\Models;

use App\Models\Orders;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';

    protected $primaryKey = 'supplier_id'; 
    
    protected $fillable = [
        //'supplier_id',	
        'name',	
        'contact_name',
        'email',
        'address',
        'phone',		
    ];

    public function orders()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }


}
