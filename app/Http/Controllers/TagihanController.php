<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tagihan;

class TagihanController extends Controller
{

    public function tagihanSaya(Request $request)
    {
        $id_pelanggan = auth()->user()->id;
        $tagihan = Tagihan::where('id_pelanggan', $id_pelanggan)->get();

        return view('tagihan_saya', compact('tagihan'));
    }
}
