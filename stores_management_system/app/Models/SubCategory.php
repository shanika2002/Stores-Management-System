<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'sub_category';

    protected $primaryKey = 'subCategory_id'; 
    
    public $incrementing = true; 
    protected $keyType = 'int';
    
    protected $fillable = [
        // 'subCategory_id',
        'name',
        'description',	
        'is_active',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    public function item()
    {
        return $this->hasMany(Item::class, 'item_id');
    }

}
