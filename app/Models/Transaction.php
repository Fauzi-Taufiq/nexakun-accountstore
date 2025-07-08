<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_code',
        'game_account_id',
        'buyer_id',
        'seller_id',
        'amount',
        'escrow_fee',
        'seller_receives',
        'status',
        'payment_method',
        'payment_deadline',
        'delivery_deadline',
        'inspection_deadline',
        'completed_at',
        'buyer_notes',
        'seller_notes',
        'dispute_reason',
        'account_details'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'escrow_fee' => 'decimal:2',
        'seller_receives' => 'decimal:2',
        'payment_deadline' => 'datetime',
        'delivery_deadline' => 'datetime',
        'inspection_deadline' => 'datetime',
        'completed_at' => 'datetime',
        'account_details' => 'array'
    ];

    // Relationships
    public function gameAccount(): BelongsTo
    {
        return $this->belongsTo(GameAccount::class);
    }

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function walletTransactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(TransactionMessage::class);
    }

    // Scopes
    public function scopePendingPayment($query)
    {
        return $query->where('status', 'pending_payment');
    }

    public function scopeInspectionPeriod($query)
    {
        return $query->where('status', 'inspection_period');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeDisputed($query)
    {
        return $query->where('status', 'disputed');
    }

    // Accessors
    public function getFormattedAmountAttribute()
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    public function getFormattedSellerReceivesAttribute()
    {
        return 'Rp ' . number_format($this->seller_receives, 0, ',', '.');
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending_payment' => 'bg-yellow-500',
            'payment_confirmed' => 'bg-blue-500',
            'account_delivered' => 'bg-purple-500',
            'inspection_period' => 'bg-orange-500',
            'completed' => 'bg-green-500',
            'disputed' => 'bg-red-500',
            'refunded' => 'bg-gray-500',
            'cancelled' => 'bg-gray-500'
        ];

        return $badges[$this->status] ?? 'bg-gray-500';
    }

    public function getStatusTextAttribute()
    {
        $texts = [
            'pending_payment' => 'Menunggu Pembayaran',
            'payment_confirmed' => 'Pembayaran Dikonfirmasi',
            'account_delivered' => 'Akun Diserahkan',
            'inspection_period' => 'Masa Pemeriksaan',
            'completed' => 'Selesai',
            'disputed' => 'Dispute',
            'refunded' => 'Dikembalikan',
            'cancelled' => 'Dibatalkan'
        ];

        return $texts[$this->status] ?? 'Unknown';
    }

    // Methods
    public function isInspectionPeriodExpired()
    {
        if (!$this->inspection_deadline) {
            return false;
        }
        return Carbon::now()->isAfter($this->inspection_deadline);
    }

    public function isPaymentDeadlineExpired()
    {
        if (!$this->payment_deadline) {
            return false;
        }
        return Carbon::now()->isAfter($this->payment_deadline);
    }

    public function isDeliveryDeadlineExpired()
    {
        if (!$this->delivery_deadline) {
            return false;
        }
        return Carbon::now()->isAfter($this->delivery_deadline);
    }

    public function canBeCompleted()
    {
        return $this->status === 'inspection_period' && !$this->isInspectionPeriodExpired();
    }

    public function canBeDisputed()
    {
        return in_array($this->status, ['inspection_period', 'account_delivered']);
    }

    // Boot method untuk generate transaction code
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            if (empty($transaction->transaction_code)) {
                $transaction->transaction_code = 'TXN-' . date('Ymd') . '-' . strtoupper(uniqid());
            }
        });
    }
} 