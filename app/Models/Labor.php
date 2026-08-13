<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Labor extends Model
{
    protected $fillable = [
    'kode',
    'nama_pekerja',
    'upah_harian'
];
}
