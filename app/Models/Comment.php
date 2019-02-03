<?php

namespace App\Models;

use App\Models\AbstractModel;

class Comment extends AbstractModel
{
    protected $fillable = [
        'content',
        'product_id',
        'user_id',
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
