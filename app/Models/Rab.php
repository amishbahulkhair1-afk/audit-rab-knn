<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Audit;
use App\Models\RabDetail;

class Rab extends Model
{
    protected $fillable = [
    'nomor_rab',
    'audit_id',
    'tanggal_rab',
    'total_biaya'
];


    public function audit()
{
    return $this->belongsTo(Audit::class);
}

public function details()
{
    return $this->hasMany(RabDetail::class);
}

public function hitungTotalBiaya()
{
    $total = $this->details()->sum('subtotal');

    $this->update([
        'total_biaya' => $total
    ]);

    return $total;
}
}
