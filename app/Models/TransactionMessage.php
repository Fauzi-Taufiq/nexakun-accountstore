<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionMessage extends Model
{
    protected $fillable = [
        'transaction_id',
        'user_id',
        'message',
        'is_credential'
    ];

    protected $casts = [
        'is_credential' => 'boolean',
    ];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
} 