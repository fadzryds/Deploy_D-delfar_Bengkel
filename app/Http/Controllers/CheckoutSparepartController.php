<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CheckoutSparepart;
use App\Models\Customer;

class CheckoutSparepartController extends Controller
{
    // =========================
    // 1️⃣ HALAMAN CHECKOUT
    // =========================
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('sparepart')
                ->with('error', 'Keranjang masih kosong');
        }

        return view('landing.CheckoutSparepart', compact('cart'));
    }

    // =========================
    // 2️⃣ KONFIRMASI CHECKOUT
    // =========================
    public function confirm(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('checkout.sparepart')
                ->with('error', 'Keranjang kosong');
        }

        $totalQty = 0;
        $totalPrice = 0;

        foreach ($cart as $item) {
            $totalQty += $item['quantity'];
            $totalPrice += $item['quantity'] * $item['price'];
        }

        return view('landing.ConfirmCheckoutSparepart', [
            'cart' => $cart,
            'totalQty' => $totalQty,
            'totalPrice' => $totalPrice,
        ]);
    }

    // =========================
    // 3️⃣ SIMPAN KE DATABASE
    // =========================
    public function store(Request $request)
    {
        $user = auth()->user();

        $customer = Customer::firstOrCreate(
            ['user_id' => $user->id],
            [
                'nama_pelanggan' => $user->name,
                'email'          => $user->email,
                'no_hp'          => $request->no_hp, 
            ]
        );        

        $request->validate([
            'nama_pelanggan' => 'required',
            'no_hp' => 'required',
            'pembayaran' => 'required',
            'items' => 'required|array',
        ]);

        foreach ($request->items as $jsonItem) {

            $item = json_decode($jsonItem, true);

            CheckoutSparepart::create([
                'customer_id'       => auth()->user()->customer->id, 
                'sparepart_id'      => $item['id'],
                'nama_pelanggan'    => $request->nama_pelanggan,
                'no_hp'             => $request->no_hp,
                'harga_satuan'      => $item['price'],
                'quantity'          => $item['quantity'],
                'total_price'       => $item['price'] * $item['quantity'],
                'nomor_pembelian'   => CheckoutSparepart::generateQueueNumber(),
                'pembayaran'        => $request->pembayaran,
                'status'            => 'Dipesan',
                'tanggal_pembelian' => now(),
            ]);            
        }

        // kosongkan cart
        session()->forget('cart');

        return redirect()->route('historysparepart')
            ->with('success', 'Checkout sparepart berhasil');
    }
}