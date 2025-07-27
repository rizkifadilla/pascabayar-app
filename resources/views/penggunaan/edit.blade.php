@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Data Penggunaan</h3>

    <form action="{{ route('penggunaan.update', $data->id_penggunaan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_pelanggan">Pelanggan</label>
            <select name="id_pelanggan" class="form-control">
                @foreach($pelanggan as $p)
                    <option value="{{ $p->id_pelanggan }}" {{ $p->id_pelanggan == $data->id_pelanggan ? 'selected' : '' }}>{{ $p->nama_pelanggan }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Bulan</label>
            <input type="text" name="bulan" value="{{ $data->bulan }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Tahun</label>
            <input type="text" name="tahun" value="{{ $data->tahun }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Meter Awal</label>
            <input type="number" name="meter_awal" value="{{ $data->meter_awal }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Meter Akhir</label>
            <input type="number" name="meter_ahir" value="{{ $data->meter_ahir }}" class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
