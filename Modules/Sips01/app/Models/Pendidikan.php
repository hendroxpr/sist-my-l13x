<?php

namespace Modules\Sips01\Models;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use Modules\Sips01\Database\Factories\PendidikanFactory;

#[Connection('mysql_03')]
#[Table(
    name: 'pendidikan', 
    key: 'id', 
    keyType: 'int', 
    incrementing: false,
)]
#[Guarded([])] 
#[WithoutTimestamps]

class Pendidikan extends Model
{
    use HasFactory;

    public function dataguru()
    {
        return $this->hasMany(Dataguru::class,'idpendidikan','id');
    }
    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];

    // protected static function newFactory(): PendidikanFactory
    // {
    //     // return PendidikanFactory::new();
    // }
}
