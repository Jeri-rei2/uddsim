<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaraanKtgMu extends Model
{
    use HasFactory;


    protected $table = 'pengeluaranktgaftp';

    protected $fillable = [
        'id',
        'nopengeluaran',
        'tglpengeluaran',
        'ckdptgs',
        'kdasldrh',
        'kdmobil',
        'kodenotebook',
        'petugas',
        'uploadstamp',

    ];
  public function DetailPengeluaraanKtgMu() {
        //  return $this->hasOne(Donor::class)->latestOfMany();
      return $this->hasMany(DetailPengeluaraanKtgMu::class, 'nopengeluaran','id');
    }


    public function getRouteKeyName() {
        return 'id';
    }
}
