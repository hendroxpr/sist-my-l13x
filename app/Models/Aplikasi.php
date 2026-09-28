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
    name: 'aplikasi', 
    key: 'id', 
    keyType: 'int', 
    incrementing: false,
)]
#[Guarded([])] 
#[WithoutTimestamps]

class Aplikasi extends Model
{
    use HasFactory;
    // protected $connection = 'mysql';
    // protected $table = 'users';
    // protected $primaryKey = 'id';

    // protected $guarded = [];
    // public $timestamps = false;
    // public $incrementing = false;
    
}
