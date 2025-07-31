<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengeluaraanKtgMu extends Model
{
    use HasFactory;


    protected $table = 'detailpengeluaranktgaftp';

    protected $fillable = [
        'id',
        'nopengeluaran',
        'merk',
        'ukktg',
        'jnsktg',
        'noktg',
        'status',
        'jml_ktg',
        'type_stok',
        'stokaftap',
        'realstokaftap'

    ];


      public function PengeluaraanKtgMu(): BelongsTo
    {
        return $this->belongsTo(PengeluaraanKtgMu::class, 'nopengeluaran', 'id');
    }

    public function getRouteKeyName() {
        return 'id';
    }
}
