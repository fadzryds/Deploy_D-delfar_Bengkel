<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('checkout_spareparts', function (Blueprint $table) {
            $table->dateTime('tanggal_pembelian')
                  ->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('checkout_spareparts', function (Blueprint $table) {
            $table->dropColumn('tanggal_pembelian');
        });
    }
};