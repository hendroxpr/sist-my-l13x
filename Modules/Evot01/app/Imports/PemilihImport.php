<?php

namespace Modules\Evot01\Imports; 
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Modules\Evot01\Models\Pemilih;

class PemilihImport implements ToModel, WithStartRow
{
    
    public function startRow(): int
    {
        return 3;
    }

    // Tentukan berapa baris yang diproses per chunk
    public function model(array $row)
    {
        return new Pemilih ([
            'kelas' => $row[0],
            'nama' => $row[1],
            'users' => $row[2],
            'passwords' => $row[3],
        ]);
    }
    // public function batchSize(): int
    // {
    //     return 1000;
    // }
    
}