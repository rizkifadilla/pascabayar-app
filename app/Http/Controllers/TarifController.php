<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tarif;

class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tarif = Tarif::all();
        return view('tarif.index', compact('tarif'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarif.create');
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
            'daya' => 'required',
            'tarifperkwh' => 'required|numeric',
        ]);

        Tarif::create($request->all());
        return redirect()->route('tarif.index')->with('success', 'Data tarif berhasil ditambahkan.');
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
        $tarif = Tarif::findOrFail($id);
        return view('tarif.edit', compact('tarif'));
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
            'daya' => 'required',
            'tarifperkwh' => 'required|numeric',
        ]);

        $tarif = Tarif::findOrFail($id);
        $tarif->update($request->all());
        return redirect()->route('tarif.index')->with('success', 'Data tarif berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tarif::findOrFail($id)->delete();
        return redirect()->route('tarif.index')->with('success', 'Data tarif berhasil dihapus.');
    }
}
