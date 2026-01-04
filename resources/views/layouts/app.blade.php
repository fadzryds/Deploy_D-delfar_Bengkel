<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <title>D'Delfar Bengkel Motor</title>
    
        <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
        <link href='https://cdn.boxicons.com/3.0.6/fonts/basic/boxicons.min.css' rel='stylesheet'>
    </head>
    
<body>
    <nav class="navbar">
        <div class="logo">D'Delfar</div>
        
        <div class="hamburger" id="hamburgerBtn">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <div class="nav-menu">
            <a href="/">Home</a>
            <a href="/sparepart">Sparepart</a>
            <a href="/service">Service</a>
            <a href="/about">About</a>
        </div>


        @auth
        <div class="profile-wrapper">

            <div>
                <a class="keranjang" href="{{ route('checkout.sparepart') }}">
                    <i class='bx bx-cart'></i>
                    <span id="cart-badge">{{ count(session('cart', [])) }}</span>
                </a>                
            </div>

            <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                class="nav-avatar"
                id="avatarToggle">

            <div class="dropdown-profile" id="dropdownProfile">
                <div class="profile-header">
                    <img src="{{ asset('storage/' . auth()->user()->foto) }}" class="profile-photo">
                    <div>
                        <strong>{{ auth()->user()->nama }}</strong><br>
                        <small>{{ auth()->user()->email }}</small>
                    </div>
                </div>
    
                <div class="dropdown-divider"></div>
    
                <a href="/profile" class="btn-edit">👤 Profile</a>
                <div class="dropdown-riwayat">
                    <a href="#" class="btn-edit dropdown-riwayat-toggle">Riwayat</a>
                    <div class="dropdown-riwayat-menu">
                        <a href="{{ route('historysparepart') }}">Riwayat Sparepart</a>
                        <a href="{{ route('historyservice') }}">Riwayat Service</a>
                    </div>
                </div>


                @if(auth()->user()->role !== 'user')
                    <a href="{{ route('filament.admin.pages.dashboard') }}" class="btn-admin">Admin Panel</a>
                @endif
    
                <div class="dropdown-divider"></div>
    
                <!-- Dark / Light Mode Switch -->
                <div class="theme-switch">
                    <span>Dark Mode</span>
                    <label class="switch">
                        <input type="checkbox" id="themeToggle">
                        <span class="slider round"></span>
                    </label>
                </div>
    
                <form action="/logout" method="POST">
                    @csrf
                    <button class="btn-logout">Logout</button>
                </form>
            </div>
        </div>
        @endauth
    
        @guest
            <div class="auth-buttons">
                <a href="/register" class="btn-register">Register</a>
                <a href="/login" class="btn-login">Login</a>
            </div>
        @endguest
    </nav>
    
    <!-- Mobile Dropdown Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="/">Home</a>
        <a href="/sparepart">Sparepart</a>
        <a href="/service">Service</a>
        <a href="/about">About</a>
    
        {{-- IF USER NOT LOGGED IN --}}
        @guest
            <div class="mobile-auth-buttons">
                <a href="/login" class="mobile-btn-login">Login</a>
                <a href="/register" class="mobile-btn-register">Register</a>
            </div>
        @endguest
    
        <div>
            <a class="keranjang" href="{{ route('checkout.sparepart') }}">
                <i class='bx bx-cart'></i>
                <span id="cart-badge">{{ count(session('cart', [])) }}</span>
            </a>                
        </div>

        {{-- IF USER LOGGED IN --}}
        @auth
            <div class="mobile-profile">
                <img src="{{ asset('storage/' . auth()->user()->foto) }}" 
                     class="nav-avatar" id="mobileAvatarToggle">
    
                <div class="mobile-profile-dropdown" id="mobileProfileDropdown">
                    <div class="profile-header">
                        <img src="{{ asset('storage/' . auth()->user()->foto) }}" 
                             class="profile-photo">
                        <div>
                            <strong>{{ auth()->user()->nama }}</strong><br>
                            <small>{{ auth()->user()->email }}</small>
                        </div>
                    </div>
    
                    <div class="dropdown-divider"></div>
    
                    <a href="{{ route('profile') }}" class="btn-edit">Lihat Profile</a>
                    <div class="mobile-riwayat">
                        <a href="#" class="mobile-riwayat-toggle">Riwayat ▾</a>
                        <div class="mobile-riwayat-menu">
                            <a href="{{ route('historysparepart') }}">Riwayat Sparepart</a>
                            <a href="{{ route('historyservice') }}">Riwayat Service</a>
                        </div>
                    </div>
                    @if(auth()->user()->role !== 'user')
                        <a href="{{ route('filament.admin.pages.dashboard') }}" class="btn-admin">
                            Admin Panel
                        </a>
                    @endif
    
                    <div class="dropdown-divider"></div>
    
                    <form action="/logout" method="POST">
                        @csrf
                        <button class="btn-logout">Logout</button>
                    </form>
                </div>
            </div>
        @endauth
    </div>
    
    <main>
        @yield('content')
    </main>

    <script>
/* =====================
   MOBILE RIWAYAT TOGGLE
===================== */
document.addEventListener("DOMContentLoaded", function () {
    const riwayatToggle = document.querySelector(".mobile-riwayat-toggle");
    const riwayatMenu = document.querySelector(".mobile-riwayat-menu");

    if (riwayatToggle) {
        riwayatToggle.addEventListener("click", function (e) {
            e.preventDefault();
            riwayatMenu.classList.toggle("show");
        });

        document.addEventListener("click", function (e) {
            if (!e.target.closest(".mobile-riwayat")) {
                riwayatMenu.classList.remove("show");
            }
        });
    }
});

/* =====================
   UPDATE CART BADGE MOBILE
===================== */
function updateCartBadge(){
    fetch("{{ route('cart.count') }}")
        .then(res => res.json())
        .then(data => {
            const desktopBadge = document.getElementById('cart-badge');
            const mobileBadge = document.getElementById('mobile-cart-badge');

            if (desktopBadge) desktopBadge.innerText = data.count;
            if (mobileBadge) mobileBadge.innerText = data.count;
        });
}
        function updateCartBadge(){
            fetch("{{ route('cart.count') }}")
                .then(res=>res.json())
                .then(data=>{
                    const badge = document.getElementById('cart-badge');
                    badge.innerText = data.count;
                    badge.classList.add('cart-animate');
                    setTimeout(()=>badge.classList.remove('cart-animate'),500);
                });
        }
        const hamburger = document.getElementById("hamburgerBtn");
        const mobileMenu = document.getElementById("mobileMenu");
        
        hamburger.addEventListener("click", () => {
            hamburger.classList.toggle("active");
            mobileMenu.classList.toggle("show");
        });

        document.addEventListener("click", function(e){
            if (!hamburger.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.classList.remove("show");
                hamburger.classList.remove("active");
            }
        });

        const avatar = document.getElementById("avatarToggle");
        const dropdown = document.getElementById("dropdownProfile");
        
        if (avatar) {
            avatar.addEventListener("click", () => {
                dropdown.style.display =
                    dropdown.style.display === "block" ? "none" : "block";
            });
        }
        
        document.addEventListener("click", function(e) {
            if (avatar && !avatar.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.style.display = "none";
            }
        });

        const mobileAvatar = document.getElementById("mobileAvatarToggle");
        const mobileProfileDropdown = document.getElementById("mobileProfileDropdown");
        
        if (mobileAvatar) {
            mobileAvatar.addEventListener("click", () => {
                mobileProfileDropdown.classList.toggle("show");
            });
        }
        
        document.addEventListener("click", function(e) {
            if (
                mobileAvatar &&
                !mobileAvatar.contains(e.target) &&
                !mobileProfileDropdown.contains(e.target)
            ) {
                mobileProfileDropdown.classList.remove("show");
            }
        });

        document.addEventListener("DOMContentLoaded", function () {
            const toggle = document.querySelector(".dropdown-riwayat-toggle");
            const menu = document.querySelector(".dropdown-riwayat-menu");

            toggle.addEventListener("click", function (e) {
                e.preventDefault();
                menu.style.display = menu.style.display === "block" ? "none" : "block";
            });

            document.addEventListener("click", function (e) {
                if (!e.target.closest(".dropdown-riwayat")) {
                    menu.style.display = "none";
                }
            });
        });

        </script>
</body>
</html>