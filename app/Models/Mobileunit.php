<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mobileunit extends Model
{
    use HasFactory;

    protected $table = 'mmobileunit';

    protected $fillable = [ 
        'id',
        'kdcab',
        'kdmobil',
        'merek',
        'plat',
        'thprod',
        'thbeli',
        'kdptgs',     
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
