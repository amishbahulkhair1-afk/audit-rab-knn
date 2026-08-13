<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KnnResult extends Model
{
    protected $fillable = [
        'audit_id',
        'data_set_id',
        'distance'
    ];

    public function audit()
    {
        return $this->belongsTo(Audit::class);
    }

    public function dataSet()
    {
        return $this->belongsTo(DataSet::class);
    }
}