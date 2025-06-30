<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'game_name',
        'account_title',
        'description',
        'price',
        'images',
        'status', // available, sold, pending
        'account_level',
        'server_region',
        'additional_info'
    ];

    protected $casts = [
        'images' => 'array',
        'price' => 'decimal:2',
        'additional_info' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'available' => 'bg-green-500',
            'sold' => 'bg-red-500',
            'pending' => 'bg-yellow-500'
        ];

        return $badges[$this->status] ?? 'bg-gray-500';
    }
} 