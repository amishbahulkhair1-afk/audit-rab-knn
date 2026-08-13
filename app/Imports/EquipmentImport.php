<?php

namespace App\Imports;

use App\Models\Equipment;


class EquipmentImport
{

    public function import(array $rows):array
    {

        $success=0;
        $errors=[];


        foreach(array_slice($rows,1) as $index=>$row){


            $baris=$index+2;


            try{


                if(empty($row[0])){

                    throw new \Exception(
                        "Kode alat kosong"
                    );

                }


                if(Equipment::where('kode',$row[0])->exists()){

                    throw new \Exception(
                        "Kode alat sudah ada"
                    );

                }



                Equipment::create([

                    'kode'=>$row[0],

                    'nama_alat'=>$row[1],

                    'satuan'=>$row[2],

                    'harga_satuan'=>$row[3],

                ]);


                $success++;


            }catch(\Exception $e){


                $errors[]=[

                    'baris'=>$baris,

                    'pesan'=>$e->getMessage()

                ];

            }

        }


        return [

            'success'=>$success,

            'errors'=>$errors

        ];

    }

}