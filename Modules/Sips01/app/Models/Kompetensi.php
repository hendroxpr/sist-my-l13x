<?php

namespace Modules\Sips01\Models;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Modules\Sips01\Database\Factories\KompetensiFactory;

#[Connection('mysql_03')]
#[Table(
    name: 'kompetensi', 
    key: 'id', 
    keyType: 'int', 
    incrementing: false,
)]
#[Guarded([])] 
#[WithoutTimestamps]

class Kompetensi extends Model
{
    use HasFactory;

    public function program()
    {
        return $this->belongsTo(Program::class,'idprogram');
    }
    public function dataguru()
    {
        return $this->belongsTo(Dataguru::class,'iddataguru');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class,'idkompetensi','id');
    }
    
    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];

    // protected static function newFactory(): KompetensiFactory
    // {
    //     // return KompetensiFactory::new();
    // }
}
