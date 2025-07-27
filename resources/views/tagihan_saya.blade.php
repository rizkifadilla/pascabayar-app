@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tagihan Saya</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Jumlah Meter</th>
                <th>Status</th>
                <!-- <th>Aksi</th> -->
            </tr>
        </thead>
        <tbody>
            @forelse($tagihan as $t)
                <tr>
                    <td>{{ $t->bulan }}</td>
                    <td>{{ $t->tahun }}</td>
                    <td>{{ $t->jumlah_meter }}</td>
                    <td>{{ $t->status }}</td>
                    <!-- <td>
                        @if($t->status === 'Belum Lunas')
                            <form action="" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm">Bayar</button>
                            </form>
                        @else
                            <span class="badge bg-secondary">Lunas</span>
                        @endif
                    </td> -->
                </tr>
            @empty
                <tr>
                    <td colspan="6">Tidak ada tagihan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
