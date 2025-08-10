<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'user_id', 'is_user', 'is_staff', 'message', 'messaged_on', 'reply', 'replied_on',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
