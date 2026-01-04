<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;

    protected $table = 'service_booking';
    
    protected $fillable = [
        'customer_id',
        'kendaraan_id',
        'nama_pelanggan',
        'no_hp',
        'jenis_motor',
        'tipe_kendaraan',
        'nomor_polisi',
        'keluhan_kendaraan',
        'jenis_service',
        'harga_service',
        'tanggal_kedatangan',
        'jam_kedatangan',
        'nomor_antrian',
        'mekanik_id',
        'status',
    ];

    protected $guarded = [];

    protected $casts = [
        'tanggal_kedatangan' => 'date',
        'jam_kedatangan' => 'string',
        'harga_service' => 'decimal:2',
    ];

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }

    public function mekanik()
    {
        return $this->belongsTo(Mekanik::class, 'mekanik_id');
    }

    public function serviceDetails()
    {
        return $this->hasMany(ServiceDetail::class, 'service_booking_id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'service_booking_id');
    }

    // Helper Methods
    public function getTotalHargaAttribute()
    {
        return $this->harga_service + $this->serviceDetails()->sum('total_harga');
    }

    public function isBooked()
    {
        return $this->status === 'Booked';
    }

    public function isConfirmed()
    {
        return $this->status === 'Konfirmasi';
    }

    public function isCompleted()
    {
        return $this->status === 'Selesai';
    }

    public function isCancelled()
    {
        return $this->status === 'Dibatalkan';
    }

    // Generate Queue Number
    public static function generateQueueNumber()
    {
        $lastNumber = self::where('nomor_antrian', 'like', 'ANTRI-%')
            ->latest('id')
            ->first();

        if ($lastNumber) {
            $currentNumber = (int) str_replace('ANTRI-', '', $lastNumber->nomor_antrian);
            $nextNumber = $currentNumber + 1;
        } else {
            $nextNumber = 1;
        }

        return 'ANTRI-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }

    // Scope: Get all bookings that need confirmation
    public function scopeNeedingConfirmation($query)
    {
        return $query->where('status', 'Booked');
    }

    // Scope: Get bookings confirmed
    public function scopeConfirmed($query)
    {
        return $query->where('status', 'Konfirmasi');
    }

    // Get readable status
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'Booked' => 'Menunggu Konfirmasi',
            'Konfirmasi' => 'Dikonfirmasi',
            'Selesai' => 'Selesai',
            'Dibatalkan' => 'Dibatalkan',
            default => $this->status,
        };
    }
}
