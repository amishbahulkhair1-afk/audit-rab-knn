<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportCost;
use App\Imports\SupportCostImport;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SupportCostController extends Controller
{
    public function index()
    {
        $supportCosts = SupportCost::latest()->paginate(10);

        return view('support-costs.index', compact('supportCosts'));
    }

    public function create()
    {
        return view('support-costs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:support_costs',
            'nama_biaya' => 'required',
            'kategori' => 'required',
            'harga_satuan' => 'required|numeric|min:0'
        ]);

        SupportCost::create($request->all());

        return redirect()
            ->route('support-costs.index')
            ->with('success', 'Biaya pendukung berhasil ditambahkan');
    }

    public function show(SupportCost $support_cost)
    {
        return view('support-costs.show', compact('support_cost'));
    }

    public function edit(SupportCost $support_cost)
    {
        return view('support-costs.edit', compact('support_cost'));
    }

    public function update(Request $request, SupportCost $support_cost)
    {
        $request->validate([
            'kode' => 'required|unique:support_costs,kode,' . $support_cost->id,
            'nama_biaya' => 'required',
            'kategori' => 'required',
            'harga_satuan' => 'required|numeric|min:0'
        ]);

        $support_cost->update($request->all());

        return redirect()
            ->route('support-costs.index')
            ->with('success', 'Biaya pendukung berhasil diperbarui');
    }

    public function destroy(SupportCost $support_cost)
    {
        $support_cost->delete();

        return redirect()
            ->route('support-costs.index')
            ->with('success', 'Biaya pendukung berhasil dihapus');
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

        $import = new SupportCostImport();

        $result = $import->import($rows);

        return redirect()
            ->route('support-costs.index')
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