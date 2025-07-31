<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class LBSgGoldarH extends Model
{
    use HasFactory;

    protected $table = 'LBstGolDarahH';

    // protected $fillable = ['code'];
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
    // public $timestamps = false;

     public function LBSgGoldar(): BelongsTo
    {
         return $this->belongsTo(LBSgGoldar::class, 'Noperiksa',);
    }
    
}
