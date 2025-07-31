<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class TerimaKtg extends Model
{
    use HasFactory;

    protected $table = 'terimaktg';

    // protected $fillable = ['code'];
    protected $fillable = [ 
        'nokntng',
        'notrans',
        'nominta',
        'jnskntng',
        'ukuran',
        'ukktg',
        'merkktg',
        'jmlkirimgd',
        'jmlterima',
        'tglterima',
        'status',
        'type_stok',
        'realpermintaan',

       


    ];
    protected $guarded = ['id'];
    // public $timestamps = false;

     public function KtgOrd(): BelongsTo
    {
         return $this->hasMany(KtgOrd::class);
    }

//         public function TerimaKtg()
// {
//     return $this->hasMany(TerimaKtg::class,'nominta');
// }
}
