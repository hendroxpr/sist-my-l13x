<?php

namespace Modules\Sips01\Imports; 
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Modules\Sips01\Models\Datasiswa;
use Modules\Sips01\Models\Memnilai;

class MemnilaiImport implements ToModel, WithStartRow
{
    
    public function startRow(): int
    {
        return 6;
    }

    // Tentukan berapa baris yang diproses per chunk
    public function model(array $row)
    {
        //cari iddatasiswa
        $nisn = $row[1];
        $nis = $row[2];

        $iddatasiswa = Datasiswa::select('id')->where('nis', '=', $nis)
            ->orWhere('nisn', '=', $nisn)
            ->value('id');
        $angka = intval($row[4]);
        if($angka=='0'){
            $hitung = 0;
        }else{
            $hitung = 1;
        }

        return new Memnilai ([
            'nisn' => $row[1],
            'nis' => $row[2],
            'namalengkap' => trim(mb_substr($row[3], 0, 200,"UTF-8")),
            'iddatasiswa' => $iddatasiswa,
            // 'idtp' => $$request['idtp1'], langsung dari blade
            // 'idmapel' => $$request['idmapel1'], langsung dari blade
            // 'smt' => $$request['semester1'], langsung dari blade
            'nilai' => trim(mb_substr($row[4], 0, 3,"UTF-8")),
            'kkm' => trim(mb_substr($row[5], 0, 3,"UTF-8")),
            'keterangan' => $row[6],
            'hitung' => $hitung,

        ]);
    }
    // public function batchSize(): int
    // {
    //     return 1000;
    // }
    
}