<?php

namespace App\Http\Controllers;

use App\Models\DataSet;
use Illuminate\Http\Request;
use App\Models\Audit;
use App\Models\AuditDetail;
use App\Models\Building;
use Illuminate\Support\Facades\Auth;
use App\Models\KnnResult;
use App\Models\Ahsp;
use App\Models\Rab;
use App\Services\RecommendationService;
use Barryvdh\DomPDF\Facade\Pdf;

class AuditController extends Controller
{
    public function index()
    {
        $audits = Audit::with('building')
            ->latest()
            ->paginate(10);

        if (auth()->user()->role == 'admin') {
            return view(
                'audits.index',
                compact('audits')
            );
        }

        return view(
            'user.audits.index',
            compact('audits')
        );
    }

    public function create(Request $request)
    {
        $buildings = Building::orderBy('nama_bangunan')->get();

        // Jika datang dari detail bangunan
        $selectedBuilding = null;

        if ($request->filled('building_id')) {
            $selectedBuilding = Building::find($request->building_id);
        }

        if (auth()->user()->role == 'pengurus_pu') {
            return view(
                'user.audits.create',
                compact(
                    'buildings',
                    'selectedBuilding'
                )
            );
        }

        return view(
            'audits.create',
            compact(
                'buildings',
                'selectedBuilding'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'building_id' => 'required',
            'tanggal_audit' => 'required|date',
            'catatan' => 'nullable',

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
        ]);

        $lastAudit = Audit::latest()->first();

        if ($lastAudit) {
            $lastNumber = (int) substr($lastAudit->nomor_audit, 4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $nomorAudit = 'AUD-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        $audit = Audit::create([
            'nomor_audit' => $nomorAudit,
            'building_id' => $request->building_id,
            'user_id' => Auth::id(),
            'tanggal_audit' => $request->tanggal_audit,
            'nilai_k' => 3,
            'catatan' => $request->catatan,
        ]);

        $komponen = [
            'pondasi',
            'struktur',
            'atap',
            'dinding',
            'lantai',
            'plafon',
            'pintu',
            'jendela',
            'listrik',
            'sanitasi'
        ];

        foreach ($komponen as $item) {
            AuditDetail::create([
                'audit_id' => $audit->id,
                'komponen' => $item,
                'nilai' => $request->$item,
            ]);
        }

        $building = Building::find($request->building_id);
        $dataSet = DataSet::where(
            'jenis_konstruksi',
            $building->jenis_konstruksi
        )->get();

        if ($dataSet->count() < 3) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Data latih untuk jenis konstruksi '
                    . $building->jenis_konstruksi .
                    ' belum mencukupi (minimal 3 data).'
                );
        }

        $distances = [];

        foreach ($dataSet as $train) {

            $distance = sqrt(

                pow($request->pondasi - $train->pondasi, 2) +
                pow($request->struktur - $train->struktur, 2) +
                pow($request->atap - $train->atap, 2) +
                pow($request->dinding - $train->dinding, 2) +
                pow($request->lantai - $train->lantai, 2) +
                pow($request->plafon - $train->plafon, 2) +
                pow($request->pintu - $train->pintu, 2) +
                pow($request->jendela - $train->jendela, 2) +
                pow($request->listrik - $train->listrik, 2) +
                pow($request->sanitasi - $train->sanitasi, 2)

            );

            $distances[] = [
                'data_set_id' => $train->id,
                'kode_data' => $train->kode_data,
                'distance' => $distance,
                'kategori' => $train->kategori,
            ];
        }

        usort($distances, function ($a, $b) {
            return $a['distance'] <=> $b['distance'];
        });

        $neighbors = array_slice($distances, 0, 3);

        foreach ($neighbors as $neighbor) {

            KnnResult::create([
                'audit_id' => $audit->id,
                'data_set_id' => $neighbor['data_set_id'],
                'distance' => $neighbor['distance'],
            ]);
        }

        $votes = [];

        foreach ($neighbors as $neighbor) {

            $kategori = $neighbor['kategori'];

            if (!isset($votes[$kategori])) {
                $votes[$kategori] = 0;
            }

            $votes[$kategori]++;
        }

        arsort($votes);

        $hasilKnn = array_key_first($votes);

        $audit->update([
            'hasil_knn' => $hasilKnn
        ]);

        $recommendation = RecommendationService::generate($request);

        Rab::create([
            'nomor_rab' => 'RAB-' . str_pad(
                (Rab::count() + 1),
                3,
                '0',
                STR_PAD_LEFT
            ),
            'audit_id' => $audit->id,
            'tanggal_rab' => now(),
            'total_biaya' => 0
        ]);

        return redirect()
            ->route('audits.show', $audit)
            ->with(
                'success',
                'Audit berhasil diproses dengan KNN'
            );
    }

    public function show(Audit $audit)
    {
        $audit->load([
            'building',
            'user',
            'details',
            'knnResults.dataSet',
            'rab.details.ahsp'
        ]);

        $ahsps = Ahsp::all();

        $recommendation = RecommendationService::generate(
            (object) $audit->details
                ->pluck('nilai', 'komponen')
                ->toArray()
        );

        if (auth()->user()->role == 'admin') {
            return view(
                'audits.show',
                compact(
                    'audit',
                    'ahsps',
                    'recommendation'
                )
            );
        }

        return view(
            'user.audits.show',
            compact(
                'audit',
                'ahsps',
                'recommendation'
            )
        );
    }
    public function pdf(Audit $audit)
    {
        $audit->load([
            'building',
            'user',
            'details',
            'knnResults.dataSet',
            'rab.details.ahsp'
        ]);

        $recommendation = RecommendationService::generate(
            (object) $audit->details
                ->pluck('nilai', 'komponen')
                ->toArray()
        );

        $pdf = Pdf::loadView(
            'audits.pdf',
            compact('audit', 'recommendation')
        );

        $pdf->setPaper('A4', 'portrait');

        return $pdf->download(
            'Laporan-Audit-' .
            $audit->nomor_audit .
            '.pdf'
        );

    }


}