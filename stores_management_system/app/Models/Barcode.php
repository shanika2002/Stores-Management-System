<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barcode extends Model
{
    use HasFactory;

    protected $table = 'barcodes';

    protected $fillable = ['item_id', 'barcode'];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}