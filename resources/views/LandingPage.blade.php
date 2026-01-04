@extends('layouts.app')

@section('title', 'Sparepart - D\'Delfar Bengkel Motor')

@section('content')

    <section class="hero" id="home">
        <div class="hero-text">
            <p class="subtitle">The Best Provider</p>
            <h1>Auto Service<br>& Repair</h1>
            <p class="desc">D'Delfar Bengkel Motor menghadirkan layanan servis premium dengan sentuhan presisi dan dukungan sparepart original yang selalu tersedia. Sistem antrean modern memberikan pengalaman perawatan yang lebih tenang dan tertata.</p>
            <a href="/service" class="btn-read">Service Now !!</a>
        </div>
        <div class="hero-image">
            <img src="/images/zx25r.png" alt="Motor Sport">
        </div>
    </section>

    <section class="service-section" id="sparepart">
        <div class="service-header">
            <h2>Sparepart</h2>
            <a href="{{ route('sparepart') }}" class="btn-next">Selengkapnya!</a>
        </div>
    
        <div class="service-grid">
            @forelse($spareparts->take(4) as $sparepart)
                <div class="service-card">
                    <img src="{{ $sparepart->image ? asset('storage/' . $sparepart->image) : '/images/default-sparepart.jpeg' }}" alt="{{ $sparepart->name }}">
                    <h3>{{ $sparepart->name }}</h3>
                    <p>{{ $sparepart->description ?? 'Deskripsi tidak tersedia' }}</p>
                    <p class="price">Rp. {{ number_format($sparepart->price, 0, ',', '.') }}</p>
                    <a href="{{ route('sparepart.show', $sparepart->id) }}" class="btn-book">Beli Sparepart</a>
                </div>
            @empty
                <p>Belum ada sparepart tersedia.</p>
            @endforelse
        </div>
    </section>
    
    <section class="service-section" id="service">
        <div class="service-header">
            <h2>Service</h2>
            <a href="{{ route('service') }}" class="btn-next">Selengkapnya!</a>
        </div>
    
        <div class="service-grid">
            <div class="service-card">
                <img src="/images/zx25r.png" alt="Service 1">
                <h3>Paket Service Terminator 1</h3>
                <p class="detail">Service Ringan + Ganti Oli</p>
                <p class="price">Rp. 150.000</p>
                @if(Auth::check())
                    <a href="{{ route('bookings.create', ['service' => 'Paket Service Terminator 1', 'harga' => '150000']) }}" class="btn-book">Booking</a>
                @else
                    <button class="btn-book" onclick="openLoginModal()">Booking</button>
                @endif
            </div>

            <div class="service-card">
                <img src="/images/zx25r.png" alt="Service 2">
                <h3>Paket Service Terminator 2</h3>
                <p class="detail">Tune Up + Ganti Busi</p>
                <p class="price">Rp. 250.000</p>
                @if(Auth::check())
                    <a href="{{ route('bookings.create', ['service' => 'Paket Service Terminator 2', 'harga' => '250000']) }}" class="btn-book">Booking</a>
                @else
                    <button class="btn-book" onclick="openLoginModal()">Booking</button>
                @endif
            </div>
    
            <div class="service-card">
                <img src="/images/zx25r.png" alt="Service 3">
                <h3>Paket Service Terminator 3</h3>
                <p class="detail">Ganti Ban + Balancing</p>
                <p class="price">Rp. 450.000</p>
                @if(Auth::check())
                    <a href="{{ route('bookings.create', ['service' => 'Paket Service Terminator 3', 'harga' => '450000']) }}" class="btn-book">Booking</a>
                @else
                    <button class="btn-book" onclick="openLoginModal()">Booking</button>
                @endif
            </div>
    
            <div class="service-card">
                <img src="/images/zx25r.png" alt="Service 4">
                <h3>Paket Service Terminator 4</h3>
                <p class="detail">Ganti Kampas Rem + Cek Sistem Rem</p>
                <p class="price">Rp. 350.000</p>
                @if(Auth::check())
                    <a href="{{ route('bookings.create', ['service' => 'Paket Service Terminator 4', 'harga' => '350000']) }}" class="btn-book">Booking</a>
                @else
                    <button class="btn-book" onclick="openLoginModal()">Booking</button>
                @endif
            </div>
        </div>
    </section>  
            
    <section class="about-section" id="about">
        <div class="about-content">
            <h2>Tentang Kami</h2>
            <p>
                D’Delfar Bengkel Motor hadir sebagai solusi terpercaya untuk kebutuhan perawatan 
                dan perbaikan motor Anda. Dengan mekanik berpengalaman dan peralatan modern, 
                kami memberikan pelayanan cepat, aman, dan berkualitas.
            </p>
    
            <p>
                Kami menyediakan layanan service lengkap, sparepart original, sistem booking 
                online, serta konsultasi gratis untuk menjaga performa motor Anda tetap optimal.
            </p>
    
        </div>
    
        <div class="about-image">
            <img src="/images/bengkel1.jpeg" alt="Bengkel Motor">
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