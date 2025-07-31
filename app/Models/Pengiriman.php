<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengiriman';

    protected $fillable = [ 
        'id',
        'idpermintaan',
        'nokeluar',
        'nopermintaan',
        'tglpermintaan',
        'tglkeluar',
        
        'pengirim',
        
    ];
    // protected $guarded = ['id'];

    public function permintaan(): BelongsTo
    {
        return $this->belongsTo(Permintaan::class, 'nopermintaan', 'id','idpermintaan');
    }

    public function cabang(): HasMany
    {
        return $this->hasMany(Cabang::class, 'kdcab', 'id');
    }

    // public function stocks(): HasMany
    // {
    //     return $this->hasMany(Stock::class, 'barang_id', 'id');
    // }

    public function getRouteKeyName()
    {
        return 'id';
    }

    
}
