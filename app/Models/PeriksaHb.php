<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class PeriksaHb extends Model
{
    use HasFactory;

    protected $table = 'priksadonor';

    protected $fillable = [ 
        'kdcab',
        'noaftap',
        'tgldaftar',
        'tglperiksa',
        'tglhema',
        'tglaftap',
        'nodonor',
        'namadonor',
        'goldar',
        'rhesus',
        'tgllahir',
        'umur',
        'kelompokumur',
        'almsrt1',
        'almsrt2',
        'jnsdonor',
        'nofpup',
        'namaos',
        'ckdasldrh',
        'asaldrh',
        'kdptghb',
        'nmptghb',
        'kdptglab',
        'nmptglab',
        'kdptgdr',
        'nmptgdr',
        'kdptgaftp',
        'nmptgaftp',
        'tensi',
        'nadi',
        'brtbdn',
        'klmpkbrt',
        'suhu',
        'ecg',
        'tolak',
        'alsntlk',
        'ccambil',
        'jnsktg',
        'ketpriksa',
        'metodehb',
        'hasilhb',
        'trombosit',
        'ht',
        'leokosit',
        'eritrosit',
        'ccstop',
        'reakambil',
        'reakdonor',
        'reaklain',
        'surat',
        'puasa',
        'waktu',
        'ktgpenuh',
        'disinfeksi',
        'penggoyangan',
        'sampel',
        'penyerut',
        'sealer',
        'catatan',
        'ktgdarah',
        'donorke',
        'status',
        // 'statusperiksa',
        // 'stathema',
        // 'statkirim',
        // 'ckdptgs',
        // 'kode',
        // 'cekblntglthn',
        // 'bulan',
        // 'thn',
        // 'uploadstamp',
       
        
       
    ];
    protected $guarded = ['id'];

    
    public function donor() {
        //  return $this->hasOne(Donor::class)->latestOfMany();
      return $this->hasMany(Donor::class, 'nodonor','id');
    }
  
   
    public function cabang(): BelongsTo
    {
        return $this->belongsTo(Cabang::class, 'kdcab', 'id');
    }
  
    public function getRouteKeyName()
    {
        return 'id';
    }

    
}
