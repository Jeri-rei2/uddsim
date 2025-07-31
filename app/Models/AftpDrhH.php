<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AftpDrhH extends Model
{
    use HasFactory;

    protected $table = 'aftpFpdrhH';

    protected $fillable = [ 
        'id',
        'kdcab',
        'nofpd',
        'tglfpd',
        'total',
        'ket',
        'xx',
        'ckdptgs',
        'type',
        'rcn',
        'suhu',
        'proseskirim',
        'nat',
        'id_logger',
        'id_coolbox',
        'ckdptgsperiksa',
     

       
    ];
    // protected $guarded = ['id'];

    public function Donor(): BelongsTo
    {
        return $this->hasMany(Donor::class, 'nodonor','noaftp', 'id');
    }
     public function Aturanumur(): BelongsTo
    {
        return $this->hasMany(Aturanumur::class,'kelompokumur', 'id');
    }
  public function Periksadonor() {
        return $this->belongsTo(Periksadonor::class,'nodonor','noaftp','id');
    }
public function AftpDrhD()
    {
        return $this->hasMany(AftpDrhD::class, 'id','nofpd','nokntng'); // adjust FK if needed
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
