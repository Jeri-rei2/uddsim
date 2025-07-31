<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kewarganegaraan extends Model
{
    use HasFactory;

    protected $table = 'kewarganegaraan';

    protected $fillable = [ 
        'id',
        'kdcab',
        'nmnegr',
        'kdnegr',
        'kdptgs'
    ];
    // protected $guarded = ['id'];

    // public function kelompok(): BelongsTo
    // {
    //     return $this->belongsTo(Kelompok::class, 'kodekelompok', 'id');
    // }
    public function cabang(): BelongsTo
    {
        return $this->belongsTo(Cabang::class, 'kdcab', 'id');
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
