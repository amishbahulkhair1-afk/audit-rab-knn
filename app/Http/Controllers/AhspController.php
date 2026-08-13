<?php

namespace App\Http\Controllers;

use App\Models\Ahsp;
use Illuminate\Http\Request;
use App\Models\AhspDetail;
use Illuminate\Support\Facades\DB;
use App\Models\Material;
use App\Models\Labor;
use App\Models\Equipment;
use App\Models\SupportCost;

class AhspController extends Controller
{
    public function index()
    {
        $ahsps = Ahsp::latest()->paginate(10);

        return view('ahsps.index', compact('ahsps'));
    }

    public function create()
    {
        return view('ahsps.create', [

            'materials' => Material::all(),

            'labors' => Labor::all(),

            'equipments' => Equipment::all(),

            'supportCosts' => SupportCost::all(),

        ]);
    }

    public function store(Request $request)
    {
        $request->validate([

            'nama_pekerjaan' => 'required',
            'satuan' => 'required',

            'details' => 'required|array',

        ]);

        DB::transaction(function () use ($request) {
            $last = Ahsp::latest()->first();
            if ($last) {

                $number = ((int) substr($last->kode, 4)) + 1;

            } else {

                $number = 1;

            }
            $kode = 'AHSP' . str_pad($number, 3, '0', STR_PAD_LEFT);
            $ahsp = Ahsp::create([
                'kode' => $kode,

                'nama_pekerjaan' => $request->nama_pekerjaan,

                'satuan' => $request->satuan,
            ]);
            foreach ($request->details as $detail) {
                AhspDetail::create([
                    'ahsp_id' => $ahsp->id,
                    'jenis' => $detail['jenis'],
                    'item_id' => $detail['item_id'],
                    'koefisien' => $detail['koefisien'],
                ]);
            }

            // Hitung total harga satuan setelah seluruh detail tersimpan
            $ahsp->load('details');
            $ahsp->hitungHargaSatuan();
        });

        return redirect()
            ->route('ahsps.index')
            ->with('success', 'Data AHSP berhasil ditambahkan');

    }

    public function show(Ahsp $ahsp)
    {
        $ahsp->load('details');

        return view('ahsps.show', compact('ahsp'));
    }

    public function edit(Ahsp $ahsp)
    {
        return view('ahsps.edit', compact('ahsp'));
    }

    public function update(Request $request, Ahsp $ahsp)
    {
        $request->validate([
            'nama_pekerjaan' => 'required',
            'satuan' => 'required',
            'details' => 'required|array',
        ]);

        DB::transaction(function () use ($request, $ahsp) {

            // Update data utama
            $ahsp->update([
                'nama_pekerjaan' => $request->nama_pekerjaan,
                'satuan' => $request->satuan,
            ]);

            // Ambil seluruh ID detail yang dikirim dari Vue
            $idsYangDikirim = collect($request->details)
                ->pluck('id')
                ->filter()
                ->toArray();

            // Hapus detail yang sudah tidak ada lagi
            $ahsp->details()
                ->whereNotIn('id', $idsYangDikirim)
                ->delete();

            // Update / Insert detail
            foreach ($request->details as $detail) {

                if (!empty($detail['id'])) {

                    AhspDetail::where('id', $detail['id'])
                        ->update([
                            'jenis' => $detail['jenis'],
                            'item_id' => $detail['item_id'],
                            'koefisien' => $detail['koefisien'],
                        ]);

                } else {

                    AhspDetail::create([
                        'ahsp_id' => $ahsp->id,
                        'jenis' => $detail['jenis'],
                        'item_id' => $detail['item_id'],
                        'koefisien' => $detail['koefisien'],
                    ]);

                }
            }

            // Hitung ulang harga satuan
            $ahsp->load('details');
            $ahsp->hitungHargaSatuan();
        });

        return redirect()
            ->route('ahsps.show', $ahsp)
            ->with('success', 'Data AHSP berhasil diperbarui');
    }

    public function destroy(Ahsp $ahsp)
    {
        $ahsp->delete();

        return redirect()
            ->route('ahsps.index')
            ->with('success', 'Data AHSP berhasil dihapus');
    }
}