<?php

namespace Modules\Sips01\Models;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Modules\Sips01\Database\Factories\SiswakelasFactory;

#[Connection('mysql_03')]
#[Table(
    name: 'siswakelas', 
    key: 'id', 
    keyType: 'int', 
    incrementing: false,
)]
#[Guarded([])] 
#[WithoutTimestamps]
class Siswakelas extends Model
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
    public function kelas()
    {
        return $this->belongsTo(Kelas::class,'idkelas');
    }
    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];

    // protected static function newFactory(): SiswakelasFactory
    // {
    //     // return SiswakelasFactory::new();
    // }
}
