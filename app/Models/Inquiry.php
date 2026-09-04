<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'user_id',
        'name',
        'email',
        'phone',
        'message',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
        'created_at' => 'datetime',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isNew()
    {
        return $this->status === 'new';
    }

    public function isRead()
    {
        return $this->status === 'read';
    }

    public function isReplied()
    {
        return $this->status === 'replied';
    }

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeUnread($query)
    {
        return $query->whereIn('status', ['new']);
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'new' => 'bg-warning text-dark',
            'read' => 'bg-info text-white',
            'replied' => 'bg-success text-white',
        ];

        return $badges[$this->status] ?? 'bg-secondary';
    }

    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status);
    }
}