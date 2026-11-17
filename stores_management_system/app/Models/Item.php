<?php

namespace App\Models;

use App\Models\Stores;
use App\Models\Job;
use App\Models\SubCategory;
use App\Models\StockTransaction;
use App\Models\Barcode; // Add this
use Illuminate\Database\Eloquent\Model;
use App\Models\SerialNumber; // Add this
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    protected $table = 'item';

    protected $primaryKey = 'item_id';

    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        // 'item_id',
        'name',
        'barcode',
        'serial_number',
        'make_model',
        'unit_price',
        'stock_quantity',
        'is_active',
        'threshold',
        'subCategory_id',
        'store_id'
    ];

    // If you want to define relationships, you can do it here
    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class, 'subCategory_id');
    }

    public function stores()
    {
        return $this->belongsTo(Stores::class, 'store_id');
    }

    public function stock_transactions()
    {
        return $this->belongsToMany(StockTransaction::class, 'stock_transactions', 'item_id', 'transaction_id');
    }

    public function barcodes()
    {
        return $this->hasMany(Barcode::class, 'item_id', 'item_id');
    }

    public function serialNumbers()
    {
        return $this->hasMany(SerialNumber::class, 'item_id', 'item_id');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'item_id', 'item_id');
    }

}
