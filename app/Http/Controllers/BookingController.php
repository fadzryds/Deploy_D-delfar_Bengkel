<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Kendaraan;
use App\Models\Mekanik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function create(Request $request)
    {
        $serviceType = $request->query('service', '');
        return view('landing.BookingService', [
            'serviceType' => $serviceType
        ]);
    }

    public function store(Request $request)
    {
        $request->merge([
            'harga_service' => (float) preg_replace('/[^0-9]/', '', $request->harga_service)
        ]);

        $validated = $request->validate([
            'no_hp' => 'required|string|max:20',
            'jenis_motor' => 'required|string|max:255',
            'tipe_kendaraan' => 'required|string|max:255',
            'nomor_polisi' => 'required|string|max:20',
            'keluhan_kendaraan' => 'required|string',
            'jenis_service' => 'required|string|max:255',
            'harga_service' => 'required|numeric|min:0',
            'tanggal_kedatangan' => 'required|date|after_or_equal:today',
            'jam_kedatangan' => 'required|date_format:H:i',
            'mekanik_id' => 'nullable|exists:mekaniks,id',
        ]);

        DB::transaction(function () use ($validated) {

            /** ================= CUSTOMER ================= */
            $customer = Customer::firstOrCreate(
                ['user_id' => Auth::id()],
                [
                    'nama_pelanggan' => Auth::user()->name,
                    'no_hp' => $validated['no_hp'],
                    'email' => Auth::user()->email,
                    'nomor_polisi' => $validated['nomor_polisi'],
                ]
            );

            /** ================= KENDARAAN ================= */
            $kendaraan = Kendaraan::create([
                'nomor_polisi' => $validated['nomor_polisi'],
                'customer_id' => $customer->id,
                'jenis_motor' => $validated['jenis_motor'],
                'tipe_kendaraan' => $validated['tipe_kendaraan'],
            ]);

            /** ================= BOOKING ================= */
            Booking::create([
                'customer_id' => $customer->id,
                'kendaraan_id' => $kendaraan->id,
                'nama_pelanggan' => Auth::user()->name,
                'no_hp' => $validated['no_hp'],
                'jenis_motor' => $validated['jenis_motor'],
                'tipe_kendaraan' => $validated['tipe_kendaraan'],
                'nomor_polisi' => $validated['nomor_polisi'],
                'keluhan_kendaraan' => $validated['keluhan_kendaraan'],
                'jenis_service' => $validated['jenis_service'],
                'harga_service' => $validated['harga_service'],
                'tanggal_kedatangan' => $validated['tanggal_kedatangan'],
                'jam_kedatangan' => $validated['jam_kedatangan'],
                'mekanik_id' => $validated['mekanik_id'] ?? null,
                'nomor_antrian' => Booking::generateQueueNumber(),
                'status' => 'Booked',
            ]);
        });

        return redirect()
            ->route('service')
            ->with('success', 'Booking berhasil dibuat dan masuk antrian');
    }

    public function show(Booking $booking)
    {
        $booking->load('customer', 'mekanik', 'invoice');
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $customers = Customer::all();
        $mekaniks = Mekanik::all();
        return view('bookings.edit', compact('booking', 'customers', 'mekaniks'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'nama_pelanggan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'jenis_motor' => 'required|string|max:255',
            'tipe_kendaraan' => 'required|string|max:255',
            'nomor_polisi' => 'required|string|max:20',
            'keluhan_kendaraan' => 'required|string',
            'jenis_service' => 'required|string|max:255',
            'harga_service' => 'nullable|numeric|min:0',
            'tanggal_kedatangan' => 'required|date',
            'jam_kedatangan' => 'required|date_format:H:i',
            'mekanik_id' => 'nullable|exists:mekaniks,id',
            'status' => 'required|in:Booked,Konfirmasi,Selesai,Dibatalkan',
        ]);

        $booking->update($validated);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Booking berhasil diperbarui');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')
            ->with('success', 'Booking berhasil dihapus');
    }
}
