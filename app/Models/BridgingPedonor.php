<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BridgingPedonor extends Model
{
    use HasFactory;

    protected $table = 'bridgingpedonor';

    protected $fillable = [ 
        'id',
        'prm_pkode',
        'prm_pudd',
        'prm_pktp',
        'prm_pnama',
        'prm_pkelamin',
        'prm_ptmplahir',
        'prm_ptgllahir',
        'prm_pgolabo',
        'prm_pgolrh',
        'prm_pketgolda',
        'prm_pstatusnikah',
        'prm_palamat',
        'prm_pkdpos',
        'prm_pkeluarahan',
        'prm_pkecamatan',
        'prm_pkabupaten',
        'prm_pprovinsi',
        'prm_ptelp',
        'prm_pmobile',
        'prm_ppekerjaan',
        'prm_ptgldonorterakhir',
        'prm_pjenisdonorterahir',
        'prm_ptglkembalidonor',
        'prm_pjmldonor',
        'prm_pp10',
        'prm_pp25',
        'prm_pp50',
        'prm_pp75',
        'prm_pp100',
        'prm_ppsatya',
        'prm_pckl_b',
        'prm_pckl_c',
        'prm_pckl_i',
        'prm_pckl_s',
        'prm_pckl_m',
        'prm_pckl_abs',
        'prm_pckl_imltd',
        

     

       
    ];
    // protected $guarded = ['id'];

    // public function cabang(): BelongsTo
    // {
    //     return $this->belongsTo(Cabang::class, 'kdcab', 'id');
    // }

 
    public function getRouteKeyName()
    {
        return 'id';
    }

    
}
