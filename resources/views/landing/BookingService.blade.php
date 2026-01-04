@extends('layouts.app')

@section('title', 'Booking Service - D\'Delfar Bengkel Motor')

@section('content')

<section class="booking-section">
    <div class="booking-container">
        <div class="booking-header">
            <h2>Booking Service</h2>
            <a href="{{ url('/service') }}" class="btn-back">← Kembali</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-error">
                <h4>⚠️ Ada kesalahan pada form:</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="booking-form-wrapper">
            <form action="{{ route('bookings.store') }}" method="POST" class="booking-form">
                @csrf
                
                <!-- Service Information -->
                <div class="form-group">
                    <label for="jenis_service">Jenis Service *</label>
                    <input type="text" id="jenis_service" name="jenis_service" 
                        value="{{ request('service', old('jenis_service', '')) }}" 
                        placeholder="Pilih service dari halaman Service" 
                        readonly class="input-readonly" required>
                    @error('jenis_service')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Harga Information -->
                <div class="form-group">
                    <label for="harga_service">Harga Service *</label>
                    <input type="text" id="harga_service" name="harga_service" 
                        value="Rp. {{ number_format((float) str_replace(['Rp', '.', ' '], '', request('harga', old('harga_service', 0))), 0, ',', '.') }}"
                        placeholder="Pilih service dari halaman Service" 
                        readonly class="input-readonly" required>
                    @error('harga_service')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>


                <!-- Customer Information -->
                <div class="form-section">
                    <h3>Data Pelanggan</h3>
                    
                    <div class="form-group">
                        <label for="nama_pelanggan">Nama Pelanggan *</label>
                        <input type="text" id="nama_pelanggan" name="nama_pelanggan" 
                            value="{{ auth()->user()->name ?? '' }}"
                            placeholder="Masukkan nama pelanggan" 
                            readoly class="input-readonly" required>
                        @error('nama_pelanggan')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="no_hp">No HP/WhatsApp *</label>
                        <input type="tel" id="no_hp" name="no_hp" 
                               placeholder="Contoh: 0896-1234-5678" required>
                        @error('no_hp')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Vehicle Information -->
                <div class="form-section">
                    <h3>Data Kendaraan</h3>
                    
                    <div class="form-group">
                        <label for="jenis_motor">Jenis Motor *</label>
                        <select id="jenis_motor" name="jenis_motor" required>
                            <option value="">-- Pilih Jenis Motor --</option>
                            <option value="Honda">Honda</option>
                            <option value="Yamaha">Yamaha</option>
                            <option value="Suzuki">Suzuki</option>
                            <option value="Kawasaki">Kawasaki</option>
                            <option value="KTM">KTM</option>
                            <option value="Vespa">Vespa</option>
                            <option value="Other">Lainnya</option>
                        </select>
                        @error('jenis_motor')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tipe_kendaraan">Tipe Kendaraan *</label>
                        <input type="text" id="tipe_kendaraan" name="tipe_kendaraan" 
                               placeholder="Contoh: Mio Sporty, KLX, PCX 150" required>
                        @error('tipe_kendaraan')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nomor_polisi">Nomor Polisi Kendaraan *</label>
                        <input type="text" id="nomor_polisi" name="nomor_polisi" 
                               placeholder="Contoh: B 1234 ABC" required>
                        @error('nomor_polisi')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="keluhan_kendaraan">Keluhan Kendaraan *</label>
                        <input type="text" id="keluhan_kendaraan" name="keluhan_kendaraan" 
                               placeholder="Jelaskan keluhan kendaraan Anda" required>
                        @error('keluhan_kendaraan')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Appointment Information -->
                <div class="form-section">
                    <h3>Jadwal Kedatangan</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="tanggal_kedatangan">Tanggal Kedatangan *</label>
                            <input type="date" id="tanggal_kedatangan" name="tanggal_kedatangan" 
                                   min="{{ date('Y-m-d') }}" required>
                            @error('tanggal_kedatangan')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jam_kedatangan">Jam Kedatangan *</label>
                            <input type="time" id="jam_kedatangan" name="jam_kedatangan" required>
                            @error('jam_kedatangan')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <p class="info-text">
                        <strong>Jam Operasional:</strong> 09:00 - 20:00 WIB
                    </p>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn-submit">Konfirmasi Booking</button>
                    <a href="{{ url('/service') }}" class="btn-cancel">Batal</a>
                </div>
            </form>
        </div>
    </div>
</section>

<style>
.booking-section {
    padding: 60px 20px;
    min-height: calc(100vh - 200px);
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.booking-container {
    max-width: 600px;
    margin: 0 auto;
}

.booking-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
}

.booking-header h2 {
    font-size: 32px;
    color: #333;
    margin: 0;
}

.btn-back {
    background: #ff6b35;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
    transition: background 0.3s ease;
}

.btn-back:hover {
    background: #e55a2b;
}

.booking-form-wrapper {
    background: white;
    border-radius: 12px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.form-section {
    margin-bottom: 35px;
}

.form-section h3 {
    font-size: 18px;
    color: #333;
    margin: 0 0 20px 0;
    padding-bottom: 10px;
    border-bottom: 2px solid #ff6b35;
}

.form-group {
    margin-bottom: 20px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.form-group label {
    display: block;
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
    font-size: 14px;
}

.form-group input[type="text"],
.form-group input[type="tel"],
.form-group input[type="date"],
.form-group input[type="time"],
.form-group select {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    font-size: 14px;
    font-family: inherit;
    transition: border-color 0.3s ease;
}

.form-group input[type="text"]:focus,
.form-group input[type="tel"]:focus,
.form-group input[type="date"]:focus,
.form-group input[type="time"]:focus,
.form-group select:focus {
    outline: none;
    border-color: #ff6b35;
    box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
}

.input-readonly {
    background-color: #f5f5f5;
    cursor: not-allowed;
}

.error-message {
    color: #e74c3c;
    font-size: 12px;
    margin-top: 5px;
    display: block;
}

.info-text {
    background-color: #f0f8ff;
    padding: 12px 15px;
    border-left: 4px solid #ff6b35;
    border-radius: 4px;
    color: #555;
    font-size: 13px;
    margin: 0;
}

.form-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
    margin-top: 35px;
}

.btn-submit,
.btn-cancel {
    padding: 14px 20px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    text-decoration: none;
    text-align: center;
    transition: all 0.3s ease;
}

.btn-submit {
    background: linear-gradient(135deg, #ff6b35, #ff8c5a);
    color: white;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3);
}

.btn-submit:active {
    transform: translateY(0);
}

.btn-cancel {
    background: #f0f0f0;
    color: #333;
    border: 2px solid #e0e0e0;
}

.btn-cancel:hover {
    background: #e8e8e8;
    border-color: #d0d0d0;
}

.alert {
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 25px;
}

.alert-error {
    background: #f8d7da;
    border-left: 4px solid #e74c3c;
    color: #721c24;
}

.alert-error h4 {
    margin: 0 0 10px 0;
    font-size: 16px;
}

.alert-error ul {
    margin: 0;
    padding-left: 20px;
}

.alert-error li {
    margin: 5px 0;
    font-size: 14px;
}

@media (max-width: 600px) {
    .booking-container {
        padding: 0;
    }

    .booking-form-wrapper {
        padding: 20px;
        border-radius: 0;
    }

    .booking-header {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }

    .booking-header h2 {
        font-size: 24px;
    }

    .form-row {
        grid-template-columns: 1fr;
    }

    .form-actions {
        grid-template-columns: 1fr;
    }
}
</style>

@endsection
