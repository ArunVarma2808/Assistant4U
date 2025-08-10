<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            do {
                $code = strtoupper(Str::random(6));
            } while (Booking::where('booking_code', $code)->exists());
             $model->booking_code = $code;
        });
    }


    protected $fillable = [
        'booking_code',
        'customer_id',
        'staff_id',
        'booking_date',
        'booking_time',
        'address',
        'message',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}
