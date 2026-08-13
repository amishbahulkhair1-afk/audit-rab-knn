<?php

use Illuminate\Support\Facades\Route;

use App\Models\Material;
use App\Models\Labor;
use App\Models\Equipment;
use App\Models\SupportCost;



Route::get('/materials', function () {

    return Material::select(
        'id',
        'nama_bahan'
    )
    ->orderBy('nama_bahan')
    ->get();

});



Route::get('/labors', function () {

    return Labor::select(
        'id',
        'nama_pekerja'
    )
    ->orderBy('nama_pekerja')
    ->get();

});



Route::get('/equipments', function () {

    return Equipment::select(
        'id',
        'nama_alat'
    )
    ->orderBy('nama_alat')
    ->get();

});



Route::get('/support-costs', function () {

    return SupportCost::select(
        'id',
        'nama_biaya'
    )
    ->orderBy('nama_biaya')
    ->get();

});