<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'masterobat';

    protected $guarded = ['id','kode_brng'];
    protected $fillable = [

        'kode_golongan'

    ];
    public function resep(): BelongsTo
    {
        return $this->belongsTo(Resep::class, 'user_id', 'id');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }

    public function detailOrders(): HasMany
    {
        return $this->hasMany(DetailOrder::class, 'barang_id', 'id');
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class, 'barang_id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // public static function latest($column = 'created_at')
    // {
    //     self->query()->orderBy($column, 'desc');
    // }
}
