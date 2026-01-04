<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraans';

    protected $fillable = [
        'customer_id',
        'jenis_motor',
        'tipe_kendaraan',
        'nomor_polisi',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function serviceBooking()
    {
        return $this->hasMany(Booking::class, 'kendaraan_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'kendaraan_id');
    }
}
