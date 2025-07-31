<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [ 
        'id',
        'kdbrg',
        'nmbrg',
        'brdreagen',
        'satuanbsr',
        'satuankcl',
        'hrsat',
        'stok',
        'stokmin','stokawal','jnsbrg','stoktambah','ukuran','jnskantong','kodekelompok'
        
    ];
    // protected $guarded = ['id'];

    public function kelompok(): BelongsTo
    {
        return $this->belongsTo(Kelompok::class, 'kodekelompok', 'id');
    }

    // public function detailOrders(): HasMany
    // {
    //     return $this->hasMany(DetailOrder::class, 'barang_id', 'id');
    // }

    // public function stocks(): HasMany
    // {
    //     return $this->hasMany(Stock::class, 'barang_id', 'id');
    // }

    public function getRouteKeyName()
    {
        return 'id';
    }

    
}
