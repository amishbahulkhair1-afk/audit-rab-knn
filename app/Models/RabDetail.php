<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RabDetail extends Model
{
    protected $fillable = [
        'rab_id',
        'ahsp_id',
        'volume',
        'harga_satuan',
        'subtotal'
    ];

    public function rab()
    {
        return $this->belongsTo(Rab::class);
    }

    public function ahsp()
    {
        return $this->belongsTo(Ahsp::class);
    }
}