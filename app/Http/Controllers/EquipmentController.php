<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Imports\EquipmentImport;
use PhpOffice\PhpSpreadsheet\IOFactory;


class EquipmentController extends Controller
{
    public function index()
    {
        $equipments = Equipment::latest()->paginate(10);

        return view('equipments.index', compact('equipments'));
    }

    public function create()
    {
        return view('equipments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required|numeric'
        ]);

        $last = Equipment::latest()->first();

        if ($last) {
            $number = ((int) substr($last->kode, 1)) + 1;
        } else {
            $number = 1;
        }

        $kode = 'A' . str_pad($number, 3, '0', STR_PAD_LEFT);

        Equipment::create([
            'kode' => $kode,
            'nama_alat' => $request->nama_alat,
            'satuan' => $request->satuan,
            'harga_satuan' => $request->harga_satuan,
        ]);

        return redirect()
            ->route('equipments.index')
            ->with('success', 'Data alat berhasil ditambahkan');
    }

    public function show(Equipment $equipment)
    {
        return view('equipments.show', compact('equipment'));
    }

    public function edit(Equipment $equipment)
    {
        return view('equipments.edit', compact('equipment'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        $request->validate([
            'nama_alat' => 'required',
            'satuan' => 'required',
            'harga_satuan' => 'required|numeric'
        ]);

        $equipment->update([
            'nama_alat' => $request->nama_alat,
            'satuan' => $request->satuan,
            'harga_satuan' => $request->harga_satuan,
        ]);

        return redirect()
            ->route('equipments.index')
            ->with('success', 'Data alat berhasil diperbarui');
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        return redirect()
            ->route('equipments.index')
            ->with('success', 'Data alat berhasil dihapus');
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

        $import = new EquipmentImport();

        $result = $import->import($rows);

        return redirect()
            ->route('equipments.index')
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