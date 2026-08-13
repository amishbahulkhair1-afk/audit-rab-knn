<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Audit;

class Building extends Model
{
 protected $fillable = [
    'kode_bangunan',
    'nama_bangunan',
    'jenis_bangunan',
    'jenis_konstruksi',
    'rayon',
    'alamat',
    'tahun_berdiri',
    'luas_bangunan'
];

    public function audits()
{
    return $this->hasMany(Audit::class);
}
}


