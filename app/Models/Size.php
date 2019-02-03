<?php

namespace App\Models;

use App\Models\AbstractModel;

class Size extends AbstractModel
{
    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }
}
