<?php

namespace Modules\Sips01\Models;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Modules\Sips01\Database\Factories\MagangFactory;

#[Connection('mysql_03')]
#[Table(
    name: 'magang', 
    key: 'id', 
    keyType: 'int', 
    incrementing: false,
)]
#[Guarded([])] 
#[WithoutTimestamps] 

class Magang extends Model
{
    use HasFactory;

    public function datasiswa()
    {
        return $this->belongsTo(Datasiswa::class,'iddatasiswa');
    }
    public function dudi()
    {
        return $this->belongsTo(Dudi::class,'iddudi');
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
