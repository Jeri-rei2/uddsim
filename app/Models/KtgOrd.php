<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class KtgOrd extends Model
{
    use HasFactory;

    protected $table = 'ktgkirim';

    // protected $fillable = ['code'];
    protected $fillable = [ 
        'notrans',
        'nopermintaan',
        'nokntng',
        'tgltrans',
        'total',
        'ket',
        'kdptgs',
        'perk',
        'status',



    ];
    protected $guarded = ['id'];
    // public $timestamps = false;
    

    public function TempOrd()
{
    return $this->hasMany(TempOrd::class);
}

    public function TerimaKtg()
{
    return $this->belongsTo(TerimaKtg::class);
}


}
