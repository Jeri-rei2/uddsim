<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    use HasFactory;


    protected $table = 'kelompok';

    protected $fillable = [
        'id',
        'kodekelompok',
        'NamaKelompok'
    ];

    public function getRouteKeyName() {
        return 'id';
    }
}
