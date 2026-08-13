<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataSet;
use App\Imports\DatasetImport;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DataSetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataSet = DataSet::latest()->paginate(10);

        return view('data-set.index', compact('dataSet'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data-set.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pondasi' => 'required|integer|min:1|max:5',
            'struktur' => 'required|integer|min:1|max:5',
            'atap' => 'required|integer|min:1|max:5',
            'dinding' => 'required|integer|min:1|max:5',
            'lantai' => 'required|integer|min:1|max:5',
            'plafon' => 'required|integer|min:1|max:5',
            'pintu' => 'required|integer|min:1|max:5',
            'jendela' => 'required|integer|min:1|max:5',
            'listrik' => 'required|integer|min:1|max:5',
            'sanitasi' => 'required|integer|min:1|max:5',
            'kategori' => 'required'
        ]);

        $lastData = DataSet::orderBy('id', 'desc')->first();

        if ($lastData) {
            $lastNumber = (int) substr($lastData->kode_data, 2);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $kodeData = 'TR' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        DataSet::create([
            'kode_data' => $kodeData,
            'nama_bangunan' => $request->nama_bangunan,
            'jenis_konstruksi' => $request->jenis_konstruksi,
            'pondasi' => $request->pondasi,
            'struktur' => $request->struktur,
            'atap' => $request->atap,
            'dinding' => $request->dinding,
            'lantai' => $request->lantai,
            'plafon' => $request->plafon,
            'pintu' => $request->pintu,
            'jendela' => $request->jendela,
            'listrik' => $request->listrik,
            'sanitasi' => $request->sanitasi,

            'keterangan' => $request->keterangan,

            'kategori' => $request->kategori,
        ]);

        return redirect()
            ->route('data-set.index')
            ->with('success', 'Data latih berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(DataSet $data_setum)
    {
        return view('data-set.show', [
            'dataSet' => $data_setum
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DataSet $data_setum)
    {
        return view('data-set.edit', [
            'dataSet' => $data_setum
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DataSet $data_setum)
    {
        $request->validate([
            'pondasi' => 'required|integer|min:1|max:5',
            'struktur' => 'required|integer|min:1|max:5',
            'atap' => 'required|integer|min:1|max:5',
            'dinding' => 'required|integer|min:1|max:5',
            'lantai' => 'required|integer|min:1|max:5',
            'plafon' => 'required|integer|min:1|max:5',
            'pintu' => 'required|integer|min:1|max:5',
            'jendela' => 'required|integer|min:1|max:5',
            'listrik' => 'required|integer|min:1|max:5',
            'sanitasi' => 'required|integer|min:1|max:5',
            'kategori' => 'required',
            'nama_bangunan' => 'required',
            'jenis_konstruksi' => 'required',
        ]);

        $data_setum->update($request->all());

        return redirect()
            ->route('data-set.index')
            ->with('success', 'Data latih berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataSet $data_setum)
    {
        $data_setum->delete();

        return redirect()
            ->route('data-set.index')
            ->with('success', 'Data latih berhasil dihapus');
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

        $import = new DatasetImport();

        $result = $import->import($rows);

        return redirect()
            ->route('data-set.index')
            ->with(
                'success',
                "{$result['success']} data latih berhasil diimport."
            )
            ->with(
                'import_errors',
                $result['errors']
            );
    }
}
