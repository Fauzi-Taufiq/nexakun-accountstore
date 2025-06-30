<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id',
        'transaction_id',
        'type',
        'amount',
        'balance_before',
        'balance_after',
        'description',
        'reference_id',
        'metadata'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'balance_before' => 'decimal:2',
        'balance_after' => 'decimal:2',
        'metadata' => 'array'
    ];

    // Relationships
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    // Accessors
    public function getFormattedAmountAttribute()
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    public function getFormattedBalanceBeforeAttribute()
    {
        return 'Rp ' . number_format($this->balance_before, 0, ',', '.');
    }

    public function getFormattedBalanceAfterAttribute()
    {
        return 'Rp ' . number_format($this->balance_after, 0, ',', '.');
    }

    public function getTypeTextAttribute()
    {
        $types = [
            'deposit' => 'Deposit',
            'withdrawal' => 'Penarikan',
            'escrow_hold' => 'Escrow Hold',
            'escrow_release' => 'Escrow Release',
            'escrow_refund' => 'Escrow Refund',
            'commission' => 'Komisi',
            'refund' => 'Pengembalian'
        ];

        return $types[$this->type] ?? 'Unknown';
    }

    public function getTypeBadgeAttribute()
    {
        $badges = [
            'deposit' => 'bg-green-500',
            'withdrawal' => 'bg-red-500',
            'escrow_hold' => 'bg-yellow-500',
            'escrow_release' => 'bg-blue-500',
            'escrow_refund' => 'bg-orange-500',
            'commission' => 'bg-purple-500',
            'refund' => 'bg-gray-500'
        ];

        return $badges[$this->type] ?? 'bg-gray-500';
    }

    public function getIsCreditAttribute()
    {
        return in_array($this->type, ['deposit', 'escrow_refund', 'refund']);
    }

    public function getIsDebitAttribute()
    {
        return in_array($this->type, ['withdrawal', 'escrow_hold', 'commission']);
    }

    // Scopes
    public function scopeDeposits($query)
    {
        return $query->where('type', 'deposit');
    }

    public function scopeWithdrawals($query)
    {
        return $query->where('type', 'withdrawal');
    }

    public function scopeEscrow($query)
    {
        return $query->whereIn('type', ['escrow_hold', 'escrow_release', 'escrow_refund']);
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }
} 