@extends('layouts.app')

@section('title', 'Riwayat Service - D\'Delfar Bengkel Motor')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">

    <section class="history-service-section">
        <div class="history-header">
            <h2>Riwayat Service Booking</h2>
            <a href="{{ url('/') }}" class="btn-next">← Kembali</a>
        </div>

        <div class="history-container">
            @if($bookings->isEmpty())
                <div class="empty-state">
                    <p>Belum ada riwayat service booking</p>
                </div>
            @else
                @foreach($bookings as $booking)
                    <div class="service-card">
                        <div class="card-header">
                            <div class="card-title">
                                <h3>Service Booking</h3>
                                <span class="booking-date">
                                    {{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y') }}
                                </span>
                            </div>
                            <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $booking->status)) }}">
                                {{ $booking->status }}
                            </span>
                        </div>

                        <div class="card-body">
                            <div class="info-row">
                                <div class="info-col">
                                    <label>Nomor Antrian</label>
                                    <p class="info-value">{{ $booking->nomor_antrian ?? '-' }}</p>
                                </div>
                                <div class="info-col">
                                    <label>Nama Pelanggan</label>
                                    <p class="info-value">{{ $booking->nama_pelanggan }}</p>
                                </div>
                                <div class="info-col">
                                    <label>No. HP</label>
                                    <p class="info-value">{{ $booking->no_hp }}</p>
                                </div>
                            </div>

                            <div class="info-section">
                                <h4 class="section-title">Informasi Kendaraan</h4>
                                <div class="info-row">
                                    <div class="info-col">
                                        <label>Jenis Kendaraan</label>
                                        <p class="info-value">{{ $booking->jenis_motor }}</p>
                                    </div>
                                    <div class="info-col">
                                        <label>Tipe Kendaraan</label>
                                        <p class="info-value">{{ $booking->tipe_kendaraan }}</p>
                                    </div>
                                    <div class="info-col">
                                        <label>Nomor Polisi</label>
                                        <p class="info-value">{{ $booking->nomor_polisi }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="info-section">
                                <div class="info-row">
                                    <div class="info-col full-width">
                                        <label>Jenis Service</label>
                                        <p class="info-value">{{ $booking->jenis_service }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="info-section">
                                <h4 class="section-title">Waktu Service</h4>
                                <div class="info-row">
                                    <div class="info-col">
                                        <label>Tanggal Kedatangan</label>
                                        <p class="info-value">
                                            {{ \Carbon\Carbon::parse($booking->tanggal_kedatangan)->format('d F Y') }}
                                        </p>
                                    </div>
                                    <div class="info-col">
                                        <label>Jam Kedatangan</label>
                                        <p class="info-value">{{ $booking->jam_kedatangan }}</p>
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
            margin: 0;
        }

        .history-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(500px, 1fr));
            gap: 24px;
        }

        .service-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 12px 0 rgba(0,0,0,0.10), 0 1.5px 6px 0 rgba(220,38,38,0.08);
            overflow: hidden;
            border: 2px solid #dc2626;
            transition: box-shadow 0.3s, transform 0.3s, border-color 0.3s;
        }

        .service-card:hover {
            box-shadow: 0 6px 24px 0 rgba(220,38,38,0.18), 0 3px 12px 0 rgba(0,0,0,0.13);
            transform: translateY(-4px) scale(1.01);
            border-color: #111;
        }

        .card-header {
            padding: 20px;
            background: linear-gradient(135deg, #111 0%, #dc2626 100%);
            color: #fff;
            display: flex;
            border-radius: 10px;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid #dc2626;
        }

        .card-title h3 {
            margin: 0 0 8px 0;
            font-size: 18px;
            font-weight: 600;
        }

        .booking-date {
            font-size: 12px;
            opacity: 0.9;
        }

        .status-badge {
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            white-space: nowrap;
            letter-spacing: 0.5px;
            box-shadow: 0 1px 4px 0 rgba(0,0,0,0.10);
        }

        .status-booked {
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
            background: #fff;
        }

        .info-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .info-col {
            display: flex;
            flex-direction: column;
        }

        .info-col.full-width {
            grid-column: 1 / -1;
        }

        .info-section {
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 14px;
            font-weight: 600;
            color: #dc2626;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0 0 12px 0;
            padding-bottom: 8px;
            border-bottom: 2px solid #f0f0f0;
        }

        .info-col label {
            font-size: 12px;
            font-weight: 600;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .info-value {
            font-size: 15px;
            color: #333;
            font-weight: 500;
            margin: 0;
        }

        .card-footer {
            padding: 16px 20px;
            border-top: 1px solid #f0f0f0;
            display: flex;
            gap: 10px;
        }

        .btn-invoice {
            flex: 1;
            padding: 10px 16px;
            background-color: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            text-align: center;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-invoice:hover {
            background-color: #764ba2;
        }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state p {
            font-size: 16px;
            margin: 0;
        }

        @media (max-width: 768px) {
            .history-service-section {
                padding: 20px 15px;
            }

            .history-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .history-header h2 {
                font-size: 24px;
            }

            .history-container {
                grid-template-columns: 1fr;
            }

            .info-row {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .card-header {
                flex-direction: column;
                gap: 12px;
            }

            .status-badge {
                align-self: flex-start;
            }
        }
    </style>

@endsection