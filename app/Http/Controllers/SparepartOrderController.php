<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SparepartOrderController extends Controller
{
    // Order → Checkout
    public function checkout(Request $request)
    {
        $request->quantity;
        $sparepartId = $request->input('id');
        $quantity = $request->input('quantity', 1);

        // Simpan data sementara di session
        $cart = [
            'sparepart_id' => $sparepartId,
            'quantity' => $quantity
        ];
        session(['cart' => $cart]);

        return redirect()->route('checkout.sparepart');
    }

    // Tampilkan Checkout form
    public function showCheckout()
    {
        $cart = session('cart', null);
        if (!$cart) return redirect()->route('sparepart')->with('error', 'Keranjang kosong');

        $sparepart = \App\Models\Sparepart::find($cart['sparepart_id']);

        return view('landing.checkoutsparepart', [
            'sparepart' => $sparepart,
            'quantity' => $cart['quantity']
        ]);
    }

    // Simpan data Checkout & lanjut ke Confirm
    public function confirm(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
            'alamat' => 'required',
            'quantity' => 'required|numeric|min:1'
        ]);

        // Simpan data Checkout di session
        $checkoutData = $request->only('nama','email','no_hp','alamat','quantity');
        $checkoutData['sparepart_id'] = $request->sparepart_id;
        session(['checkout' => $checkoutData]);

        return redirect()->route('confirm.sparepart');
    }

    // Tampilkan Confirm page
    public function showConfirm()
    {
        $checkout = session('checkout', null);
        if (!$checkout) return redirect()->route('checkout.sparepart')->with('error', 'Data Checkout belum diisi');

        $sparepart = \App\Models\Sparepart::find($checkout['sparepart_id']);

        return view('landing.confirmsparepart', [
            'sparepart' => $sparepart,
            'checkout' => $checkout
        ]);
    }

    // Final Checkout action
    public function finalize(Request $request)
    {
        // Di sini bisa simpan ke database jika mau
        // Untuk sekarang cukup hapus session dan redirect
        session()->forget(['cart','checkout']);
        return redirect('/')->with('success','Checkout berhasil!');
    }
}
