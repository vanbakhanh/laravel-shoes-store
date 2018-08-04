<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
    	'content', 'product_id', 'user_id'
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
