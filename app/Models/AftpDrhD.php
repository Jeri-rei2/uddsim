<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AftpDrhD extends Model
{
    use HasFactory;

    protected $table = 'aftpFpdrhd';

    protected $fillable = [ 
            'id',
            'nofpd',
            'tglfpd',
            'urut',
            'nokntng',
            'jnskntng',
            'noaftap',
            'tglaftap',
            'nodonor',
            'namadonor',
            'ckdasldrh',
            'asldrh',
            'goldar',
            'rhesus',
            'tolak',
            'ket',
            'status',
            'tglsimpan',
            'ckdptgs',
            'kdcab',
            'xx',
            'perkiraan',
            'jnsdonor',
            'suhu',
            'id_logger',
            'id_coolbox',



     

       
    ];
    // protected $guarded = ['id'];
     public function AftpDrhH()
    {
        return $this->belongsTo(AftpDrhH::class, 'id','nofpd','nokntng'); // use actual foreign key column
    }
      public function Kantong()
    {
        return $this->belongsTo(Kantong::class, 'id','nokntng'); // use actual foreign key column
    }


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
