<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    // Define fillable fields if necessary
    protected $fillable = ['id', 'content', 'read'];

    // Define the relationship to the Admin model
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
