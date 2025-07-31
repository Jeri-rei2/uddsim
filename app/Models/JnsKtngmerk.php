<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JnsKtngmerk extends Model
{
    use HasFactory;

    protected $table = 'mkantongmerk';
    protected $guarded = ['id'];
    
    protected $fillable = [
        'id',
        'merk',
    
    ];

    public function getRouteKeyName() {
        return 'id';
    }
  
}
