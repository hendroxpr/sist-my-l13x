<?php

namespace Modules\Sips01\Models;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Modules\Sips01\Database\Factories\DatasiswaFactory;

#[Connection('mysql_03')]
#[Table(
    name: 'datasiswa', 
    key: 'id', 
    keyType: 'int', 
    incrementing: false,
)]
#[Guarded([])] 
#[WithoutTimestamps]
class Datasiswa extends Model
{
    use HasFactory;

    public function tpmasuk()
    {
        return $this->belongsTo(Tp::class,'idtpmasuk');
    }

    public function statussiswa()
    {
        return $this->belongsTo(Statussiswa::class,'idstatussiswa');
    }

    public function kompetensi()
    {
        return $this->belongsTo(Kompetensi::class,'idkompetensi');
    }

    public function tempatlahir()
    {
        return $this->belongsTo(Kabupaten::class,'idtempatlahir');
    }

    public function jk()
    {
        return $this->belongsTo(Jk::class,'idjk');
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class,'idagama');
    }

    public function statusanak()
    {
        return $this->belongsTo(Statusanak::class,'idstatusanak');
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class,'iddesa');
    }
    
    public function tinggal()
    {
        return $this->belongsTo(Tinggal::class,'idtinggal');
    }

    public function gd()
    {
        return $this->belongsTo(Gd::class,'idgd');
    }

    public function tempatlahirayah()
    {
        return $this->belongsTo(Kabupaten::class,'idtempatlahirayah');
    }

    public function agamaayah()
    {
        return $this->belongsTo(Agama::class,'idagamaayah');
    }
    
    public function pendidikanayah()
    {
        return $this->belongsTo(Pendidikan::class,'idpendidikanayah');
    }

    public function desaayah()
    {
        return $this->belongsTo(Desa::class,'iddesaayah');
    }

    public function tempatlahiribu()
    {
        return $this->belongsTo(Kabupaten::class,'idtempatlahiribu');
    }

    public function agamaibu()
    {
        return $this->belongsTo(Agama::class,'idagamaibu');
    }

    public function pendidikanibu()
    {
        return $this->belongsTo(Pendidikan::class,'idpendidikanibu');
    }

    public function desaibu()
    {
        return $this->belongsTo(Desa::class,'iddesaibu');
    }

    public function tempatlahirwali()
    {
        return $this->belongsTo(Kabupaten::class,'idtempatlahirwali');
    }

    public function agamawali()
    {
        return $this->belongsTo(Agama::class,'idagamawali');
    }

    public function pendidikanwali()
    {
        return $this->belongsTo(Pendidikan::class, 'idpendidikanwali');
    }
    
    public function desawali()
    {
        return $this->belongsTo(Desa::class,'iddesawali');
    }

    public function tpkeluar()
    {
        return $this->belongsTo(Tp::class,'idtpkeluar');
    }

    public function alasankeluar()
    {
        return $this->belongsTo(Alasankeluar::class,'idalasankeluar');
    }

    public function alasansetelahkeluar()
    {
        return $this->belongsTo(Alasansetelahkeluar::class,'idalasansetelahkeluar');
    }
    /**
     * The attributes that are mass assignable.
     */
    // protected $fillable = [];

    // protected static function newFactory(): DatasiswaFactory
    // {
    //     // return DatasiswaFactory::new();
    // }
}
