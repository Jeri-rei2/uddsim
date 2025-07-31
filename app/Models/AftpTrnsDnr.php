<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AftpTrnsDnr extends Model
{
    use HasFactory;

    protected $table = 'aftpTrnsDnr';

    protected $fillable = [ 
        // 'id',
        'kdcab',
        'nodonor',
        'noaftap',
        'tgldaftar',
        'tglperiksa',
        'tglhema',
        'tglaftap',
        'namadonor',
        'goldar',
        'rhesus',
        'tgllahir',
        'umur',
        'kelompokumur',
        'nokntng',
        'hitung',
        'almsrt',
        'wil',
        'jnsdnr',
        'nofpup',
        'namaos',
        'nmcab',
        'kdptghb',
        'nmhb',
        'kdptglab',
        'nmptglab',
        'kdptgdr',
        'nmptgdr',
        'kdptgsaftp',
        'ptgsaftp',
        'tensi',
        'nadi',
        'brtbdn',
        'kelompokbrat',
        'suhu',
        'ecg',
        'tolak',
        'alsntlk',
        'ccamb',
        'jnsktg',
        'ketperiksa',
        'metodehb',
        'hasilhb',
        'trombosit',
        'ht',
        'leokosit',
        'eritrosit',
        'ccstop',
        'reaksiambil',
        'reaksidnr',
        'reaksilain',
        'surat',
        'puasa',
        'waktu',
        'ktgpenuh',
        'disinfeksi',
        'penggoyangan',
        'sampledrh',
        'penyerutan',
        'sealer',
        'catatan',
        'ktgdarah',
        'donorke',
        'status',
        'durasi',

       

       
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
