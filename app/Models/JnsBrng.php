<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JnsBrng extends Model
{
    use HasFactory;

    protected $table = 'mjnsbarang';
    protected $guarded = ['id'];
    
    protected $fillable = [
        'id',
        'nmbarang',
    
    ];

    public function getRouteKeyName() {
        return 'id';
    }
    // public function kategori(): BelongsTo
    // {
    //     return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    // }

    // public function detailOrders(): HasMany
    // {
    //     return $this->hasMany(DetailOrder::class, 'barang_id', 'id');
    // }

    // public function stocks(): HasMany
    // {
    //     return $this->hasMany(Stock::class, 'barang_id', 'id');
    // }

 

    // public static function latest($column = 'created_at')
    // {
    //     self->query()->orderBy($column, 'desc');
    // }
}
