<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\Building;
use App\Models\DataSet;
use App\Models\Rab;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        $user = auth()->user();



        /*
        |--------------------------------------------------------------------------
        | DATA ADMIN
        |--------------------------------------------------------------------------
        */

        if($user->role == 'admin')
        {


            $totalBangunan = Building::count();

            $totalAudit = Audit::count();

            $totalData = DataSet::count();

            $totalRab = Rab::count();



            $totalBiayaSemuaRab = Rab::sum('total_biaya');



            $auditTerbaru = Audit::with([
                    'building'
                ])
                ->latest()
                ->take(5)
                ->get();



            $rabTerbaru = Rab::with([
                    'audit.building'
                ])
                ->latest()
                ->take(5)
                ->get();



            $statistik = [

                $totalBangunan,
                $totalAudit,
                $totalData,
                $totalRab

            ];



            $rabBulanan = Rab::select(
                    DB::raw('MONTH(tanggal_rab) as bulan'),
                    DB::raw('SUM(total_biaya) as total')
                )
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get();



            $bulan = [

                'Jan','Feb','Mar','Apr',
                'Mei','Jun','Jul','Agu',
                'Sep','Okt','Nov','Des'

            ];



            $grafikRab = array_fill(0,12,0);



            foreach($rabBulanan as $item)
            {
                $grafikRab[$item->bulan-1] = $item->total;
            }




            $knnChart = Audit::select(
                    'hasil_knn',
                    DB::raw('COUNT(*) as total')
                )
                ->whereNotNull('hasil_knn')
                ->groupBy('hasil_knn')
                ->pluck(
                    'total',
                    'hasil_knn'
                )
                ->toArray();




            return view(
                'admin.dashboard',
                compact(
                    'totalBangunan',
                    'totalAudit',
                    'totalData',
                    'totalRab',
                    'totalBiayaSemuaRab',
                    'auditTerbaru',
                    'rabTerbaru',
                    'statistik',
                    'bulan',
                    'grafikRab',
                    'knnChart'
                )
            );

        }





        /*
        |--------------------------------------------------------------------------
        | DATA USER / PENGURUS PU
        |--------------------------------------------------------------------------
        */


        $userId = $user->id;




        /*
        | Statistik User
        */


        $totalBangunanUser = Building::count();



        $totalAuditUser = Audit::where(
                'user_id',
                $userId
            )
            ->count();




        $totalRabUser = Rab::whereHas(
                'audit',
                function($query) use($userId){

                    $query->where(
                        'user_id',
                        $userId
                    );

                }
            )
            ->count();




        $totalBiayaRabUser = Rab::whereHas(
                'audit',
                function($query) use($userId){

                    $query->where(
                        'user_id',
                        $userId
                    );

                }
            )
            ->sum('total_biaya');





        /*
        | Audit terbaru user
        */


        $auditTerbaruUser = Audit::with([
                'building'
            ])
            ->where(
                'user_id',
                $userId
            )
            ->latest()
            ->take(5)
            ->get();






        /*
        | RAB terbaru user
        */


        $rabTerbaruUser = Rab::with([
                'audit.building'
            ])
            ->whereHas(
                'audit',
                function($query) use($userId){

                    $query->where(
                        'user_id',
                        $userId
                    );

                }
            )
            ->latest()
            ->take(5)
            ->get();






        $data = compact(

            'totalBangunanUser',

            'totalAuditUser',

            'totalRabUser',

            'totalBiayaRabUser',

            'auditTerbaruUser',

            'rabTerbaruUser'

        );




        return view(
            'user.dashboard',
            $data
        );

    }
}