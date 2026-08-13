<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditDetail extends Model
{
    protected $fillable = [
    'audit_id',
    'komponen',
    'nilai',
    'keterangan'
];

    public function audit()
    {
        return $this->belongsTo(Audit::class);
    }
}
