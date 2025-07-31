<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;


    protected $table = 'supplier';

    protected $fillable = [
        'id',
        'kodesupplier',
        'nama_supplier',
        'alamat',
        'telepon'
    ];

    public function getRouteKeyName() {
        return 'id';
    }
}
