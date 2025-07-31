<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class PeriksaUlangGD extends Model
{
    use HasFactory;

    protected $table = 'LBstGolDarahH';

    protected $fillable = [ 
        'Noperiksa',
        'Tglperiksa',
        'ckdptgs',
        'perk',
        'status',
        'lastupdate',
        'kdcab',


       
        
       
    ];
    protected $guarded = ['id'];

    
    // public function donor() {
    //     //  return $this->hasOne(Donor::class)->latestOfMany();
    //   return $this->hasMany(Donor::class, 'nodonor','id');
    // }
  
   
    // public function cabang(): BelongsTo
    // {
    //     return $this->belongsTo(Cabang::class, 'kdcab', 'id');
    // }
  
    // public function getRouteKeyName()
    // {
    //     return 'id';
    // }

    
}
