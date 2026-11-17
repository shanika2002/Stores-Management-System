<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SerialNumber extends Model
{
    protected $table = 'serial_numbers'; // Table name

    protected $fillable = [
        'item_id',
        'serial_number',
    ];

    // Relationship back to Item
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
