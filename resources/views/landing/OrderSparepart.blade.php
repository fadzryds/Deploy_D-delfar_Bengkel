@extends('layouts.app')

@section('title', 'Order Sparepart - D\'Delfar Bengkel Motor')

@section('content')

<link rel="stylesheet" href="{{ asset('css/description.css') }}">

<div class="detail-container">

    <a href="{{ route('sparepart') }}" class="btn-back">← Kembali</a>

    <div class="detail-card">

        <div class="detail-left">
            <img 
                src="{{ $sparepart->image 
                    ? asset('storage/' . $sparepart->image) 
                    : asset('images/default-sparepart.jpeg') }}" 
                class="detail-img"
                alt="{{ $sparepart->name }}"
            >
        </div>

        <div class="detail-right">
            <h2>{{ $sparepart->name }}</h2>

            <p class="price">
                Rp {{ number_format($sparepart->price, 0, ',', '.') }}
            </p>

            <p class="stock 
                {{ $sparepart->stock > 0 ? 'stock-available' : 'stock-empty' }}">
                @if ($sparepart->stock > 0)
                    Stok tersedia: {{ $sparepart->stock }}
                @else
                    Stok habis
                @endif
            </p>

            <form action="{{ route('cart.add') }}" method="POST">
                @csrf

                <input type="hidden" name="sparepart_id" value="{{ $sparepart->id }}">

                <div class="qty-box">
                    <button type="button" class="qty-btn" id="btn-minus">-</button>

                    <input 
                        class="qty-input"
                        type="number"
                        id="quantity"
                        name="quantity"
                        value="1"
                        min="1"
                        max="{{ $sparepart->stock }}"
                        readonly
                    >

                    <button type="button" class="qty-btn" id="btn-plus">+</button>
                </div>

                <button type="submit" class="cart-btn">
                    Add to Cart
                </button>
            </form>

        </div>

    </div>

    <div class="description-box">
        <h3>Deskripsi</h3>
        <p>{{ $sparepart->description ?? 'Deskripsi tidak tersedia' }}</p>
    </div>

    <h2 class="other-title">Sparepart Lainnya</h2>

    <div class="other-grid">
        @foreach($otherSpareparts as $item)
            <div class="other-card">
                <img 
                    src="{{ $item->image 
                        ? asset('storage/' . $item->image) 
                        : asset('images/default-sparepart.jpeg') }}"
                    alt="{{ $item->name }}"
                >

                <h4>{{ $item->name }}</h4>

                <p class="price-small">
                    Rp {{ number_format($item->price, 0, ',', '.') }}
                </p>

                <p class="stock-small 
                    {{ $item->stock > 0 ? 'stock-available' : 'stock-empty' }}">
                    {{ $item->stock > 0 ? 'Stok: '.$item->stock : 'Habis' }}
                </p>

                <a 
                    href="{{ route('sparepart.show', $item->id) }}" 
                    class="btn-other {{ $item->stock == 0 ? 'disabled' : '' }}"
                >Add Sparepart</a>
            </div>
        @endforeach
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const qtyInput = document.getElementById('quantity');
    const btnPlus = document.getElementById('btn-plus');
    const btnMinus = document.getElementById('btn-minus');
    const maxStock = parseInt(qtyInput.max);

    btnPlus.addEventListener('click', () => {
        let val = parseInt(qtyInput.value);
        if (val < maxStock) qtyInput.value = val + 1;
    });

    btnMinus.addEventListener('click', () => {
        let val = parseInt(qtyInput.value);
        if (val > 1) qtyInput.value = val - 1;
    });
});
</script>



@endsection