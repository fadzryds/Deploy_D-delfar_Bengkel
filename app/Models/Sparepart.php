<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CheckoutSparepart;
Use App\Models\Invoice;

class Sparepart extends Model
{
    protected $fillable = ['name', 'price', 'description', 'image', 'stock'];
}