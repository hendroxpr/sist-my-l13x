<?php

namespace Modules\Sips01\Imports; 
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Modules\Sips01\Models\Datasiswa;
use Modules\Sips01\Models\MemAbsensi;

class MemabsensiImport implements ToModel, WithStartRow
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
        $x = strtoupper(trim(mb_substr($row[7], 0, 1,"UTF-8")));
        if($x=='Y'){
            $status='Y';
        }else{
            $status='T';
        }

        return new MemAbsensi ([
            'nisn' => $row[1],
            'nis' => $row[2],
            'namalengkap' => trim(mb_substr($row[3], 0, 200,"UTF-8")),
            'iddatasiswa' => $iddatasiswa,
            // 'idtp' => $$request['idtp1'], langsung dari blade
            // 'smt' => $$request['semester1'], langsung dari blade
            'sakit' => intval($row[4]),
            'izin' => intval($row[5]),
            'alpa' => intval($row[6]),
            'status' => $status,
            'kelas' => strtoupper(trim(mb_substr($row[8], 0, 5,"UTF-8"))),

        ]);
    }
    // public function batchSize(): int
    // {
    //     return 1000;
    // }
    
}