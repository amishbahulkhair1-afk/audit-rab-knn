<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building;
use App\Imports\BuildingImport;
use PhpOffice\PhpSpreadsheet\IOFactory;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buildings = Building::latest()
            ->paginate(10);

        if (auth()->user()->role == 'admin') {
            return view(
                'buildings.index',
                compact('buildings')
            );
        }

        return view(
            'user.buildings.index',
            compact('buildings')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role == 'admin') {
            return view('buildings.create');
        }

        return view('user.buildings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_bangunan' => 'required|unique:buildings',
            'nama_bangunan' => 'required',
            'rayon' => 'required',
        ]);

        Building::create($request->all());

        return redirect()
            ->route('buildings.index')
            ->with('success', 'Data bangunan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Building $building)
    {
        if (auth()->user()->role == 'admin') {
            return view(
                'buildings.show',
                compact('building')
            );
        }

        return view(
            'user.buildings.show',
            compact('building')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Building $building)
    {
        if (auth()->user()->role == 'admin') {
            return view(
                'buildings.edit',
                compact('building')
            );
        }

        return view(
            'user.buildings.edit',
            compact('building')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Building $building)
    {
        $request->validate([
            'kode_bangunan' => 'required|unique:buildings,kode_bangunan,' . $building->id,
            'nama_bangunan' => 'required',
            'rayon' => 'required',
        ]);

        $building->update($request->all());

        return redirect()
            ->route('buildings.index')
            ->with('success', 'Data bangunan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Building $building)
    {
        $building->delete();

        return redirect()
            ->route('buildings.index')
            ->with('success', 'Data bangunan berhasil dihapus');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel' => 'required|mimes:xlsx,xls,csv|max:5120'
        ]);

        $spreadsheet = IOFactory::load($request->file('excel'));

        $rows = $spreadsheet
            ->getActiveSheet()
            ->toArray();

        $import = new BuildingImport();

        $result = $import->import($rows);

        return redirect()
            ->route('buildings.index')
            ->with(
                'success',
                "{$result['success']} data berhasil diimport."
            )
            ->with(
                'import_errors',
                $result['errors']
            );
    }

}
