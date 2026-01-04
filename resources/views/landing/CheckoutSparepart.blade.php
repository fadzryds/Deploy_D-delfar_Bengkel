@extends('layouts.app')

@section('title', 'Keranjang Sparepart - D\'Delfar Bengkel Motor')

@section('content')
<link rel="stylesheet" href="{{ asset('css/checkout.css') }}">

<div class="checkout-wrapper">
    <h2 class="checkout-title">Keranjang Sparepart</h2>

    <form action="{{ route('checkout.sparepart.confirm') }}" method="POST">
        @csrf

        <div id="cart-list">
        @forelse($cart as $key => $item)
            @php
                $sparepart = \App\Models\Sparepart::find($item['id']);
            @endphp

            <div class="checkout-card"
                 data-id="{{ $item['id'] }}"
                 data-price="{{ $item['price'] }}"
                 data-stock="{{ $sparepart->stock ?? 0 }}">

                <!-- HAPUS -->
                <button type="button"
                        class="btn-hapus"
                        title="Hapus dari keranjang">
                    <i class='bx bx-trash'></i>
                </button>

                <img src="{{ asset('storage/'.$item['image']) }}" class="item-img">

                <div class="item-info">
                    <h4>{{ $item['name'] }}</h4>

                    @if(($sparepart->stock ?? 0) <= 0)
                        <span class="badge-stock-habis">Stok Habis</span>
                    @endif

                    <p class="price">
                        Rp {{ number_format($item['price'],0,',','.') }}
                    </p>

                    <div class="qty-box">
                        <button type="button" class="qty-btn minus">−</button>
                        <span class="qty">{{ $item['quantity'] }}</span>
                        <button type="button" class="qty-btn plus">+</button>
                    </div>

                    <p class="item-total">
                        Rp {{ number_format($item['price'] * $item['quantity'],0,',','.') }}
                    </p>
                </div>
            </div>

        @empty
            <div class="empty-cart-box">
                <i class='bx bx-cart'></i>
                <h3>Keranjang Kosong</h3>
                <p>Silakan tambahkan sparepart terlebih dahulu</p>
                <a href="{{ route('sparepart.index') }}" class="btn-belanja">
                    Mulai Belanja
                </a>
            </div>
        @endforelse
        </div>

        <div class="checkout-action">
            <h3 id="grand-total">Total: Rp 0</h3>

            <button type="submit"
                    id="btn-checkout"
                    class="btn-checkout"
                    {{ count($cart) == 0 ? 'disabled' : '' }}>
                Checkout Sekarang
            </button>
        </div>
    </form>
</div>

<script>
    /* ===============================
       HITUNG TOTAL
    =============================== */
    function hitungTotal(){
        let total = 0;
        document.querySelectorAll('.checkout-card').forEach(card=>{
            const qty = parseInt(card.querySelector('.qty').innerText);
            const price = parseInt(card.dataset.price);
            total += qty * price;
        });
    
        document.getElementById('grand-total').innerText =
            'Total: Rp ' + total.toLocaleString('id-ID');
    
        const btnCheckout = document.getElementById('btn-checkout');
        btnCheckout.disabled = total === 0;
    }
    
    /* ===============================
       HAPUS ITEM (UNIVERSAL)
    =============================== */
    function hapusItem(card){
        const id = card.dataset.id;
    
        fetch("{{ route('cart.delete') }}",{
            method:'POST',
            headers:{
                'Content-Type':'application/json',
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
            },
            body:JSON.stringify({
                sparepart_id:id
            })
        }).then(()=>{
            card.classList.add('fade-out');
            setTimeout(()=>{
                card.remove();
                hitungTotal();
                updateCartBadge();
    
                if(document.querySelectorAll('.checkout-card').length === 0){
                    location.reload();
                }
            },300);
        });
    }
    
    /* ===============================
       INIT CART ITEM
    =============================== */
    document.querySelectorAll('.checkout-card').forEach(card=>{
        const plus  = card.querySelector('.plus');
        const minus = card.querySelector('.minus');
        const qtyEl = card.querySelector('.qty');
        const hapus = card.querySelector('.btn-hapus');
    
        const id    = card.dataset.id;
        const stock = parseInt(card.dataset.stock);
    
        function refreshButton(qty){
            plus.disabled  = qty >= stock;
            minus.disabled = qty <= 0;
        }
    
        function updateQty(qty){
            fetch("{{ route('cart.update') }}",{
                method:'POST',
                headers:{
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN':'{{ csrf_token() }}'
                },
                body:JSON.stringify({
                    sparepart_id:id,
                    quantity:qty
                })
            }).then(()=>{
                qtyEl.innerText = qty;
                refreshButton(qty);
                hitungTotal();
                updateCartBadge();
            });
        }
    
        /* PLUS */
        plus.addEventListener('click',()=>{
            let qty = parseInt(qtyEl.innerText);
            if(qty < stock){
                updateQty(qty + 1);
            }
        });
    
        /* MINUS */
        minus.addEventListener('click',()=>{
            let qty = parseInt(qtyEl.innerText);
    
            if(qty > 1){
                updateQty(qty - 1);
            }else{
                if(confirm('Jumlah 1. Hapus item dari keranjang?')){
                    hapusItem(card);
                }
            }
        });
    
        /* TRASH */
        hapus.addEventListener('click',()=>{
            if(confirm('Hapus item dari keranjang?')){
                hapusItem(card);
            }
        });
    
        refreshButton(parseInt(qtyEl.innerText));
    });
    
    hitungTotal();
    </script>    
@endsection