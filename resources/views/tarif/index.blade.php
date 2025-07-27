@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Data Tarif</h4>
    <a href="{{ route('tarif.create') }}" class="btn btn-primary mb-2">Tambah Tarif</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Daya</th>
                <th>Tarif per kWh</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tarif as $t)
            <tr>
                <td>{{ $t->daya }}</td>
                <td>Rp{{ number_format($t->tarifperkwh, 2, ',', '.') }}</td>
                <td>
                    <a href="{{ route('tarif.edit', $t->id_tarif) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('tarif.destroy', $t->id_tarif) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
