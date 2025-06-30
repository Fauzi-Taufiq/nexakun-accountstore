<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained()->onDelete('cascade');
            $table->foreignId('transaction_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('type', [
                'deposit',           // Top up wallet
                'withdrawal',        // Tarik dana
                'escrow_hold',       // Dana ditahan escrow
                'escrow_release',    // Dana escrow dilepas
                'escrow_refund',     // Dana escrow dikembalikan
                'commission',        // Komisi platform
                'refund'             // Pengembalian dana
            ]);
            $table->decimal('amount', 15, 2); // Jumlah transaksi
            $table->decimal('balance_before', 15, 2); // Saldo sebelum
            $table->decimal('balance_after', 15, 2); // Saldo setelah
            $table->text('description'); // Deskripsi transaksi
            $table->string('reference_id')->nullable(); // ID referensi eksternal
            $table->json('metadata')->nullable(); // Data tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_transactions');
    }
}; 