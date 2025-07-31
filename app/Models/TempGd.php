<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class TempGd extends Model
{
    use HasFactory;

    protected $table = 'tempgd';

    // protected $fillable = ['code'];
    protected $fillable = [ 
            'nokntng',
            'nmkntng',
            'data',
            'barcode'

    ];
    protected $guarded = ['id'];
    // public $timestamps = false;
    
}
