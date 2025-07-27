@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Pelanggan</h3>

    <form action="{{ route('pelanggan.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Nomor KWH</label>
            <input type="text" name="nomor_kwh" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label>Tarif</label>
            <select name="id_tarif" class="form-control" required>
                <option value="">Pilih Tarif</option>
                @foreach ($tarifs as $tarif)
                    <option value="{{ $tarif->id_tarif }}">{{ $tarif->daya }} VA / Rp{{ number_format($tarif->tarifperkwh) }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
