<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    protected $primaryKey = 'category_id';

    protected $fillable = [
        'name',
        'description',	
        'is_active',
    ];

    public function sub_category()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }

}
