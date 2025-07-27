<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    protected $table = 'tarif';
    protected $primaryKey = 'id_tarif';
    public $timestamps = false;

    protected $fillable = [
        'daya', 'tarifperkwh',
    ];

    public function pelanggans()
    {
        return $this->hasMany(Pelanggan::class, 'id_tarif');
    }

}
