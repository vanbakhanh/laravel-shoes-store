<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }
}
