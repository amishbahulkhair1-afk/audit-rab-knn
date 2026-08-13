<?php

namespace App\Services;

class RecommendationService
{
    public static function generate($request)
    {
        $components = [
            'pondasi' => 'Pondasi',
            'struktur' => 'Struktur',
            'atap' => 'Atap',
            'dinding' => 'Dinding',
            'lantai' => 'Lantai',
            'plafon' => 'Plafon',
            'pintu' => 'Pintu',
            'jendela' => 'Jendela',
            'listrik' => 'Listrik',
            'sanitasi' => 'Sanitasi',
        ];

        $recommendations = [];

        $statusBangunan = "Layak Ditempati";
        $prioritas = "Rendah";

        foreach ($components as $field => $nama) {

            $nilai = $request->$field;

            $status = "";
            $rekomendasi = "";
            $risiko = "";
            $level = "";

            switch ($nilai) {

                case 5:

                    $status = "Sangat Baik";
                    $rekomendasi = "Tidak memerlukan tindakan.";
                    $risiko = "-";
                    $level = "Rendah";

                    break;

                case 4:

                    $status = "Baik";
                    $rekomendasi = "Lakukan monitoring berkala.";
                    $risiko = "-";
                    $level = "Rendah";

                    break;

                case 3:

                    $status = "Cukup";
                    $rekomendasi = "Perlu perawatan ringan.";
                    $risiko = "Apabila dibiarkan dapat berkembang menjadi kerusakan sedang.";
                    $level = "Sedang";

                    if ($prioritas == "Rendah")
                        $prioritas = "Sedang";

                    break;

                case 2:

                    $status = "Rusak Sedang";
                    $rekomendasi = "Perlu dilakukan perbaikan sebagian.";
                    $risiko = "Kerusakan dapat bertambah parah apabila tidak segera diperbaiki.";
                    $level = "Sedang";

                    $statusBangunan = "Layak Ditempati dengan Pembatasan";
                    $prioritas = "Sedang";

                    break;

                case 1:

                    $status = "Rusak Berat";
                    $level = "Tinggi";

                    switch ($field) {

                        case 'pondasi':

                            $rekomendasi = "Segera lakukan rehabilitasi pondasi.";
                            $risiko = "Bangunan berpotensi mengalami kegagalan struktur.";

                            $statusBangunan = "Tidak Layak Ditempati";

                            break;

                        case 'struktur':

                            $rekomendasi = "Segera lakukan rehabilitasi struktur utama.";
                            $risiko = "Bangunan berpotensi roboh.";

                            $statusBangunan = "Tidak Layak Ditempati";

                            break;

                        case 'atap':

                            $rekomendasi = "Segera lakukan penggantian atau perbaikan total atap.";
                            $risiko = "Material atap dapat jatuh dan membahayakan penghuni.";

                            break;

                        case 'plafon':

                            $rekomendasi = "Segera lakukan penggantian plafon.";
                            $risiko = "Material plafon dapat jatuh sewaktu-waktu.";

                            break;

                        case 'listrik':

                            $rekomendasi = "Perbaiki instalasi listrik sebelum digunakan.";
                            $risiko = "Berpotensi terjadi korsleting atau kebakaran.";

                            break;

                        default:

                            $rekomendasi = "Segera lakukan penggantian komponen.";
                            $risiko = "Komponen tidak aman digunakan.";

                    }

                    $prioritas = "Tinggi";

                    break;

            }

            $recommendations[] = [

                'komponen' => $nama,
                'nilai' => $nilai,
                'status' => $status,
                'rekomendasi' => $rekomendasi,
                'risiko' => $risiko,
                'prioritas' => $level

            ];

        }

        return [

            'status_bangunan' => $statusBangunan,
            'prioritas' => $prioritas,
            'items' => $recommendations

        ];
    }
}