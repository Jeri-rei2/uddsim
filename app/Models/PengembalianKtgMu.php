<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengembalianKtgMu extends Model
{
    use HasFactory;


    protected $table = 'pengembalianktgmu';

    protected $fillable = [
        'id',
         'nokembali',
        'noktg',
        'merk',
        'ukktg',
        'jnsktg',
        'status',
        'tglkembali',
        'type_stok',
        'stokaftap',
        'jml_kembali',

    ];
  public function DetailPengeluaraanKtgMu() {
        //  return $this->hasOne(Donor::class)->latestOfMany();
      return $this->hasMany(DetailPengeluaraanKtgMu::class, 'noktg','id');
    }


    public function getRouteKeyName() {
        return 'id';
    }
}
