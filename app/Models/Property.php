<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Property extends Model 
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'slug', 'description', 'price', 'purpose',
        'status',  'area',
        'address', 'city', 'state', 'zip', 'is_featured', 'is_published', 'views'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => ['source' => 'title']
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function getImageAttribute()
    {
        return $this->getFirstMediaUrl('images', 'medium');
    }

    public function getThumbAttribute()
    {
        return $this->getFirstMediaUrl('images', 'thumb');
    }

    public function getPriceFormattedAttribute()
    {
        return '$' . number_format($this->price);
    }
}