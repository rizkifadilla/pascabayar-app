@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Tambah Tarif</h4>
    <form method="POST" action="{{ route('tarif.store') }}">
        @csrf
        <div class="form-group">
            <label>Daya</label>
            <input type="text" name="daya" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Tarif per kWh</label>
            <input type="number" name="tarifperkwh" class="form-control" required>
        </div>
        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
