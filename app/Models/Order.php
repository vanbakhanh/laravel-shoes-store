<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const PENDING = 0;
    const VERIFIED = 1;
    const SHIPPED = 2;
    const CANCELED = 3;

    const TEXT = [
        self::PENDING => 'pending',
        self::VERIFIED => 'verified',
        self::SHIPPED => 'shipped',
        self::CANCELED => 'canceled',
    ];

    const STATUS = [
        'pending' => self::PENDING,
        'verified' => self::VERIFIED,
        'shipped' => self::SHIPPED,
        'canceled' => self::CANCELED,
    ];

    protected $fillable = [
        'total',
        'status',
        'quantity',
        'address',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('qty', 'total', 'color', 'size')->withTimestamps();
    }

    public function getStatusAttribute($value)
    {
        return self::TEXT[$value];
    }
}
