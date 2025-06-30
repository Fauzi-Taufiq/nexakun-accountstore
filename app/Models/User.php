<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image', // <-- TAMBAHKAN BARIS INI
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the game accounts for the user.
     */
    public function gameAccounts()
    {
        return $this->hasMany(GameAccount::class);
    }

    /**
     * Get the wallet for the user.
     */
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    /**
     * Get transactions where user is buyer.
     */
    public function buyerTransactions()
    {
        return $this->hasMany(Transaction::class, 'buyer_id');
    }

    /**
     * Get transactions where user is seller.
     */
    public function sellerTransactions()
    {
        return $this->hasMany(Transaction::class, 'seller_id');
    }

    /**
     * Get all transactions for the user (as buyer or seller).
     */
    public function allTransactions()
    {
        return Transaction::where('buyer_id', $this->id)
            ->orWhere('seller_id', $this->id);
    }

    /**
     * Check if user has wallet, create if not exists.
     */
    public function getOrCreateWallet()
    {
        if (!$this->wallet) {
            $this->wallet()->create([
                'balance' => 0,
                'escrow_balance' => 0
            ]);
            $this->refresh();
        }
        return $this->wallet;
    }
}