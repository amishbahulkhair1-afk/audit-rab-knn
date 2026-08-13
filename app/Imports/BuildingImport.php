<?php

namespace App\Imports;

use App\Models\Building;

class BuildingImport
{
    public function import(array $rows): array
    {
        $success = 0;
        $errors = [];

        foreach (array_slice($rows, 1) as $index => $row) {

            $baris = $index + 2;

            try {

                if (empty($row[0])) {
                    throw new \Exception("Kode bangunan kosong");
                }

                if (empty($row[1])) {
                    throw new \Exception("Nama bangunan kosong");
                }

                if (
                    Building::where('kode_bangunan', $row[0])->exists()
                ) {
                    throw new \Exception("Kode bangunan sudah ada");
                }

                Building::create([
                    'kode_bangunan' => $row[0],
                    'nama_bangunan' => $row[1],
                    'rayon' => $row[2] ?? null,
                    'alamat' => $row[3] ?? null,
                    'tahun_berdiri' => $row[4] ?: null,
                    'luas_bangunan' => $row[5] ?: null,
                    'jenis_bangunan' => $row[6] ?? null,
                    'jenis_konstruksi' => $row[7] ?? null,
                ]);

                $success++;

            } catch (\Exception $e) {

                $errors[] = [
                    'baris' => $baris,
                    'pesan' => $e->getMessage()
                ];

            }

        }

        return [
            'success'=>$success,
            'errors'=>$errors
        ];
    }
}