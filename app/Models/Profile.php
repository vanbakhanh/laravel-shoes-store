<?php

namespace App\Models;

use App\Models\AbstractModel;

class Profile extends AbstractModel
{
    const AVATAR_DEFAULT = 'avatar-default.png';

    const MALE = 0;

    const FEMALE = 1;

    const GENDER_TEXT = [
        self::MALE => 'Male',
        self::FEMALE => 'Female',
    ];

    protected $appends = ['full_name'];

    protected $fillable = [
        'first_name',
        'last_name',
        'avatar',
        'birthday',
        'gender',
        'phone',
        'address',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setAvatarAttribute($value)
    {
        if (!$value) {
            return $this->attributes['avatar'] = self::AVATAR_DEFAULT;
        }

        return $this->attributes['avatar'] = $value;
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucwords($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucwords($value);
    }

    public function getGenderAttribute($value)
    {
        if ($value !== null) {
            return self::GENDER_TEXT[$value];
        }
    }
}
