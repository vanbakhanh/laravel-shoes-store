<?php

namespace App\Models;

use App\Models\AbstractModel;

class Category extends AbstractModel
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }
}
