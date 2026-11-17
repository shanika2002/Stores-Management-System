<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    protected $table = 'stock_transactions';
    protected $primaryKey = 'transaction_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'transaction_type',
        'quantity',
        'transaction_date',
        'transaction_reference',
        'item_id',
        'from_store_id',
        'to_store_id',
        'employee_id',
        'manager_id',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function fromStore()
    {
        return $this->belongsTo(Stores::class, 'from_store_id');
    }

    public function toStore()
    {
        return $this->belongsTo(Stores::class, 'to_store_id');
    }

    public function admin() // Updated from employee to admin
    {
        return $this->belongsTo(Admin::class, 'employee_id'); // Still uses employee_id column
    }

    public function manager()
    {
        return $this->belongsTo(Admin::class, 'manager_id'); // Updated to use admins table
    }
}