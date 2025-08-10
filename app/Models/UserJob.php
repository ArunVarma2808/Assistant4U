<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserJob extends Model
{
    protected $fillable = [
        "user_id","job_id","license", "service_charge",
    ] ;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->belongsTo(AvailableJob::class);
    }
}
