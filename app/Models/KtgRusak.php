<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class KtgRusak extends Model
{
    use HasFactory;

    protected $table = 'ktgrusakaftap';

    // protected $fillable = ['code'];
    protected $fillable = [ 
        'notrans',
        'nokntng',
        'tgltrans',
        'jml',
        'ket',
        'kdptgs',
        'perk',
        'merk',
        'jnsktg',
        'ukktg',
        'xx',
        'alasan_rusak',



    ];
    protected $guarded = ['id'];
    // public $timestamps = false;
    

    public function Kantong()
{
    return $this->hasMany(Kantong::class);
}

    public function TerimaKtg()
{
    return $this->belongsTo(TerimaKtg::class);
}


}
