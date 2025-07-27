@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Tarif</h4>
    <form method="POST" action="{{ route('tarif.update', $tarif->id_tarif) }}">
        @csrf @method('PUT')
        <div class="form-group">
            <label>Daya</label>
            <input type="text" name="daya" class="form-control" value="{{ $tarif->daya }}" required>
        </div>
        <div class="form-group">
            <label>Tarif per kWh</label>
            <input type="number" name="tarifperkwh" class="form-control" value="{{ $tarif->tarifperkwh }}" required>
        </div>
        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection
