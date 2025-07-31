<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;


    protected $table = 'permintaan';

    protected $fillable = [
        'nopermintaan',
        'nopengiriman',
        'tglminta',
        'tujuan',
        'nostok',
        'nokantong',
        'jnsdarah',
        'gol',
        'rhesus',
        'tglaftap',
        'tglexp',
    ];

    public function pengiriman()
{
    return $this->hasMany(Pengiriman::class,  'nopermintaan', 'id','idpengiriman');
}

    public function getRouteKeyName() {
        return 'id';
    }
}
