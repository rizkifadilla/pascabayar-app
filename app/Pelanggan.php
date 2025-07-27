<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{

    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';

    protected $fillable = [
        'id_pelanggan',
        'username',
        'password',
        'nomor_kwh',
        'nama_pelanggan',
        'alamat',
        'id_tarif'
    ];

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'id_tarif');
    }

    public function penggunaan()
    {
        return $this->hasMany(Penggunaan::class, 'id_pelanggan');
    }

    public function tagihan()
    {
        return $this->hasMany(Tagihan::class, 'id_pelanggan');
    }
}
