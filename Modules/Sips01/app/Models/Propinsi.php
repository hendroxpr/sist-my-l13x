<?php

namespace Modules\Sips01\Models;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Modules\Sips01\Database\Factories\PropinsiFactory;

#[Connection('mysql_03')]
#[Table(
    name: 'propinsi', 
    key: 'id', 
    keyType: 'int', 
    incrementing: false,
)]
#[Guarded([])] 
#[WithoutTimestamps]

class Propinsi extends Model
{
    use HasFactory;

    public function kabupaten()
    {
        return $this->hasMany(Kabupaten::class,'idpropinsi','id');
    }
    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];

    // protected static function newFactory(): PropinsiFactory
    // {
    //     // return PropinsiFactory::new();
    // }
}
