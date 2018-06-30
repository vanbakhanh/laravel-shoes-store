<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    	'total', 'status', 'quantity', 'user_id'
    ];
    
    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }

    public function products()
    {
    	return $this->belongsToMany('App\Models\Product')->withPivot('qty', 'total', 'color', 'size')->withTimestamps();
    }
}
