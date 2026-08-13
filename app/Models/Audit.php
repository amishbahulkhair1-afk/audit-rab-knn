<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Building;
use App\Models\User;
use App\Models\AuditDetail;
use App\Models\Rab;
use App\Models\KnnResult;

class Audit extends Model
{
    protected $fillable = [
    'nomor_audit',
    'building_id',
    'user_id',
    'tanggal_audit',
    'nilai_k',
    'hasil_knn',
    'catatan'
];

public function building()
{
    return $this->belongsTo(Building::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

public function details()
{
    return $this->hasMany(AuditDetail::class);
}

public function rab()
{
    return $this->hasOne(Rab::class);
}

public function knnResults()
{
    return $this->hasMany(KnnResult::class);
}
}
