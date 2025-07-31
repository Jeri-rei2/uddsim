<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class LBSgGoldar extends Model
{
    use HasFactory;

    protected $table = 'LBstGolDarahD';

    // protected $fillable = ['code'];
    protected $fillable = [ 
        'Noperiksa',
        'NoKantong',
        'NoDonor',
        'GolDarah',
        'Rhesus',
        'GolDarah_LB',
        'Rhesus_LB',
        'status',
        'lastupdate',
        'GolDarah_LIS',
        'Rhesus_LIS',
        'Tgl_LIS',
        'Idx_LIS',
        'Mesin_LIS',
        'KDCab',
        'AslDrh',
        'flg',
        'nourut',
    



    ];
    protected $guarded = ['id'];
    // public $timestamps = false;

     public function AftpDrhD(): BelongsTo
    {
         return $this->belongsTo(KtgOrd::class, 'nokntng',);
    }
    
}
