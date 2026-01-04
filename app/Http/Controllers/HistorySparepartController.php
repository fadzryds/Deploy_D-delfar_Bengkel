<?php

namespace App\Http\Controllers;

use App\Models\CheckoutSparepart;
use App\Models\Customer;
use App\Models\Sparepart;
use Illuminate\Http\Request;

class HistorySparepartController extends Controller
{
    public function index()
    {
        // Jika user belum login
        if (!auth()->check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu untuk melihat riwayat sparepart');
        }

        // Ambil customer berdasarkan user login
        $customer = Customer::where('user_id', auth()->id())->first();

        // Jika customer tidak ditemukan
        if (!$customer) {
            return redirect()->back()
                ->with('error', 'Data customer tidak ditemukan');
        }

        // Ambil history checkout sparepart milik customer
        $checkouts = CheckoutSparepart::with('sparepart')
            ->where('customer_id', $customer->id)
            ->orderByDesc('created_at')
            ->get();

        return view('landing.HistorySparepart', compact('checkouts'));
    }
}
