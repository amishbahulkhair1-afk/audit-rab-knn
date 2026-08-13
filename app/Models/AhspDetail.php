<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ahsp;
use App\Models\Material;
use App\Models\Labor;
use App\Models\Equipment;
use App\Models\SupportCost;


class AhspDetail extends Model
{
    protected $fillable = [
        'ahsp_id',
        'jenis',
        'item_id',
        'koefisien'
    ];

    public function ahsp()
    {
        return $this->belongsTo(Ahsp::class);
    }

    public function getNamaItemAttribute()
    {
        if ($this->jenis == 'material') {
            return Material::find($this->item_id)?->nama_bahan;
        }

        if ($this->jenis == 'labor') {
            return Labor::find($this->item_id)?->nama_pekerja;
        }

        if ($this->jenis == 'equipment') {
            return Equipment::find($this->item_id)?->nama_alat;
        }

        if ($this->jenis == 'support_cost') {
            return SupportCost::find($this->item_id)?->nama_biaya;
        }

        return '-';
    }
}
