<?php

namespace App\Http\Controllers;

use App\Models\Busana;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

use function GuzzleHttp\Promise\all;

class BusanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Busana/Index', [
            'busana' => Busana::with('fotos')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Busana/Buat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $busana = new Busana;
        $busana->nama = $request->nama;
        $busana->deskripsi = $request->deskripsi;
        $busana->tipe = $request->tipe;
        $busana->warna = $request->warna;
        $busana->ukuran = $request->ukuran;
        $busana->video = 'ads';
        $busana->harga = $request->harga;
        $busana->save();

        if ($request->file('foto')) {

            foreach ($request->file('foto') as $key => $value) {
                $path = '/storage/foto/' . basename($value->store('public/foto'));

                $foto = new Foto;
                $foto->busana_id = $busana->id;
                $foto->path = $path;
                $foto->urutan = $key;
                $foto->save();
            }
        }

        return to_route('indexBusana');
    }

    /**
     * Display the specified resource.
     */
    public function show(Busana $busana)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Busana $id)
    {
        return Inertia::render('Busana/Edit', [
            'busana' => Busana::with('fotos')->find($id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Busana $busana)
    {

        // return $request->foto_current;

        $busana = Busana::find($request->id);
        $busana->nama = $request->nama;
        $busana->deskripsi = $request->deskripsi;
        $busana->tipe = $request->tipe;
        $busana->warna = $request->warna;
        $busana->ukuran = $request->ukuran;
        $busana->video = 'ads';
        $busana->harga = $request->harga;
        $busana->save();

        if ($request->foto_delete) {
            // return $request->foto_delete_path;
            foreach ($request->foto_delete_path as $key => $value) {
                Storage::delete('public/foto/' . basename($value));
                // return basename($value);
            }
            Foto::destroy($request->foto_delete);
        }
        // return $request->foto_delete;
        // if (json_encode($request->foto_current) !== json_encode($busana->fotos)){
        //     return 'false';
        // } else {
        //     return 'true';
        // }

        if ($request->file('foto')) {
            $fotos_count = ($busana->fotos)->max('urutan') + 1;

            foreach ($request->file('foto') as $key => $value) {
                $path = '/storage/foto/' . basename($value->store('public/foto'));

                $foto = new Foto;
                $foto->busana_id = $busana->id;
                $foto->path = $path;
                $foto->urutan = $fotos_count + $key;
                $foto->save();
            }
        }

        return to_route('indexBusana');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Busana $id)
    {

        $busana = Busana::with('fotos')->find($request->id);
        // return $busana;

        // if ($request->foto_delete) {
        //     // return $request->foto_delete_path;
        foreach ($busana->fotos as $key => $value) {
            Storage::delete('public/foto/' . basename($value->path));
        }
        // Foto::destroy($request->foto_delete);
        // }

        Busana::destroy($request->id);
    }

    public function busanaList(Request $request, Busana $id)
    {
        return Inertia::render('Busana/List', [
            'busana' => Busana::with('fotos')->get()
        ]);
    }
}
