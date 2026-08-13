<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Imports\MaterialImport;
use PhpOffice\PhpSpreadsheet\IOFactory;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = Material::paginate(10);

        $columns = [

            [
                'key' => 'kode',
                'label' => 'Kode'
            ],

            [
                'key' => 'nama_bahan',
                'label' => 'Nama Bahan'
            ],

            [
                'key' => 'satuan',
                'label' => 'Satuan',
                'type' => 'badge'
            ],

            [
                'key' => 'harga_satuan',
                'label' => 'Harga'
            ],

            [
                'key' => 'aksi',
                'label' => 'Aksi',
                'type' => 'action'
            ]

        ];

        return view('materials.index', compact(
            'materials',
            'columns'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('materials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_bahan' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        $last = Material::latest()->first();

        if ($last) {
            $number = (int) substr($last->kode, 1) + 1;
        } else {
            $number = 1;
        }

        $kode = 'M' . str_pad($number, 3, '0', STR_PAD_LEFT);

        Material::create([
            'kode' => $kode,
            'nama_bahan' => $request->nama_bahan,
            'satuan' => $request->satuan,
            'harga_satuan' => $request->harga_satuan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('materials.index')
            ->with('success', 'Material berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        return view('materials.show', compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        return view('materials.edit', compact('material'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {
        $request->validate([
            'nama_bahan' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required|numeric|min:0',
        ]);

        $material->update([
            'nama_bahan' => $request->nama_bahan,
            'satuan' => $request->satuan,
            'harga_satuan' => $request->harga_satuan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('materials.index')
            ->with('success', 'Material berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        $material->delete();

        return redirect()
            ->route('materials.index')
            ->with('success', 'Material berhasil dihapus');
    }

    public function import(Request $request)
    {

        $request->validate([

            'excel' => 'required|mimes:xlsx,xls,csv|max:5120'

        ]);


        $spreadsheet = IOFactory::load(
            $request->file('excel')
        );


        $rows = $spreadsheet
            ->getActiveSheet()
            ->toArray();



        $import = new MaterialImport();


        $result = $import->import($rows);



        return redirect()
            ->route('materials.index')
            ->with(
                'success',
                "{$result['success']} material berhasil diimport"
            )
            ->with(
                'import_errors',
                $result['errors']
            );

    }
}
