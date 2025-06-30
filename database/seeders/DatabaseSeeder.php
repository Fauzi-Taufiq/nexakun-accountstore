<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Wallet;
use App\Models\GameAccount;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin Nexakun',
            'email' => 'admin@nexakun.com',
            'password' => Hash::make('password'),
            'profile_image' => 'images/default-avatar.png'
        ]);

        // Create admin wallet
        Wallet::create([
            'user_id' => $admin->id,
            'balance' => 10000000, // 10 juta saldo awal
            'escrow_balance' => 0
        ]);

        // Create test users
        $seller = User::create([
            'name' => 'Seller Test',
            'email' => 'seller@test.com',
            'password' => Hash::make('password'),
            'profile_image' => 'images/default-avatar.png'
        ]);

        $buyer = User::create([
            'name' => 'Buyer Test',
            'email' => 'buyer@test.com',
            'password' => Hash::make('password'),
            'profile_image' => 'images/default-avatar.png'
        ]);

        // Create wallets for users
        Wallet::create([
            'user_id' => $seller->id,
            'balance' => 0,
            'escrow_balance' => 0
        ]);

        Wallet::create([
            'user_id' => $buyer->id,
            'balance' => 1000000,
            'escrow_balance' => 0
        ]);

        // Create sample game accounts
        $gameAccounts = [
            [
                'user_id' => $seller->id,
                'game_name' => 'Valorant',
                'title' => 'Akun Radiant Full Skin',
                'description' => 'Akun Valorant dengan rank Radiant dan 50+ skin premium. Semua agent sudah dibuka.',
                'price' => 2500000,
                'specifications' => json_encode([
                    'rank' => 'Radiant',
                    'region' => 'Asia Pacific',
                    'skins' => 50,
                    'agents' => 'All Unlocked'
                ]),
                'status' => 'available'
            ],
            [
                'user_id' => $seller->id,
                'game_name' => 'Mobile Legends',
                'title' => 'Akun ML Mythic',
                'description' => 'Akun Mobile Legends Mythic dengan banyak skin',
                'price' => 500000,
                'specifications' => json_encode([
                    'rank' => 'Mythic',
                    'heroes' => 50,
                    'skins' => 20
                ]),
                'status' => 'available'
            ]
        ];

        foreach ($gameAccounts as $accountData) {
            $gameAccount = GameAccount::create($accountData);
            
            // Create a transaction for the Mobile Legends account
            if ($gameAccount->game_name === 'Mobile Legends') {
                $amount = $gameAccount->price;
                $escrow_fee = $amount * 0.05; // 5% fee
                $seller_receives = $amount - $escrow_fee;

                Transaction::create([
                    'game_account_id' => $gameAccount->id,
                    'buyer_id' => $buyer->id,
                    'seller_id' => $seller->id,
                    'amount' => $amount,
                    'escrow_fee' => $escrow_fee,
                    'seller_receives' => $seller_receives,
                    'status' => 'payment_confirmed',
                    'transaction_code' => 'TXN-' . date('Ymd') . '-' . strtoupper(uniqid()),
                    'payment_deadline' => now()->addDays(1),
                    'delivery_deadline' => now()->addDays(2),
                    'inspection_deadline' => now()->addDays(3)
                ]);
            }
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('Test accounts:');
        $this->command->info('Seller: seller@test.com / password');
        $this->command->info('Buyer: buyer@test.com / password');
    }
}
