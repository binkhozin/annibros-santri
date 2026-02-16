<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Portfolio extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'description',
        'thumbnail',
        'accent_color',
        'url',
        'technologies',
        'client_name',
        'year',
        'sort_order',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'technologies' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);

        $this->addMediaConversion('optimized')
            ->width(800)
            ->height(600)
            ->sharpen(10);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}
