<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'photo',
        'social_links',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'social_links' => 'array',
        'is_active' => 'boolean',
    ];

    protected $appends = [
        'photo_url',
    ];

    public function getPhotoUrlAttribute(): ?string
    {
        if (!$this->photo) {
            return null;
        }

        return asset('storage/' . $this->photo);
    }
}