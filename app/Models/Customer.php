<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'user_id',
        'nama_pelanggan',
        'no_hp',
        'email',
        'Option',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kendaraans()
    {
        return $this->hasMany(Kendaraan::class, 'customer_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'customer_id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'customer_id');
    }

    /*public function sparepartSales()
    {
        return $this->hasMany(SparepartSale::class, 'customer_id');
    }*/
}
