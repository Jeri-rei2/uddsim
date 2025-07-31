<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kantong extends Model
{
    use HasFactory;
    protected $table = 'kantong';
    protected $fillable = [
        'noterima',
        'nokntng',
        'mrkkntng',
        'jnskntng',
        'typekntng',
        'tglterima',
        'ukuran',
        'jmlcetak',
        'duplikat',
        'nolot',
        'nat',

    ];




    public function KtgRusak()
{
    return $this->belongsTo(KtgRusak::class);
}

    // protected $guarded = ['id'];

    // public function barang(): BelongsTo
    // {
    //     return $this->belongsTo(Barang::class, 'barang_id', 'id');
    // }

    // public function getRouteKeyName() {
    //     return 'id';
    // }
}
