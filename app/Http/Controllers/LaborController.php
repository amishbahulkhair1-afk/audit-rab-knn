<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Labor;
use App\Imports\LaborImport;
use PhpOffice\PhpSpreadsheet\IOFactory;

class LaborController extends Controller
{
    public function index()
    {
        $labors = Labor::latest()->paginate(10);

        return view('labors.index', compact('labors'));
    }

    public function create()
    {
        return view('labors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pekerja' => 'required',
            'upah_harian' => 'required|numeric'
        ]);

        $last = Labor::latest()->first();

        if ($last) {
            $lastNumber = (int) substr($last->kode, 1);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $kode = 'U' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        Labor::create([
            'kode' => $kode,
            'nama_pekerja' => $request->nama_pekerja,
            'upah_harian' => $request->upah_harian,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('labors.index')
            ->with('success', 'Data upah berhasil ditambahkan');
    }

    public function show(Labor $labor)
    {
        return view('labors.show', compact('labor'));
    }

    public function edit(Labor $labor)
    {
        return view('labors.edit', compact('labor'));
    }

    public function update(Request $request, Labor $labor)
    {
        $request->validate([
            'nama_pekerja' => 'required',
            'upah_harian' => 'required|numeric'
        ]);

        $labor->update([
            'nama_pekerja' => $request->nama_pekerja,
            'upah_harian' => $request->upah_harian,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('labors.index')
            ->with('success', 'Data upah berhasil diperbarui');
    }

    public function destroy(Labor $labor)
    {
        $labor->delete();

        return redirect()
            ->route('labors.index')
            ->with('success', 'Data upah berhasil dihapus');
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

        $import = new LaborImport();

        $result = $import->import($rows);

        return redirect()
            ->route('labors.index')
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