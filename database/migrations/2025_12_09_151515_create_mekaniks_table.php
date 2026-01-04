<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mekaniks', function (Blueprint $table) {
            $table->id();

            $table->string('nama_mekanik');
            $table->string('nomor_karyawan')->unique();

            $table->string('foto')->nullable();

            $table->decimal('gaji', 12, 2)->default(0);

            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');

            $table->text('alamat')->nullable();

            $table->string('no_hp', 20)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mekaniks');
    }
};
