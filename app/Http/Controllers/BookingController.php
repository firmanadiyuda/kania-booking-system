<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingList;
use App\Models\Kuitansi;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Booking/Index', [
            'booking' => Booking::with('booking_lists', 'kuitansis')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Booking/Buat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $booking = new Booking;
        $booking->nama_pelanggan = $request->nama_pelanggan;
        $booking->nomor_hp = $request->nomor_hp;
        $booking->alamat = $request->alamat;
        $booking->email = $request->email;
        $booking->lokasi_acara = $request->lokasi_acara;
        $booking->tanggal_booking = $request->tanggal_booking;
        $booking->diskon = $request->diskon;
        $booking->save();

        if ($request->booking_list) {
            foreach ($request->booking_list as $key => $value) {
                $bl = new BookingList();
                $bl->booking_id = $booking->id;
                $bl->nama = $value['nama'];
                $bl->tipe = $value['tipe'];
                $bl->warna = $value['warna'];
                $bl->ukuran = $value['ukuran'];
                $bl->harga = $value['harga'];
                $bl->save();
            }
        }

        return to_route('indexBooking');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $id)
    {
        $booking = Booking::with('booking_lists', 'kuitansis')->find($id)->first();
        $kuitansiValid = $booking->kuitansis->where('valid', true);

        return Inertia::render('Booking/Show', [
            'booking' => $booking,
            'kuitansiValid' => $kuitansiValid,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function buatKuitansi(Request $request, Booking $booking)
    {
        $path = '/storage/kuitansi/' . basename($request->file('foto')[0]->store('public/kuitansi'));

        $kuitansi = new Kuitansi;
        $kuitansi->booking_id = $request->booking_id;
        $kuitansi->nominal = $request->nominal;
        $kuitansi->catatan = $request->catatan;
        $kuitansi->foto = $path;
        $kuitansi->save();
    }

    public function ubahStatusKuitansi(Request $request, Booking $booking)
    {
        $kuitansi = Kuitansi::find($request->id);
        if ($kuitansi->valid) {
            $kuitansi->valid = false;
            $kuitansi->save();
        } else {
            $kuitansi->valid = true;
            $kuitansi->save();

        }
    }

    public function dashboardShow(Request $request, Booking $id)
    {
        $booking = Booking::with('booking_lists', 'kuitansis')->find($id)->first();
        return Inertia::render('Booking/DashboardShow', [
            'booking' => $booking,
        ]);
    }
}
