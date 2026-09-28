<?php

namespace Modules\Sips01\Models;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Modules\Sips01\Database\Factories\ProgramFactory;

#[Connection('mysql_03')]
#[Table(
    name: 'program', 
    key: 'id', 
    keyType: 'int', 
    incrementing: false,
)]
#[Guarded([])] 
#[WithoutTimestamps] 

class Program extends Model
{
    use HasFactory;
    public function bidang()
    {
        return $this->belongsTo(Bidang::class,'idbidang');
    }

    public function kompetensi()
    {
        return $this->hasMany(kompetensi::class,'idprogram','id');
    }
    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];

    // protected static function newFactory(): ProgramFactory
    // {
    //     // return ProgramFactory::new();
    // }
}
