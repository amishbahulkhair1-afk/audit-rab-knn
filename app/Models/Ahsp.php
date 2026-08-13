<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Material;
use App\Models\Labor;
use App\Models\Equipment;
use App\Models\SupportCost;

class Ahsp extends Model
{
    protected $fillable = [
            'kode',
            'nama_pekerjaan',
            'satuan',
            'harga_satuan'
    ];

    public function details()
    {
        return $this->hasMany(AhspDetail::class);
    }

    public function hitungHargaSatuan()
{
    $total = 0;

    foreach ($this->details as $detail) {

        $harga = 0;

        if ($detail->jenis == 'material') {

            $item = Material::find($detail->item_id);

            $harga = $item?->harga_satuan ?? 0;
        }

        if ($detail->jenis == 'labor') {

            $item = Labor::find($detail->item_id);

            $harga = $item?->upah_harian ?? 0;
        }

        if ($detail->jenis == 'equipment') {

            $item = Equipment::find($detail->item_id);

            $harga = $item?->harga_satuan ?? 0;
        }

        if ($detail->jenis == 'support_cost') {

            $item = SupportCost::find($detail->item_id);

            $harga = $item?->harga_satuan ?? 0;
        }

        $total += $harga * $detail->koefisien;
    }

    $this->update([
        'harga_satuan' => $total
    ]);

    return $total;
}
}