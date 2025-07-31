<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';

    protected $guarded = ['id'];

    public function barang(): HasMany
    {
        return $this->hasMany(Barang::class, 'id', 'barang_id');
    }

}
