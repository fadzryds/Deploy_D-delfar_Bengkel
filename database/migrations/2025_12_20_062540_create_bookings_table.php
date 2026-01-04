<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_booking', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');
            $table->foreignId('kendaraan_id')->nullable()->constrained('kendaraans')->onDelete('set null');
            $table->string('nama_pelanggan');
            $table->string('no_hp');
            
            // Vehicle Information
            $table->string('jenis_motor');
            $table->string('tipe_kendaraan');
            $table->string('nomor_polisi');
            $table->text('keluhan_kendaraan')->nullable();
            
            // Service Information
            $table->string('jenis_service')->nullable();  
            $table->decimal('harga_service', 12, 2)->default(0);
            $table->date('tanggal_kedatangan');
            $table->time('jam_kedatangan')->nullable();
            
            // Queue Information
            $table->string('nomor_antrian')->nullable()->unique();
            $table->foreignId('mekanik_id')->nullable()->constrained('mekaniks')->onDelete('set null');
            
            // Status: Booked, Confirmed, InProgress, Completed, Cancelled
            $table->enum('status', ['Booked', 'Konfirmasi', 'Sedang dikerjakan','Selesai', 'Dibatalkan'])->default('Booked');
            
            // Timestamps
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_booking');
    }
};
