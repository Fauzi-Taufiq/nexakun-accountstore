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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code')->unique(); // Kode transaksi unik
            $table->foreignId('game_account_id')->constrained()->onDelete('cascade');
            $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            $table->decimal('amount', 12, 2); // Jumlah pembayaran
            $table->decimal('escrow_fee', 12, 2)->default(0); // Biaya escrow
            $table->decimal('seller_receives', 12, 2); // Jumlah yang diterima penjual
            $table->enum('status', [
                'pending_payment',    // Menunggu pembayaran
                'payment_confirmed',  // Pembayaran dikonfirmasi
                'account_delivered',  // Akun sudah diserahkan ke pembeli
                'inspection_period',  // Masa pemeriksaan akun (24 jam)
                'completed',          // Transaksi selesai (pembeli puas)
                'disputed',           // Ada sengketa
                'refunded',           // Dana dikembalikan ke pembeli
                'cancelled'           // Transaksi dibatalkan
            ])->default('pending_payment');
            $table->timestamp('payment_deadline')->nullable(); // Batas waktu pembayaran
            $table->timestamp('delivery_deadline')->nullable(); // Batas waktu penyerahan akun
            $table->timestamp('inspection_deadline')->nullable(); // Batas waktu pemeriksaan
            $table->timestamp('completed_at')->nullable(); // Waktu selesai
            $table->text('buyer_notes')->nullable(); // Catatan pembeli
            $table->text('seller_notes')->nullable(); // Catatan penjual
            $table->text('dispute_reason')->nullable(); // Alasan sengketa
            $table->json('account_details')->nullable(); // Detail akun yang diserahkan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
}; 