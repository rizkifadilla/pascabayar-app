<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penggunaan;
use App\Pelanggan;
use App\Tagihan;

class PenggunaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Penggunaan::with('pelanggan')->get();
        return view('penggunaan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelanggan = Pelanggan::all();
        return view('penggunaan.create', compact('pelanggan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'meter_awal' => 'required|integer',
            'meter_ahir' => 'required|integer|gte:meter_awal',
        ]);

        // Simpan data penggunaan
        $penggunaan = Penggunaan::create($request->all());

        // Ambil jumlah_meter
        $jumlah_meter = $request->meter_ahir - $request->meter_awal;

        // Ambil tarif per kWh pelanggan
        $pelanggan = Pelanggan::with('tarif')->findOrFail($request->id_pelanggan);
        $tarif_per_kwh = $pelanggan->tarif->tarif_per_kwh ?? 0;

        // Hitung total tagihan
        $jumlah_bayar = $jumlah_meter * $tarif_per_kwh;

        // Simpan ke tabel tagihan
        Tagihan::create([
            'id_pelanggan' => $request->id_pelanggan,
            'id_penggunaan' => $penggunaan->id_penggunaan, // pastikan ada field ini di tabel
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'jumlah_meter' => $jumlah_meter,
            'jumlah_bayar' => $jumlah_bayar,
            'status' => 'Belum Lunas'
        ]);

        return redirect()->route('penggunaan.index')->with('success', 'Penggunaan & tagihan otomatis berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Penggunaan::findOrFail($id);
        $pelanggan = Pelanggan::all();
        return view('penggunaan.edit', compact('data', 'pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pelanggan' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'meter_awal' => 'required|integer',
            'meter_ahir' => 'required|integer|gte:meter_awal',
        ]);

        Penggunaan::findOrFail($id)->update($request->all());
        return redirect()->route('penggunaan.index')->with('success', 'Data penggunaan berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Penggunaan::findOrFail($id)->delete();
        return redirect()->route('penggunaan.index')->with('success', 'Data penggunaan berhasil dihapus.');
    }
}
