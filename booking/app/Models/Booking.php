<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['user_id', 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}