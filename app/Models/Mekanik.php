<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mekanik extends Model
{
    protected $fillable = [
        'nama_mekanik',
        'nomor_karyawan',
        'foto',
        'gaji',
        'status',
        'alamat',
        'no_hp',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'mekanik_id');
    }

}