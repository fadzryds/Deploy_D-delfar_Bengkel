<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
        $table->id();

        $table->foreignId('customer_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('kendaraan_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('mekanik_id')
            ->nullable()
            ->constrained('mekaniks')
            ->nullOnDelete();

        $table->date('tanggal_servis');
        $table->string('jenis_servis');
        $table->text('keluhan')->nullable();
        $table->text('catatan_mekanik')->nullable();
        $table->integer('km_servis')->nullable();

        $table->decimal('total_biaya', 12, 2)->default(0);
        $table->enum('status', ['proses','selesai'])->default('proses');

        $table->timestamps();
    });

    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};