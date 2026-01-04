<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Kendaraan;
use App\Models\Mekanik;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;

class HistoryServiceController extends Controller
{
    public function index()
    {
        // Jika user login, tampilkan booking milik user
        if (auth()->check()) {
            $bookings = Booking::where('customer_id', auth()->user()->id)
                ->orderByDesc('created_at')
                ->get();
        } else {
            // Jika belum login, redirect ke login
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk melihat riwayat service');
        }

        $customer = \App\Models\Customer::where('user_id', auth()->id())->first();
        $bookings = $customer
        ? \App\Models\Booking::where('customer_id', $customer->id)->get()
        : collect();

        return view('landing.HistoryService', compact('bookings'));
    }
}
