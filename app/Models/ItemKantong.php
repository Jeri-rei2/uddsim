<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class ItemKantong extends Model
{
    use HasFactory;

    protected $table = 'qrgudang';

    // protected $fillable = ['code'];
    protected $fillable = [ 
            'code',
            'nilai',
            'name',
            'mrkkntng',
            'jnskntng',
            'typekntng',
            'tglbrcode',
            'ukuran',
            'jmlcetak',
            'duplikat',
            'nolot',
            'nat',
            'nokntng',

    ];
    protected $guarded = ['id'];
    // public $timestamps = false;
    
}
