<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KnnResult;

class DataSet extends Model
{
    protected $table = 'data_set';

    protected $fillable = [
        'kode_data',
        'nama_bangunan',
        'jenis_konstruksi',
        'pondasi',
        'struktur',
        'atap',
        'dinding',
        'lantai',
        'plafon',
        'pintu',
        'jendela',
        'listrik',
        'sanitasi',

        'keterangan',

        'kategori'
    ];

    public function knnResults()
{
    return $this->hasMany(KnnResult::class);
}
}