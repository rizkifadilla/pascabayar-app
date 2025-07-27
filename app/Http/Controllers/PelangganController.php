<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelanggan;
use App\Tarif;
use App\User;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggans = Pelanggan::with('tarif')->get();
        return view('pelanggan.index', compact('pelanggans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tarifs = Tarif::all();
        return view('pelanggan.create', compact('tarifs'));
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
            'username' => 'required|unique:pelanggan',
            'password' => 'required',
            'nomor_kwh' => 'required',
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'id_tarif' => 'required|exists:tarif,id_tarif',
        ]);

        $user = new User();
        $user->name = $request->nama_pelanggan;
        $user->email = $request->username;
        $user->password = bcrypt($request->password);
        $user->save(); // pastikan data masuk dulu

        // setelah pasti id tersedia
        Pelanggan::create([
            'id_pelanggan' => $user->id,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'nomor_kwh' => $request->nomor_kwh,
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'id_tarif' => $request->id_tarif,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan dan user berhasil ditambahkan.');
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
        $pelanggan = Pelanggan::findOrFail($id);
        $tarifs = Tarif::all();
        return view('pelanggan.edit', compact('pelanggan', 'tarifs'));
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
        $pelanggan = Pelanggan::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:pelanggan,username,' . $id . ',id_pelanggan',
            'nomor_kwh' => 'required',
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'id_tarif' => 'required|exists:tarif,id_tarif',
        ]);

        $pelanggan->update([
            'username' => $request->username,
            'nomor_kwh' => $request->nomor_kwh,
            'nama_pelanggan' => $request->nama_pelanggan,
            'alamat' => $request->alamat,
            'id_tarif' => $request->id_tarif,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('success', 'Data pelanggan berhasil dihapus.');
    }
}
