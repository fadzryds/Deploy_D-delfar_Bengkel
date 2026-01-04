@extends('layouts.app')

@section('title', 'Sparepart - D\'Delfar Bengkel Motor')

@section('content')

<section class="service-section" id="sparepart">
    <div class="service-header">
        <h2>Sparepart</h2>
        <a href="{{ url('/') }}" class="btn-next">← Kembali</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="service-grid">
        @forelse($spareparts as $sparepart)
            <div class="service-card">
                <img src="{{ $sparepart->image ? asset('storage/' . $sparepart->image) : '/images/default-sparepart.jpeg' }}" alt="{{ $sparepart->name }}">

                <h3>{{ $sparepart->name }}</h3>

                <p>{{ $sparepart->description ?? 'Deskripsi tidak tersedia' }}</p>

                <p class="price">
                    Rp. {{ number_format($sparepart->price, 0, ',', '.') }}
                </p>

                {{-- BADGE STOK --}}
                <p class="stock {{ $sparepart->stock > 0 ? 'stock-available' : 'stock-empty' }}">
                    {{ $sparepart->stock > 0 ? 'Stok: '.$sparepart->stock : 'Stok Habis' }}
                </p>

                @if ($sparepart->stock > 0)
                    <a href="{{ route('sparepart.show', $sparepart->id) }}" class="btn-book">
                        Beli Sparepart
                    </a>
                @else
                    <button class="btn-book btn-disabled" disabled>
                        Stok Habis
                    </button>
                @endif
            </div>
        @empty
            <p>Belum ada sparepart tersedia.</p>
        @endforelse
    </div>
</section>

<footer class="footer">
    <div class="footer-container">

        <div class="footer-about">
            <h3>D'Delfar Bengkel Motor</h3>
            <p>
                Bengkel terpercaya untuk perawatan, perbaikan, dan penyediaan sparepart 
                motor dengan mekanik profesional dan pelayanan modern.
            </p>

            <div class="footer-info">
                <p><strong>Alamat:</strong> Jl. Mekar Jaya No. 24, Depok, Jawa Barat</p>
                <p><strong>Jam Operasional:</strong> 09:00 - 20:00 WIB</p>
                <p><strong>Telepon:</strong> +62 822-5884-7225</p>
            </div>

            <div class="footer-social">
                <a href="https://facebook.com" class="social-icon">
                    <img src="/icons/facebook.svg" alt="Facebook">
                </a>
                <a href="https://instagram.com" class="social-icon">
                    <img src="/icons/instagram.svg" alt="Instagram">
                </a>
                <a href="https://wa.me/6282258847225" class="social-icon">
                    <img src="/icons/whatsapp.svg" alt="WhatsApp">
                </a>
                <a href="https://x.com" class="social-icon">
                    <img src="/icons/twitter.svg" alt="Twitter">
                </a>
            </div>
            
        </div>

        <div class="footer-maps">
            <h3>Lokasi Bengkel</h3>
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2195552606027!2d106.81838727498642!3d-6.23580956104052!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1ceeccbb5a1%3A0x87d57f075444ef98!2sDepok%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1700000000000"
                width="100%" height="250" style="border:0; border-radius:12px;"
                allowfullscreen="" loading="lazy">
            </iframe>
        </div>

    </div>

    <div class="footer-bottom">
        <p>© 2025 D'Delfar Bengkel Motor. All Rights Reserved.</p>
    </div>
</footer>
@endsection
