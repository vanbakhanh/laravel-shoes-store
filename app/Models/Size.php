<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = [
    	'name'
    ];
    
   	public function product()
   	{
    	return $this->belongsToMany('App\Models\Product');
    }
}
