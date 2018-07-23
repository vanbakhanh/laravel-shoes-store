<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    	'total', 'status', 'quantity', 'address', 'user_id'
    ];
    
    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }

    public function product()
    {
    	return $this->belongsToMany('App\Models\Product')->withPivot('qty', 'total', 'color', 'size')->withTimestamps();
    }
}
