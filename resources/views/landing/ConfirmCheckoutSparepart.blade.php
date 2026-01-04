@extends('layouts.app')

@section('title', 'Konfirmasi Checkout Sparepart - D\'Delfar Bengkel Motor')

@section('content')
<link rel="stylesheet" href="{{ asset('css/confirmcheckout.css') }}">

<div class="confirm-container">

    <h2>Konfirmasi Checkout</h2>

    <form action="{{ route('checkout.sparepart.store') }}" method="POST">
        @csrf

        <div class="box">
            <h3>Informasi Pelanggan</h3>

            <label>Nama Pelanggan</label>
            <input type="text" value="{{ auth()->user()->name }}" disabled>
            <input type="hidden" name="nama_pelanggan" value="{{ auth()->user()->name }}">

            <label>Nomor HP</label>
            <input type="text" name="no_hp" required>

            <label>Alamat</label>
            <textarea name="alamat" rows="3" required></textarea>
        </div>

        <div class="box">
            <h3>Detail Pesanan</h3>

            <table class="table-checkout">
                <thead>
                    <tr>
                        <th>Sparepart</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $item)
                    <tr>
                        <td>{{ $item['nama_sparepart'] ?? '-' }}</td>
                        <td>{{ $item['quantity'] ?? 0 }}</td>
                        <td>
                            Rp {{ number_format($item['price'] ?? 0, 0, ',', '.') }}
                        </td>
                        <td>
                            Rp {{ number_format(($item['quantity'] ?? 0) * ($item['price'] ?? 0), 0, ',', '.') }}
                        </td>
                    </tr>

                    {{-- kirim item ke controller --}}
                    <input type="hidden" name="items[]" value='@json($item)'>
                    @endforeach
                </tbody>
            </table>

            <div class="summary">
                <p>Total Item: <strong>{{ $totalQty }}</strong></p>
                <p>Total Belanja:
                    <strong>Rp {{ number_format($totalPrice,0,',','.') }}</strong>
                </p>
            </div>
        </div>

        {{-- ================= PEMBAYARAN ================= --}}
        <div class="box">
            <h3>Pembayaran</h3>

            <select name="pembayaran" required>
                <option value="">-- Pilih Metode --</option>
                <option value="Transfer">Transfer</option>
                <option value="COD">COD</option>
                <option value="Kartu Kredit">Kartu Kredit</option>
            </select>
        </div>

        <button type="submit" class="btn-confirm">
            Konfirmasi Checkout
        </button>

    </form>

</div>
@endsection