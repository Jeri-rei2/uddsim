<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tujuanrs extends Model
{
    use HasFactory;

    protected $table = 'masterrs';

    protected $fillable = [ 
        'id',
        'kdcab',
        'kdrs',
        'nmrs',
        'jnsrs',
        'klsrs',
        'almt1',
        'almt2',
        'tlp',
        'kdpos',
        'kdptgs',
        'nmjnsbiaya',
        'kdcat',
        'bankdarah',
        'kdwil',
        'tanda_biaya',
        


       
    ];
    // protected $guarded = ['id'];

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
