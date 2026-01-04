<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function show(Invoice $invoice)
    {
        $user = Auth::user();

        // Jika belum login → redirect login
        if (!$user) {
            abort(403, 'Silakan login');
        }

        // ADMIN & STAFF BOLEH LIHAT SEMUA INVOICE
        if (in_array($user->role, ['admin', 'staff'])) {
            return view('landing.invoice', compact('invoice'));
        }

        // USER BIASA → CEK RELASI CUSTOMER
        if (
            !$user->customer ||
            $invoice->customer_id !== $user->customer->id
        ) {
            abort(403, 'Invoice bukan milik Anda');
        }

        return view('landing.invoice', compact('invoice'));
    }
}
