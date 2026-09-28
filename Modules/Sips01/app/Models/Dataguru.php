<?php

namespace Modules\Sips01\Models;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Modules\Sips01\Database\Factories\DataguruFactory;

#[Connection('mysql_03')]
#[Table(
    name: 'dataguru', 
    key: 'id', 
    keyType: 'int', 
    incrementing: false,
)]
#[Guarded([])] 
#[WithoutTimestamps]

class Dataguru extends Model
{
    use HasFactory;

    public function tempatlahir()
    {
        return $this->belongsTo(Kabupaten::class,'idkabupaten');
    }
    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class,'idpendidikan');
    }
    public function statuspegawai()
    {
        return $this->belongsTo(Statuspegawai::class,'idstatuspegawai');
    }
    public function jk()
    {
        return $this->belongsTo(Jk::class,'idjk');
    }
    public function agama()
    {
        return $this->belongsTo(Agama::class,'idagama');
    }
    public function pangkat()
    {
        return $this->belongsTo(Pangkat::class,'idpangkat');
    }
    public function statusprofesi()
    {
        return $this->belongsTo(Statusprofesi::class,'idstatusprofesi');
    }
    
    public function kompetensi()
    {
        return $this->hasMany(Kompetensi::class,'iddataguru','id');
    }

    public function walikelas()
    {
        return $this->hasMany(Walikelas::class,'iddataguru','id');
    }
    
    
    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];

    // protected static function newFactory(): DataguruFactory
    // {
    //     // return DataguruFactory::new();
    // }
}
