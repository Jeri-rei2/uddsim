<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Loket;

class Aturanumur extends Model
{
    use HasFactory;
    protected $table = 'aturanklmpkumur';
    protected $guarded = ['id'];
    protected $fillable = ['kelompokumur','batasbawah','batasatas',];

  public function Periksadonor()
  {
    return $this->belongsTo(Periksadonor::class, 'kelompokumur','brtbdn','id');
  }

}
