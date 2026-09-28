<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Connection;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Connection('mysql_01')]
#[Table(
    name: 'submenu', 
    key: 'id', 
    keyType: 'int', 
    incrementing: false,
)]
#[Guarded([])] 
#[WithoutTimestamps]

class Menusub extends Model
{
    use HasFactory;
    public function menuutama()
    {
        return $this->belongsTo(Menuutama::class,'idmainmenu');
    }

    public function aplikasi()
    {
        return $this->belongsTo(Aplikasi::class,'idaplikasi');
    }
    
}
