<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
    'kode',
    'nama_bahan',
    'satuan',
    'harga_satuan',
    'keterangan'
];
}
