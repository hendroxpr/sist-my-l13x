<?php

namespace Modules\Sips01\Models;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Modules\Sips01\Database\Factories\WalikelasFactory;

#[Connection('mysql_03')]
#[Table(
    name: 'walikelas', 
    key: 'id', 
    keyType: 'int', 
    incrementing: false,
)]
#[Guarded([])] 
#[WithoutTimestamps]

class Walikelas extends Model
{
    use HasFactory;

    public function tp()
    {
        return $this->belongsTo(Tp::class,'idtp');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class,'idkelas');
    }
    public function dataguru()
    {
        return $this->belongsTo(Dataguru::class,'iddataguru');
    }

    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];

    // protected static function newFactory(): WalikelasFactory
    // {
    //     // return WalikelasFactory::new();
    // }
}
