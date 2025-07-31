<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Donor extends Model
{
    use HasFactory;

    protected $table = 'donor';

    protected $fillable = [ 
        'kdcab' ,
        'nodonor' ,
        'noaftp',
        'namadonor' ,
        'alamat' ,
        'kodepos' ,
        'jk' ,
        'photo',
        'kdnegr' ,
        'tgllahir' ,
        'usia' ,
        'kelurahan' ,
        'kecamatan' ,
        'nmwil' ,
        'nmpkrj' ,
        'agama' ,
        'tlp' ,
        'noktp' ,
        'nosim' ,
        'tgldaftar' ,
        'donorke' ,
        'mtdpeng' ,
       
    ];
    protected $guarded = ['id'];
    public function age()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }
      public function AftpTrnsDnr() {
        return $this->belongsTo(AftpTrnsDnr::class, 'nodonor', 'noaftp');
    }
    public function Periksahb() {
        return $this->belongsTo(PeriksaHb::class, 'nodonor');
    }
    public function Periksadonor() {
        return $this->belongsTo(Periksadonor::class,'nodonor','noaftap','id');
    }
     public function Aturansatelit()
  {
    return $this->belongsTo(Aturansatelit::class, 'typektg','id');
  }
    public function kelompok(): BelongsTo
    {
        return $this->belongsTo(Kelompok::class, 'kodekelompok', 'id');
    }
    public function pekerjaan(): BelongsTo
    {
        return $this->belongsTo(Pekerjaan::class, 'kdcab', 'id');
    }

    public function cabang(): BelongsTo
    {
        return $this->belongsTo(Cabang::class, 'kdcab', 'id');
    }
    // public function pekerjaan(): BelongsTo
    // {
    //     return $this->belongsTo(Pekerjaan::class, 'kdcab', 'id');
    // }

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
