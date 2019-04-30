<?php

namespace App\Models;

use App\Models\AbstractModel;

class Order extends AbstractModel
{
    const PENDING = 0;
    const VERIFIED = 1;
    const SHIPPED = 2;
    const CANCELED = 3;

    const TEXT = [
        self::PENDING => 'Pending',
        self::VERIFIED => 'Verified',
        self::SHIPPED => 'Shipped',
        self::CANCELED => 'Canceled',
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
