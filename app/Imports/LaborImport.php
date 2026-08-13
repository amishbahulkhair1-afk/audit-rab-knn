<?php

namespace App\Imports;

use App\Models\Labor;


class LaborImport
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
                        "Kode tenaga kerja kosong"
                    );

                }



                if(Labor::where('kode',$row[0])->exists()){

                    throw new \Exception(
                        "Kode tenaga kerja sudah ada"
                    );

                }



                Labor::create([

                    'kode'=>$row[0],

                    'nama_pekerja'=>$row[1],

                    'upah_harian'=>$row[2],

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