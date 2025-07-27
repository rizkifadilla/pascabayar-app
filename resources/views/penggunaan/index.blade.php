@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Data Penggunaan Listrik</h3>
    <a href="{{ route('penggunaan.create') }}" class="btn btn-primary mb-3">+ Tambah Penggunaan</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pelanggan</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Meter Awal</th>
                <th>Meter Akhir</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->pelanggan->nama_pelanggan }}</td>
                    <td>{{ $item->bulan }}</td>
                    <td>{{ $item->tahun }}</td>
                    <td>{{ $item->meter_awal }}</td>
                    <td>{{ $item->meter_ahir }}</td>
                    <td>
                        <a href="{{ route('penggunaan.edit', $item->id_penggunaan) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('penggunaan.destroy', $item->id_penggunaan) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus data?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
