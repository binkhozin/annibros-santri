<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'date',
        'start_time',
        'end_time',
        'location',
        'google_maps_url',
        'is_active',
    ];

    protected $casts = [
        'date' => 'date',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
