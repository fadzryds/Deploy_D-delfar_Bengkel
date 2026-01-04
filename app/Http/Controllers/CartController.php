<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sparepart;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'sparepart_id' => 'required|exists:spareparts,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $sparepart = Sparepart::findOrFail($request->sparepart_id);

        $cart = session()->get('cart', []);

        if (isset($cart[$sparepart->id])) {
            $newQty = $cart[$sparepart->id]['quantity'] + $request->quantity;

            if ($newQty > $sparepart->stock) {
                return back()->with('error', 'Stok tidak mencukupi');
            }

            $cart[$sparepart->id]['quantity'] = $newQty;
        } else {
            if ($request->quantity > $sparepart->stock) {
                return back()->with('error', 'Stok tidak mencukupi');
            }

            $cart[$sparepart->id] = [
                'id' => $sparepart->id,
                'name' => $sparepart->name,
                'price' => $sparepart->price,
                'quantity' => $request->quantity,
                'image' => $sparepart->image,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Sparepart ditambahkan ke keranjang');
    }

    public function count()
    {
        $cart = session()->get('cart', []);
    
        $totalQty = 0;
        foreach ($cart as $item) {
            $totalQty += $item['quantity'];
        }
    
        return response()->json([
            'count' => $totalQty
        ]);
    }


    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        $sparepart = Sparepart::findOrFail($request->sparepart_id);

        if ($request->quantity <= 0) {
            unset($cart[$sparepart->id]);
        } else {
            if ($request->quantity > $sparepart->stock) {
                return response()->json(['error' => true]);
            }

            $cart[$sparepart->id]['quantity'] = $request->quantity;
        }

        session()->put('cart', $cart);
        return response()->json(['success' => true]);
    }
}
