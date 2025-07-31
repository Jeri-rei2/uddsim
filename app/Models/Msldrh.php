<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Msldrh extends Model
{
    use HasFactory;

    protected $table = 'masldrh';

    protected $fillable = [ 
        'id',
        'kdcab',
        'asldrh',
        'nmasldrh',
        'kelompok',
        'alm1',
        'alm2',
        'tlp',
        'kdpos',
        'nmpsr',
        'tlppsr',
        'kdptgs',
        'uploadstamp',
 

    
    ];
    // protected $guarded = ['id'];

    public function cabang(): BelongsTo
    {
        return $this->belongsTo(Cabang::class, 'kdcab', 'id');
    }

 
    public function getRouteKeyName()
    {
        return 'id';
    }

    
}
