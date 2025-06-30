<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'balance',
        'escrow_balance',
        'bank_name',
        'account_number',
        'account_holder',
        'is_verified'
    ];

    protected $casts = [
        'balance' => 'decimal:2',
        'escrow_balance' => 'decimal:2',
        'is_verified' => 'boolean'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }

    // Accessors
    public function getFormattedBalanceAttribute()
    {
        return 'Rp ' . number_format($this->balance, 0, ',', '.');
    }

    public function getFormattedEscrowBalanceAttribute()
    {
        return 'Rp ' . number_format($this->escrow_balance, 0, ',', '.');
    }

    public function getTotalBalanceAttribute()
    {
        return $this->balance + $this->escrow_balance;
    }

    public function getFormattedTotalBalanceAttribute()
    {
        return 'Rp ' . number_format($this->total_balance, 0, ',', '.');
    }

    // Methods
    public function canWithdraw($amount)
    {
        return $this->balance >= $amount;
    }

    public function deposit($amount, $description = 'Deposit', $referenceId = null)
    {
        $balanceBefore = $this->balance;
        $this->balance += $amount;
        $this->save();

        // Create transaction record
        $this->transactions()->create([
            'type' => 'deposit',
            'amount' => $amount,
            'balance_before' => $balanceBefore,
            'balance_after' => $this->balance,
            'description' => $description,
            'reference_id' => $referenceId
        ]);

        return $this;
    }

    public function withdraw($amount, $description = 'Withdrawal', $referenceId = null)
    {
        if (!$this->canWithdraw($amount)) {
            throw new \Exception('Insufficient balance');
        }

        $balanceBefore = $this->balance;
        $this->balance -= $amount;
        $this->save();

        // Create transaction record
        $this->transactions()->create([
            'type' => 'withdrawal',
            'amount' => $amount,
            'balance_before' => $balanceBefore,
            'balance_after' => $this->balance,
            'description' => $description,
            'reference_id' => $referenceId
        ]);

        return $this;
    }

    public function holdEscrow($amount, $transactionId, $description = 'Escrow Hold')
    {
        if (!$this->canWithdraw($amount)) {
            throw new \Exception('Insufficient balance');
        }

        $balanceBefore = $this->balance;
        $escrowBefore = $this->escrow_balance;
        
        $this->balance -= $amount;
        $this->escrow_balance += $amount;
        $this->save();

        // Create transaction record
        $this->transactions()->create([
            'type' => 'escrow_hold',
            'amount' => $amount,
            'balance_before' => $balanceBefore,
            'balance_after' => $this->balance,
            'transaction_id' => $transactionId,
            'description' => $description
        ]);

        return $this;
    }

    public function releaseEscrow($amount, $transactionId, $description = 'Escrow Release')
    {
        if ($this->escrow_balance < $amount) {
            throw new \Exception('Insufficient escrow balance');
        }

        $escrowBefore = $this->escrow_balance;
        $this->escrow_balance -= $amount;
        $this->save();

        // Create transaction record
        $this->transactions()->create([
            'type' => 'escrow_release',
            'amount' => $amount,
            'balance_before' => $escrowBefore,
            'balance_after' => $this->escrow_balance,
            'transaction_id' => $transactionId,
            'description' => $description
        ]);

        return $this;
    }

    public function refundEscrow($amount, $transactionId, $description = 'Escrow Refund')
    {
        if ($this->escrow_balance < $amount) {
            throw new \Exception('Insufficient escrow balance');
        }

        $balanceBefore = $this->balance;
        $escrowBefore = $this->escrow_balance;
        
        $this->escrow_balance -= $amount;
        $this->balance += $amount;
        $this->save();

        // Create transaction record
        $this->transactions()->create([
            'type' => 'escrow_refund',
            'amount' => $amount,
            'balance_before' => $balanceBefore,
            'balance_after' => $this->balance,
            'transaction_id' => $transactionId,
            'description' => $description
        ]);

        return $this;
    }
} 