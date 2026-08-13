<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipments';

    protected $fillable = [
        'kode',
        'nama_alat',
        'satuan',
        'harga_satuan'
    ];
}