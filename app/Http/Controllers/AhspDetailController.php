<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ahsp;
use App\Models\AhspDetail;
use App\Models\Material;
use App\Models\Labor;
use App\Models\Equipment;
use App\Models\SupportCost;

class AhspDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $details = AhspDetail::latest()->paginate(10);

        return view('ahsp-details.index', compact('details'));
    }

    /**
     * Show form create detail AHSP umum.
     */
    public function create()
    {
        $ahsps = Ahsp::all();

        $materials = Material::all();

        $labors = Labor::all();

        $equipments = Equipment::all();

        $supportCosts = SupportCost::all();

        return view('ahsp-details.create', compact(
            'ahsps',
            'materials',
            'labors',
            'equipments',
            'supportCosts'
        ));
    }

    /**
     * Create detail berdasarkan AHSP tertentu.
     * URL:
     * /ahsps/{ahsp}/details/create
     */
    public function createByAhsp(Ahsp $ahsp)
    {
        $materials = Material::all();

        $labors = Labor::all();

        $equipments = Equipment::all();

        $supportCosts = SupportCost::all();

        return view(
            'ahsp-details.create',
            compact(
                'ahsp',
                'materials',
                'labors',
                'equipments',
                'supportCosts'
            )
        );
    }

    /**
     * Simpan data.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ahsp_id' => 'required',
            'jenis' => 'required',
            'koefisien' => 'required|numeric|min:0.0001'
        ]);

        $itemId = null;

        if ($request->jenis == 'material') {

            if (!$request->material_id) {
                return back()->withErrors([
                    'material_id' => 'Pilih material'
                ])->withInput();
            }

            $itemId = $request->material_id;
        }

        if ($request->jenis == 'labor') {

            if (!$request->labor_id) {
                return back()->withErrors([
                    'labor_id' => 'Pilih tenaga kerja'
                ])->withInput();
            }

            $itemId = $request->labor_id;
        }

        if ($request->jenis == 'equipment') {

            if (!$request->equipment_id) {
                return back()->withErrors([
                    'equipment_id' => 'Pilih peralatan'
                ])->withInput();
            }

            $itemId = $request->equipment_id;
        }

        if ($request->jenis == 'support_cost') {

            if (!$request->support_cost_id) {
                return back()->withErrors([
                    'support_cost_id' => 'Pilih biaya pendukung'
                ])->withInput();
            }

            $itemId = $request->support_cost_id;
        }

        AhspDetail::create([
            'ahsp_id' => $request->ahsp_id,
            'jenis' => $request->jenis,
            'item_id' => $itemId,
            'koefisien' => $request->koefisien
        ]);

        $ahsp = Ahsp::find($request->ahsp_id);

        $ahsp->hitungHargaSatuan();

        return redirect()
            ->route('ahsps.show', $request->ahsp_id)
            ->with(
                'success',
                'Detail AHSP berhasil ditambahkan'
            );
    }

    /**
     * Show detail.
     */
    public function show(AhspDetail $ahsp_detail)
    {
        return view('ahsp-details.show', [
            'detail' => $ahsp_detail
        ]);
    }

    /**
     * Form edit.
     */
    public function edit(AhspDetail $ahsp_detail)
    {
        $ahsps = Ahsp::all();

        $materials = Material::all();

        $labors = Labor::all();

        $equipments = Equipment::all();

        $supportCosts = SupportCost::all();

        return view('ahsp-details.edit', [
            'detail' => $ahsp_detail,
            'ahsps' => $ahsps,
            'materials' => $materials,
            'labors' => $labors,
            'equipments' => $equipments,
            'supportCosts' => $supportCosts
        ]);
    }

    /**
     * Update data.
     */
    public function update(
        Request $request,
        AhspDetail $ahsp_detail
    )
    {
        $request->validate([
            'ahsp_id' => 'required',
            'jenis' => 'required',
            'koefisien' => 'required|numeric|min:0.0001'
        ]);

        $itemId = null;

        if ($request->jenis == 'material') {
            $itemId = $request->material_id;
        }

        if ($request->jenis == 'labor') {
            $itemId = $request->labor_id;
        }

        if ($request->jenis == 'equipment') {
            $itemId = $request->equipment_id;
        }

        if ($request->jenis == 'support_cost') {
            $itemId = $request->support_cost_id;
        }

        $ahsp_detail->update([
            'ahsp_id' => $request->ahsp_id,
            'jenis' => $request->jenis,
            'item_id' => $itemId,
            'koefisien' => $request->koefisien
        ]);

        return redirect()
            ->route('ahsps.show', $request->ahsp_id)
            ->with(
                'success',
                'Detail AHSP berhasil diperbarui'
            );
    }

    /**
     * Hapus data.
     */
    public function destroy(AhspDetail $ahsp_detail)
    {
        $ahspId = $ahsp_detail->ahsp_id;

        $ahsp_detail->delete();

        return redirect()
            ->route('ahsps.show', $ahspId)
            ->with(
                'success',
                'Detail AHSP berhasil dihapus'
            );
    }
}
