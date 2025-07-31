<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MPedonor extends Model
{
    use HasFactory;

    protected $table = 'kirimpedonorapi';

    protected $fillable = [ 
        'id',
        'nostock',
        'nodonor',
        'nokantong',
        'namadonor',
        'tgllahir',
        'agama',
        'jnskelamin',
        'noktp',
        'nosim',
        'alamat1',
        'alamat2',

     

       
    ];
    // protected $guarded = ['id'];

    public function cabang(): BelongsTo
    {
        return $this->belongsTo(Cabang::class, 'kdcab', 'id');
    }

 
    public function getRouteKeyName()
    {
        return 'id';
    }

    
}
