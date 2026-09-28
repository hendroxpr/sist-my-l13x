<?php

namespace Modules\Sips01\Models;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Modules\Sips01\Database\Factories\SklFactory;

#[Connection('mysql_03')]
#[Table(
    name: 'skl', 
    key: 'id', 
    keyType: 'int', 
    incrementing: false,
)]
#[Guarded([])] 
#[WithoutTimestamps]
class Skl extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): SklFactory
    // {
    //     // return SklFactory::new();
    // }
}
