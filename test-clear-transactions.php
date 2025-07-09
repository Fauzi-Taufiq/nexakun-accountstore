<?php

use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

DB::statement('SET FOREIGN_KEY_CHECKS=0;');
DB::table('transaction_messages')->truncate();
DB::table('wallet_transactions')->truncate();
DB::table('wallets')->truncate();
DB::table('transactions')->truncate();
DB::table('game_accounts')->truncate();
DB::statement('SET FOREIGN_KEY_CHECKS=1;');

echo "Data transaksi dan game account berhasil dikosongkan.\n"; 