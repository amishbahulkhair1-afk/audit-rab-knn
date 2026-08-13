<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rab;
use App\Models\Ahsp;
use App\Models\RabDetail;

class RabDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Rab $rab)
{
    $ahsps = Ahsp::all();

    return view(
        'rab-details.create',
        compact(
            'rab',
            'ahsps'
        )
    );
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'rab_id' => 'required',
        'ahsp_id' => 'required',
        'volume' => 'required|numeric|min:1'
    ]);

    $ahsp = Ahsp::findOrFail(
        $request->ahsp_id
    );

    $hargaSatuan = $ahsp->harga_satuan;

    $subtotal =
        $request->volume *
        $hargaSatuan;

    RabDetail::create([
        'rab_id' => $request->rab_id,
        'ahsp_id' => $request->ahsp_id,
        'volume' => $request->volume,
        'harga_satuan' => $hargaSatuan,
        'subtotal' => $subtotal
    ]);

    $rab = Rab::find(
        $request->rab_id
    );

    $rab->hitungTotalBiaya();

    return redirect()
    ->route('audits.show', $rab->audit_id)
    ->with('success', 'Pekerjaan berhasil ditambahkan');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
