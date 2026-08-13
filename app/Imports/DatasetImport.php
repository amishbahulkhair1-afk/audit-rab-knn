<?php

namespace App\Imports;

use App\Models\DataSet;

class DatasetImport
{
    public function import(array $rows): array
    {
        $success = 0;
        $errors = [];

        foreach (array_slice($rows, 1) as $index => $row) {

            $baris = $index + 2;

            try {

                if (empty($row[0])) {
                    throw new \Exception('Kode data kosong');
                }

                if (empty($row[1])) {
                    throw new \Exception('Nama bangunan kosong');
                }

                if (DataSet::where('kode_data', $row[0])->exists()) {
                    throw new \Exception('Kode data sudah ada');
                }

                // Validasi nilai KNN
                for ($i = 3; $i <= 12; $i++) {

                    if (
                        $row[$i] === null ||
                        $row[$i] === '' ||
                        !is_numeric($row[$i]) ||
                        $row[$i] < 1 ||
                        $row[$i] > 5
                    ) {
                        throw new \Exception(
                            'Nilai kondisi harus berupa angka 1 sampai 5'
                        );
                    }
                }

                if (empty($row[14])) {
                    throw new \Exception('Kategori kosong');
                }

                DataSet::create([

                    'kode_data' => $row[0],

                    'nama_bangunan' => $row[1],

                    'jenis_konstruksi' => $row[2] ?? null,

                    'pondasi' => $row[3],

                    'struktur' => $row[4],

                    'atap' => $row[5],

                    'dinding' => $row[6],

                    'lantai' => $row[7],

                    'plafon' => $row[8],

                    'pintu' => $row[9],

                    'jendela' => $row[10],

                    'listrik' => $row[11],

                    'sanitasi' => $row[12],

                    'keterangan' => $row[13] ?? null,

                    'kategori' => $row[14],

                ]);

                $success++;

            } catch (\Exception $e) {

                $errors[] = [
                    'baris' => $baris,
                    'pesan' => $e->getMessage(),
                ];
            }
        }

        return [
            'success' => $success,
            'errors' => $errors,
        ];
    }
}