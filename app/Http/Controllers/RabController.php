<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Audit;
use App\Models\Rab;

class RabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $rabs = Rab::with('audit')
        ->latest()
        ->paginate(10);

    if(auth()->user()->role == 'admin')
    {
        return view(
            'rabs.index',
            compact('rabs')
        );
    }

    return view(
        'user.rabs.index',
        compact('rabs')
    );
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return redirect()
        ->route('audits.index');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $last = Rab::latest()->first();

    if ($last) {

        $nomor = (int) substr(
            $last->nomor_rab,
            4
        ) + 1;

    } else {

        $nomor = 1;
    }

    dd($request->all());

    $rab = Rab::create([

        'nomor_rab' =>
            'RAB-' .
            str_pad(
                $nomor,
                3,
                '0',
                STR_PAD_LEFT
            ),

        'audit_id' =>
            $request->audit_id,

        'tanggal_rab' =>
            now(),

        'total_biaya' => 0
    ]);

    return redirect()
        ->route(
            'rabs.show',
            $rab->id
        );
}

    /**
     * Display the specified resource.
     */
    public function show(Rab $rab)
{
    $rab->load(
        'audit',
        'details.ahsp'
    );

    if(auth()->user()->role == 'admin')
    {
        return view(
            'rabs.show',
            compact('rab')
        );
    }

    return view(
        'user.rabs.show',
        compact('rab')
    );
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

    public function createFromAudit(Audit $audit)
{
    // Cek apakah audit sudah punya RAB
    if ($audit->rab) {

        return redirect()
            ->route('rabs.show', $audit->rab->id)
            ->with(
                'success',
                'RAB sudah pernah dibuat.'
            );
    }

    $last = Rab::latest()->first();

    if ($last) {

        $nomor = (int) substr(
            $last->nomor_rab,
            4
        ) + 1;

    } else {

        $nomor = 1;
    }

    $rab = Rab::create([

        'nomor_rab' =>
            'RAB-' .
            str_pad(
                $nomor,
                3,
                '0',
                STR_PAD_LEFT
            ),

        'audit_id' => $audit->id,

        'tanggal_rab' => now(),

        'total_biaya' => 0

    ]);

    return redirect()
        ->route('rabs.show', $rab->id)
        ->with(
            'success',
            'RAB berhasil dibuat.'
        );
}
}
