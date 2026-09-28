<?php

namespace Modules\Sips01\Models;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Sips01\Database\Factories\TpFactory;

#[Connection('mysql_03')]
#[Table(
    name: 'tp', 
    key: 'id', 
    keyType: 'int', 
    incrementing: false,
)]
#[Guarded([])] 
#[WithoutTimestamps] 

class Tp extends Model
{
    use HasFactory;

    public function bulan()
    {
        return $this->hasMany(Bulan::class,'idtp','id');
    }

    public function walikelas()
    {
        return $this->hasMany(Walikelas::class,'idtp','id');
    }

    /**
     * The attributes that are mass assignable.
     */

    // protected $connection = 'mysql_3';
    // protected $table = 'tp';
    // protected $fillable = [];
    // protected $primaryKey = ['id'];
    // protected $guarded = [];
    // public $timestamps = false;
    // public $incrementing = false;

    // protected static function newFactory(): TpFactory
    // {
    //     // return TpFactory::new();
    // }
}
