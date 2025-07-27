@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Data Pelanggan</h3>

    <a href="{{ route('pelanggan.create') }}" class="btn btn-primary mb-3">Tambah Pelanggan</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor KWH</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Tarif</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pelanggans as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->nomor_kwh }}</td>
                    <td>{{ $p->nama_pelanggan }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>{{ $p->tarif->daya }} VA / Rp{{ number_format($p->tarif->tarif_perkwh) }}</td>
                    <td>
                        <a href="{{ route('pelanggan.edit', $p->id_pelanggan) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pelanggan.destroy', $p->id_pelanggan) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Hapus pelanggan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
