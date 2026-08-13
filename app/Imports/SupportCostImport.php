<?php

namespace App\Imports;

use App\Models\SupportCost;


class SupportCostImport
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
                        "Kode biaya kosong"
                    );

                }



                if(SupportCost::where('kode',$row[0])->exists()){

                    throw new \Exception(
                        "Kode biaya sudah ada"
                    );

                }




                SupportCost::create([

                    'kode'=>$row[0],

                    'nama_biaya'=>$row[1],

                    'kategori'=>$row[2],

                    'harga_satuan'=>$row[3],

                    'keterangan'=>$row[4] ?? null,

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