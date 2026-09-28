<?php

namespace Modules\Sips01\Models;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Modules\Sips01\Database\Factories\KabupatenFactory;

#[Connection('mysql_03')]
#[Table(
    name: 'kabupaten', 
    key: 'id', 
    keyType: 'int', 
    incrementing: false,
)]
#[Guarded([])] 
#[WithoutTimestamps] 

class Kabupaten extends Model
{
    use HasFactory;

    public function propinsi()
    {
        return $this->belongsTo(propinsi::class,'idpropinsi');
    }

    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class,'idkabupaten','id');
    }
    
    public function dataguru()
    {
        return $this->hasMany(Dataguru::class,'idkabupaten','id');
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
