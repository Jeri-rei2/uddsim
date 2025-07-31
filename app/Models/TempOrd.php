<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class TempOrd extends Model
{
    use HasFactory;

    protected $table = 'tempord';

    // protected $fillable = ['code'];
    protected $fillable = [ 
        'notrans',
        'tglminta',
        'merk',
        'ukktg',
        'jnsktg',
        'jumlah',
        'nogd',
        'dipenuhi',
        'ket',
        'stok',


    ];
    protected $guarded = ['id'];
    // public $timestamps = false;

     public function KtgOrd(): BelongsTo
    {
         return $this->belongsTo(KtgOrd::class, 'notrans','nogd');
    }
    
}
