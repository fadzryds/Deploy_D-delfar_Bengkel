@extends('layouts.app')

@section('title', 'Service - D\'Delfar Bengkel Motor')

@section('content')

<link rel="stylesheet" href="{{ asset('css/service.css') }}">

    <section class="service-section" id="service">
        <div class="service-header">
            <h2>Service</h2>
            <a href="{{ url('/') }}" class="btn-next">← Kembali</a>
        </div>
    
        <div class="service-grid">
            <!-- Service 1 -->
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
    
            <!-- Service 2 -->
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
    
            <!-- Service 3 -->
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
    
            <!-- Service 4 -->
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

            <!-- Service 5 -->
            <div class="service-card">
                <img src="/images/zx25r.png" alt="Service 5">
                <h3>Paket Service Terminator 5</h3>
                <p class="detail">Service Berkala + Ganti Filter Udara</p>
                <p class="price">Rp. 300.000</p>
                @if(Auth::check())
                    <a href="{{ route('bookings.create', ['service' => 'Paket Service Terminator 5', 'harga' => '300000']) }}" class="btn-book">Booking</a>
                @else
                    <button class="btn-book" onclick="openLoginModal()">Booking</button>
                @endif
            </div>
    
            <!-- Service 6 -->
            <div class="service-card">
                <img src="/images/zx25r.png" alt="Service 6">
                <h3>Paket Service Terminator 6</h3>
                <p class="detail">Ganti Rantai + Gear Set</p>
                <p class="price">Rp. 750.000</p>
                @if(Auth::check())
                    <a href="{{ route('bookings.create', ['service' => 'Paket Service Terminator 6', 'harga' => '750000']) }}" class="btn-book">Booking</a>
                @else
                    <button class="btn-book" onclick="openLoginModal()">Booking</button>
                @endif
            </div>
    
            <!-- Service 7 -->
            <div class="service-card">
                <img src="/images/zx25r.png" alt="Service 7">
                <h3>Paket Service Terminator 7</h3>
                <p class="detail">Overhaul Mesin + Ganti Piston</p>
                <p class="price">Rp. 2.500.000</p>
                @if(Auth::check())
                    <a href="{{ route('bookings.create', ['service' => 'Paket Service Terminator 7', 'harga' => '2500000']) }}" class="btn-book">Booking</a>
                @else
                    <button class="btn-book" onclick="openLoginModal()">Booking</button>
                @endif
            </div>
    
            <!-- Service 8 -->
            <div class="service-card">
                <img src="/images/zx25r.png" alt="Service 8">
                <h3>Paket Service Terminator 8</h3>
                <p class="detail">Ganti Shockbreaker Depan & Belakang</p>
                <p class="price">Rp. 1.800.000</p>
                @if(Auth::check())
                    <a href="{{ route('bookings.create', ['service' => 'Paket Service Terminator 8', 'harga' => '1800000']) }}" class="btn-book">Booking</a>
                @else
                    <button class="btn-book" onclick="openLoginModal()">Booking</button>
                @endif
            </div>

            <!-- Service 9 -->
            <div class="service-card">
                <img src="/images/zx25r.png" alt="Service 9">
                <h3>Paket Service Terminator 9</h3>
                <p class="detail">Service CVT + Ganti V-Belt</p>
                <p class="price">Rp. 550.000</p>
                @if(Auth::check())
                    <a href="{{ route('bookings.create', ['service' => 'Paket Service Terminator 9', 'harga' => '550000']) }}" class="btn-book">Booking</a>
                @else
                    <button class="btn-book" onclick="openLoginModal()">Booking</button>
                @endif
            </div>
    
            <!-- Service 10 -->
            <div class="service-card">
                <img src="/images/zx25r.png" alt="Service 10">
                <h3>Paket Service Terminator 10</h3>
                <p class="detail">Ganti Velg Racing + Jari-jari</p>
                <p class="price">Rp. 3.500.000</p>
                @if(Auth::check())
                    <a href="{{ route('bookings.create', ['service' => 'Paket Service Terminator 10', 'harga' => '3500000']) }}" class="btn-book">Booking</a>
                @else
                    <button class="btn-book" onclick="openLoginModal()">Booking</button>
                @endif
            </div>
    
            <!-- Service 11 -->
            <div class="service-card">
                <img src="/images/zx25r.png" alt="Service 11">
                <h3>Paket Service Terminator 11</h3>
                <p class="detail">Ganti Aki + Cek Sistem Kelistrikan</p>
                <p class="price">Rp. 650.000</p>
                @if(Auth::check())
                    <a href="{{ route('bookings.create', ['service' => 'Paket Service Terminator 11', 'harga' => '650000']) }}" class="btn-book">Booking</a>
                @else
                    <button class="btn-book" onclick="openLoginModal()">Booking</button>
                @endif
            </div>
    
            <!-- Service 12 -->
            <div class="service-card">
                <img src="/images/zx25r.png" alt="Service 12">
                <h3>Paket Service Terminator 12</h3>
                <p class="detail">Ganti Seal Shock + Fork Oil</p>
                <p class="price">Rp. 1.200.000</p>
                @if(Auth::check())
                    <a href="{{ route('bookings.create', ['service' => 'Paket Service Terminator 12', 'harga' => '1200000']) }}" class="btn-book">Booking</a>
                @else
                    <button class="btn-book" onclick="openLoginModal()">Booking</button>
                @endif
            </div>
    
            <!-- Service 13 -->
            <div class="service-card">
                <img src="/images/zx25r.png" alt="Service 13">
                <h3>Paket Service Terminator 13</h3>
                <p class="detail">Cat Ulang Body + Polish</p>
                <p class="price">Rp. 4.500.000</p>
                @if(Auth::check())
                    <a href="{{ route('bookings.create', ['service' => 'Paket Service Terminator 13', 'harga' => '4500000']) }}" class="btn-book">Booking</a>
                @else
                    <button class="btn-book" onclick="openLoginModal()">Booking</button>
                @endif
            </div>

            <!-- Service 14 -->
            <div class="service-card">
                <img src="/images/zx25r.png" alt="Service 14">
                <h3>Paket Service Terminator 14</h3>
                <p class="detail">Upgrade Karburator + Jetting</p>
                <p class="price">Rp. 1.500.000</p>
                @if(Auth::check())
                    <a href="{{ route('bookings.create', ['service' => 'Paket Service Terminator 14', 'harga' => '1500000']) }}" class="btn-book">Booking</a>
                @else
                    <button class="btn-book" onclick="openLoginModal()">Booking</button>
                @endif
            </div>

            <!-- Service 15 -->
            <div class="service-card">
                <img src="/images/zx25r.png" alt="Service 15">
                <h3>Paket Service Terminator 15</h3>
                <p class="detail">Service Premium + Full Detailing</p>
                <p class="price">Rp. 5.000.000</p>
                @if(Auth::check())
                    <a href="{{ route('bookings.create', ['service' => 'Paket Service Terminator 15', 'harga' => '5000000']) }}" class="btn-book">Booking</a>
                @else
                    <button class="btn-book" onclick="openLoginModal()">Booking</button>
                @endif
            </div>
        </div>
    </section>

    <!-- Modal Login/Register -->
    <div id="authModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeLoginModal()">&times;</span>
            <div class="modal-header">
                <h2>Masuk untuk Melanjutkan</h2>
                <p>Anda harus login atau membuat akun terlebih dahulu untuk melakukan booking service!</p>
            </div>
            <div class="modal-body">
                <div class="auth-tabs">
                    <button class="tab-button active" onclick="switchTab('login-tab')">Login</button>
                    <button class="tab-button" onclick="switchTab('register-tab')">Register</button>
                </div>

                <!-- Login Tab -->
                <div id="login-tab" class="tab-content active">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required placeholder="Masukkan email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" required placeholder="Masukkan password">
                        </div>
                        <button type="submit" class="btn-auth">Masuk</button>
                    </form>
                </div>

                <!-- Register Tab -->
                <div id="register-tab" class="tab-content">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="reg_name">Nama Lengkap</label>
                            <input type="text" id="reg_name" name="name" required placeholder="Masukkan nama lengkap">
                        </div>
                        <div class="form-group">
                            <label for="reg_email">Email</label>
                            <input type="email" id="reg_email" name="email" required placeholder="Masukkan email">
                        </div>
                        <div class="form-group">
                            <label for="reg_password">Password</label>
                            <input type="password" id="reg_password" name="password" required placeholder="Masukkan password">
                        </div>
                        <div class="form-group">
                            <label for="reg_password_confirm">Konfirmasi Password</label>
                            <input type="password" id="reg_password_confirm" name="password_confirmation" required placeholder="Ulangi password">
                        </div>
                        <button type="submit" class="btn-auth">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
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

<script>
function openLoginModal() {
    document.getElementById("authModal").style.display = "block";
}

function closeLoginModal() {
    document.getElementById("authModal").style.display = "none";
}

function switchTab(tabName) {
    // Hide all tabs
    var tabs = document.getElementsByClassName("tab-content");
    for (var i = 0; i < tabs.length; i++) {
        tabs[i].classList.remove("active");
    }
    
    // Remove active class from all buttons
    var buttons = document.getElementsByClassName("tab-button");
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove("active");
    }
    
    // Show selected tab
    document.getElementById(tabName).classList.add("active");
    
    // Add active class to clicked button
    event.target.classList.add("active");
}

// Close modal when clicking outside of it
window.onclick = function(event) {
    var modal = document.getElementById("authModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

@endsection