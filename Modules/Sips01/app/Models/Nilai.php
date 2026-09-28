<?php

namespace Modules\Sips01\Models;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Modules\Sips01\Database\Factories\NilaiFactory;

#[Connection('mysql_03')]
#[Table(
    name: 'nilai', 
    key: 'id', 
    keyType: 'int', 
    incrementing: false,
)]
#[Guarded([])] 
#[WithoutTimestamps] 

class Nilai extends Model
{
    use HasFactory;

    public function datasiswa()
    {
        return $this->belongsTo(Datasiswa::class,'iddatasiswa');
    }
    public function tp()
    {
        return $this->belongsTo(Tp::class,'idtp');
    }
    public function mapel()
    {
        return $this->belongsTo(Mapel::class,'idmapel');
    }

    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];

    // protected static function newFactory(): KabupatenFactory
    // {
    //     // return KabupatenFactory::new();
    // }
}
