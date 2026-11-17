<?php

namespace App\Models;

use App\Models\Stores;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';

    protected $primaryKey = 'order_id'; 
    
    public $incrementing = true; 
    protected $keyType = 'int';
    
    protected $fillable = [
        //'order_id',
        'order_name',
        'order_date',
        'status',	
        'total_cost',
        'expected_delivery_date',
        'supplier_id',
        'store_id'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function stores()
    {
        return $this->belongsTo(Stores::class, 'store_id');
    }

}
