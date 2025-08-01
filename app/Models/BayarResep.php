<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BayarResep extends Model
{
    use HasFactory;

    protected $table = 'detail_bayar_resep';

    protected $guarded = ['id'];


    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'resep', 'id');
    }

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
