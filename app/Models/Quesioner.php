<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Quesioner extends Model
{
    use HasFactory;

    protected $table = 'quesdnr';

    protected $fillable = [ 
        'kdcab',
        'id_donor',
        'nodonor',
        'noaftp',
        'tglperiksa',
        'sehat',     
        'sakit',
        'diabet',
        'ginjal',
        'radang',
        'jantung',
        'hemofilia',
        'asma',
        'tbc',
        'kenjang',
        'hiv',
        'hepatitis',
        'sifilis',
        'malaria',
        'luarngri',
        'hasilpriksa',
        'orglain',
        'bln',
        'hamil',
        'mens',
        
       
    ];
    protected $guarded = ['id'];

    public function donor()
    {
      return $this->hasMany(Donor::class,'id');
    }
    public function periksadonor()
    {
      return $this->hasMany(Periksadonor::class, 'nodonor','id_donor');
    }
}
