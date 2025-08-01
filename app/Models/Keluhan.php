<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Keluhan extends Model
{
    use HasFactory;

    protected $table = 'keluhan';

    protected $guarded = ['id'];


    public function barang(): BelongsTo
    {
        return $this->belongsTo(DetailOrder::class, 'order_id', 'id');
    }

    public function pesanan(): BelongsTo
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'order_id';
    }
}
