@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Pelanggan</h3>

    <form action="{{ route('pelanggan.update', $pelanggan->id_pelanggan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="{{ $pelanggan->username }}" required>
        </div>

        <div class="form-group">
            <label>Nomor KWH</label>
            <input type="text" name="nomor_kwh" class="form-control" value="{{ $pelanggan->nomor_kwh }}" required>
        </div>

        <div class="form-group">
            <label>Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" class="form-control" value="{{ $pelanggan->nama_pelanggan }}" required>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required>{{ $pelanggan->alamat }}</textarea>
        </div>

        <div class="form-group">
            <label>Tarif</label>
            <select name="id_tarif" class="form-control" required>
                @foreach ($tarifs as $tarif)
                    <option value="{{ $tarif->id_tarif }}" {{ $tarif->id_tarif == $pelanggan->id_tarif ? 'selected' : '' }}>
                        {{ $tarif->daya }} VA / Rp{{ number_format($tarif->tarifperkwh) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
