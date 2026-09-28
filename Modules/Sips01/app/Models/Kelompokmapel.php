<?php

namespace Modules\Sips01\Models;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Modules\Sips01\Database\Factories\AgamaFactory;

#[Connection('mysql_03')]
#[Table(
    name: 'kelompokmapel', 
    key: 'id', 
    keyType: 'int', 
    incrementing: false,
)]
#[Guarded([])] 
#[WithoutTimestamps]

class Kelompokmapel extends Model
{
    use HasFactory;

    public function mapel()
    {
        return $this->hasMany(Mapel::class,'idkelompokmapel','id');
    }
    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];

    // protected static function newFactory(): AgamaFactory
    // {
    //     // return AgamaFactory::new();
    // }
}
