<?php

namespace Modules\Sips01\Models;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Modules\Sips01\Database\Factories\KelasFactory;

#[Connection('mysql_03')]
#[Table(
    name: 'kelas', 
    key: 'id', 
    keyType: 'int', 
    incrementing: false,
)]
#[Guarded([])] 
#[WithoutTimestamps]

class Kelas extends Model
{
    use HasFactory;

    public function tingkat()
    {
        return $this->belongsTo(Tingkat::class,'idtingkat');
    }
    public function kompetensi()
    {
        return $this->belongsTo(Kompetensi::class,'idkompetensi');
    }

    public function walikelas()
    {
        return $this->hasMany(Walikelas::class,'idkelas','id');
    }

    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];

    // protected static function newFactory(): KelasFactory
    // {
    //     // return KelasFactory::new();
    // }
}
