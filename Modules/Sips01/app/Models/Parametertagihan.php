<?php

namespace Modules\Sips01\Models;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Modules\Sips01\Database\Factories\ParametertagihanFactory;

#[Connection('mysql_03')]
#[Table(
    name: 'parametertagihan', 
    key: 'id', 
    keyType: 'int', 
    incrementing: false,
)]
#[Guarded([])] 
#[WithoutTimestamps]
class Parametertagihan extends Model
{
    use HasFactory;

    public function tp()
    {
        return $this->belongsTo(Tp::class,'idtp');
    }
    
    public function jenistagihan()
    {
        return $this->belongsTo(Jenistagihan::class,'idjenistagihan');
    }

    public function dataguru()
    {
        return $this->belongsTo(Dataguru::class,'iddataguru');
    }
    public function tingkat()
    {
        return $this->belongsTo(Tingkat::class,'idtingkat');
    }
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): ParametertagihanFactory
    // {
    //     // return ParametertagihanFactory::new();
    // }
}
