@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Data Penggunaan</h3>

    <form action="{{ route('penggunaan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="id_pelanggan">Pelanggan</label>
            <select name="id_pelanggan" class="form-control">
                @foreach($pelanggan as $p)
                    <option value="{{ $p->id_pelanggan }}">{{ $p->nama_pelanggan }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Bulan</label>
            <input type="text" name="bulan" class="form-control" placeholder="Contoh: Januari">
        </div>

        <div class="mb-3">
            <label>Tahun</label>
            <input type="text" name="tahun" class="form-control" placeholder="Contoh: 2025">
        </div>

        <div class="mb-3">
            <label>Meter Awal</label>
            <input type="number" name="meter_awal" class="form-control">
        </div>

        <div class="mb-3">
            <label>Meter Akhir</label>
            <input type="number" name="meter_ahir" class="form-control">
        </div>

        <button class="btn btn-primary" type="submit">Simpan</button>
    </form>
</div>
@endsection
