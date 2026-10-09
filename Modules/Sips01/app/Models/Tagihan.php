<?php

namespace Modules\Sips01\Models;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Modules\Sips01\Database\Factories\TagihanFactory;

#[Connection('mysql_03')]
#[Table(
    name: 'tagihan', 
    key: 'id', 
    keyType: 'int', 
    incrementing: false,
)]
#[Guarded([])] 
#[WithoutTimestamps]
class Tagihan extends Model
{
    use HasFactory;
    public function datasiswa()
    {
        return $this->belongsTo(Datasiswa::class,'iddatasiswa');
    }
    public function jenistagihan()
    {
        return $this->belongsTo(Jenistagihan::class,'idjenistagihan');
    }
    public function bulan()
    {
        return $this->belongsTo(Bulan::class,'idbulan');
    }
    public function tp()
    {
        return $this->belongsTo(Tp::class,'idtp');
    }
    public function dataguru()
    {
        return $this->belongsTo(Dataguru::class,'iddataguru');
    }
    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];

    // protected static function newFactory(): TagihanFactory
    // {
    //     // return TagihanFactory::new();
    // }
}
