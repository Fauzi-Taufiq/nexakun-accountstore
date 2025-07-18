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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('balance', 15, 2)->default(0); // Saldo wallet
            $table->decimal('escrow_balance', 15, 2)->default(0); // Saldo dalam escrow
            $table->string('bank_name')->nullable(); // Nama bank
            $table->string('account_number')->nullable(); // Nomor rekening
            $table->string('account_holder')->nullable(); // Nama pemilik rekening
            $table->boolean('is_verified')->default(false); // Status verifikasi
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
}; 