<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserJobLocation extends Model
{
    protected $fillable = [
        'user_id',
        'province_id',
        'region_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
