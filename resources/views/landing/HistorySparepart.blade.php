@extends('layouts.app')

@section('title', 'Riwayat Pembelian Sparepart - D\'Delfar Bengkel Motor')

@section('content')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">

<section class="history-service-section">
    <div class="history-header">
        <h2>Riwayat Pembelian Sparepart</h2>
        <a href="{{ url('/') }}" class="btn-next">← Kembali</a>
    </div>

    <div class="history-container">
        @if($checkouts->isEmpty())
            <div class="empty-state">
                <p>Belum ada riwayat pembelian sparepart</p>
            </div>
        @else
            @foreach($checkouts as $checkout)
                <div class="service-card">
                    
                    <!-- HEADER -->
                    <div class="card-header">
                        <div class="card-title">
                            <h3>Checkout Sparepart</h3>
                            <span class="booking-date">
                                {{ \Carbon\Carbon::parse($checkout->created_at)->format('d M Y') }}
                            </span>
                        </div>
                        <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $checkout->status)) }}">
                            {{ $checkout->status }}
                        </span>
                    </div>

                    <!-- BODY -->
                    <div class="card-body">

                        <!-- ROW 1 -->
                        <div class="info-row">
                            <div class="info-col">
                                <label>Nomor Pembelian</label>
                                <p class="info-value">{{ $checkout->nomor_pembelian }}</p>
                            </div>
                            <div class="info-col">
                                <label>Nama Pelanggan</label>
                                <p class="info-value">{{ $checkout->nama_pelanggan }}</p>
                            </div>
                            <div class="info-col">
                                <label>No. HP</label>
                                <p class="info-value">{{ $checkout->no_hp }}</p>
                            </div>
                        </div>

                        <!-- INFORMASI SPAREPART -->
                        <div class="info-section">
                            <h4 class="section-title">Informasi Sparepart</h4>
                            <div class="info-row">
                                <div class="info-col">
                                    <label>Nama Sparepart</label>
                                    <p class="info-value">
                                        {{ $checkout->sparepart->name ?? '-' }}
                                    </p>
                                </div>
                                <div class="info-col">
                                    <label>Harga Satuan</label>
                                    <p class="info-value">
                                        Rp {{ number_format($checkout->harga_satuan,0,',','.') }}
                                    </p>
                                </div>
                                <div class="info-col">
                                    <label>Jumlah</label>
                                    <p class="info-value">{{ $checkout->quantity }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- PEMBAYARAN -->
                        <div class="info-section">
                            <h4 class="section-title">Pembayaran</h4>
                            <div class="info-row">
                                <div class="info-col">
                                    <label>Metode</label>
                                    <p class="info-value">{{ $checkout->pembayaran }}</p>
                                </div>
                                <div class="info-col">
                                    <label>Total Harga</label>
                                    <p class="info-value">
                                        Rp {{ number_format($checkout->total_price,0,',','.') }}
                                    </p>
                                </div>
                                <div class="info-col">
                                    <label>Status</label>
                                    <p class="info-value">{{ $checkout->status }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        @endif
    </div>
</section>

<style>
/* =======================
   STYLE SAMA DENGAN HISTORY SERVICE
   ======================= */

.history-service-section {
    padding: 40px 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.history-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    flex-wrap: wrap;
    gap: 20px;
}

.history-header h2 {
    font-size: 28px;
    font-weight: 600;
    color: #333;
}

.history-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(500px, 1fr));
    gap: 24px;
}

.service-card {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.1);
    border: 2px solid #dc2626;
    transition: all 0.3s ease;
}

.service-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 24px rgba(220,38,38,0.2);
}

.card-header {
    padding: 20px;
    background: linear-gradient(135deg, #111, #dc2626);
    color: #fff;
    display: flex;
    justify-content: space-between;
}

.status-badge {
    padding: 20px 16px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 700;
    white-space: nowrap;
    letter-spacing: 0.5px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.10);
}

.status-dipesan {
    background: #fff;
    color: #dc2626;
    border: 1.5px solid #dc2626;
}

.status-konfirmasi {
    background: #fff;
    color: #111;
    border: 1.5px solid #111;
}

.status-selesai {
    background: #111;
    color: #fff;
    border: 1.5px solid #111;
}

.status-dibatalkan {
    background: #dc2626;
    color: #fff;
    border: 1.5px solid #dc2626;
}


.card-body {
    padding: 20px;
}

.info-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 20px;
}

.info-col label {
    font-size: 12px;
    color: #999;
    text-transform: uppercase;
    margin-bottom: 6px;
}

.info-value {
    font-size: 15px;
    font-weight: 500;
}

.section-title {
    font-size: 14px;
    font-weight: 600;
    color: #dc2626;
    margin-bottom: 12px;
    bord
}

@endsection