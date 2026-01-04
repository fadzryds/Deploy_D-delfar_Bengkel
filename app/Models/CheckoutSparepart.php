<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckoutSparepart extends Model
{
    protected $table = 'checkout_spareparts';

    protected $fillable = [
        'customer_id',
        'sparepart_id',
        'nama_pelanggan',
        'no_hp',
        'harga_satuan',
        'quantity',
        'total_price',
        'nomor_pembelian',
        'pembayaran',
        'status',
        'tanggal_pembelian',
    ];

    protected $casts = [
        'tanggal_pembelian' => 'date',
        'total_price' => 'decimal:2',
        'harga_satuan' => 'decimal:2',
    ];

    /* =====================
     |  RELATIONSHIPS
     ===================== */

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class);
    }

    /* =====================
     |  STATUS HELPERS
     ===================== */

    public function isBooked(): bool
    {
        return $this->status === 'Dipesan';
    }

    public function isConfirmed(): bool
    {
        return $this->status === 'Konfirmasi';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'Selesai';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'Dibatalkan';
    }

    /* =====================
     |  ACCESSORS
     ===================== */

    public function getTotalHargaAttribute()
    {
        return $this->total_price;
    }

    public function getPembayaranLabelAttribute()
    {
        return match ($this->pembayaran) {
            'Transfer' => 'Transfer',
            'COD' => 'COD',
            'Kartu Kredit' => 'Kartu Kredit',
            default => $this->pembayaran,
        };
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'Dipesan' => 'Dipesan',
            'Konfirmasi' => 'Konfirmasi',
            'Sedang Perjalanan' => 'Sedang Perjalanan',
            'Selesai' => 'Selesai',
            'Dibatalkan' => 'Dibatalkan',
            default => $this->status,
        };
    }

    /* =====================
     |  SCOPES
     ===================== */

    public function scopeNeedingConfirmation($query)
    {
        return $query->where('status', 'Dipesan');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'Konfirmasi');
    }

    /* =====================
     |  QUEUE NUMBER
     ===================== */

    public static function generateQueueNumber(): string
    {
        $last = self::where('nomor_pembelian', 'like', 'Cust-%')
            ->latest('id')
            ->first();
        
        $next = $last
            ? ((int) str_replace('Cust-', '', $last->nomor_pembelian) + 1)
            : 1;

        return 'Cust-' . str_pad($next, 3, '0', STR_PAD_LEFT);
    }
}
