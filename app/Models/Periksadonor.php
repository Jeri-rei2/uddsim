<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Periksadonor extends Model
{
    use HasFactory;

    protected $table = 'priksadokter';

    protected $fillable = [ 
        'kdcab',
        'noaftap',
        'tgldaftar',
        'tglperiksa',
        'tglhema',
        'tglaftap',
        'nodonor',
        'namadonor',
        'tgllahir',
        'umur',
        'nokantong',
        'almt',
        'jnsdnr',
        'nofpup',
        'kdasldrh',
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
        'tgbdn',
        'klmpkbrt',
        'suhu',
        'ecg',
        'tolak',
        'alsntlk',
        'ccambil',
        'jnsktg',
        'typektg',
        'ketperiksa',
        'donorke',
        'status',
        // 'statperiksa',
       
    ];
    protected $guarded = ['id'];

    public function quesioner()
    {
      return $this->belongsTo(Quesioner::class);
    }
    
    public function donor() {
        //  return $this->hasOne(Donor::class)->latestOfMany();
      return $this->belongsTo(Donor::class,'nodonor','noaftap','id');
      // return $this->hasMany(Donor::class, 'nodonor','id','photo');
    }
    public function Aturansatelit() {
        //  return $this->hasOne(Donor::class)->latestOfMany();
      return $this->belongsTo(Aturansatelit::class,'typektg','id');
    }
   public function Aturanberat() {
        //  return $this->hasOne(Donor::class)->latestOfMany();
      return $this->belongsTo(Aturanberat::class,'kelompokberat','id');
    }
    public function Aturanumur() {
        //  return $this->hasOne(Donor::class)->latestOfMany();
      return $this->belongsTo(Aturanumur::class,'kelompokumur','id');
    }

    
    public function periksahb()
    {
      return $this->hasMany(Periksahb::class, 'nodonor','id');

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
