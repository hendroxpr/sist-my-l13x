<?php

namespace Modules\Sips01\Models;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Modules\Sips01\Database\Factories\TingkatFactory;

#[Connection('mysql_03')]
#[Table(
    name: 'tingkat', 
    key: 'id', 
    keyType: 'int', 
    incrementing: false,
)]
#[Guarded([])] 
#[WithoutTimestamps]
class Tingkat extends Model
{
    use HasFactory;
    public function kelas()
    {
        return $this->hasMany(Kelas::class,'idtingkat','id');
    }
    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];

    // protected static function newFactory(): TingkatFactory
    // {
    //     // return TingkatFactory::new();
    // }
}
