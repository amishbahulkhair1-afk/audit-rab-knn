<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportCost extends Model
{
    protected $fillable = [
        'kode',
        'nama_biaya',
        'kategori',
        'harga_satuan',
        'keterangan'
    ];
}