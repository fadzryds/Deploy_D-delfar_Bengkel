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
        Schema::create('checkout_spareparts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sparepart_id')->constrained()->cascadeOnDelete();
            $table->string('nomor_pembelian');
            $table->string('nama_pelanggan');
            $table->string('no_hp', 20);
            $table->integer('quantity');
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('total_price', 15, 2);
            $table->enum('pembayaran', ['Transfer', 'COD', 'Kartu Kredit']);
            $table->enum('status', ['Dipesan', 'Konfirmasi', 'Selesai'])->default('Dipesan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkout_spareparts');
    }
};
