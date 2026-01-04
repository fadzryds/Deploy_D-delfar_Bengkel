<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'customer_id',
        'kendaraan_id',
        'service_booking_id',
        'mekanik_id',
        'tanggal_servis',
        'jenis_servis',
        'keluhan',
        'catatan_mekanik',
        'km_servis',
        'total_biaya',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'service_booking_id');
    }


    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function mekanik()
    {
        return $this->belongsTo(Mekanik::class);
    }
}
