<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Loket;

class Aturanberat extends Model
{
    use HasFactory;
    protected $table = 'aturanklmpeberat';
    protected $guarded = ['id'];
    // protected $fillable = ['nomor','id_donor','namadonor','ruang','tujuan','status','loket_id'];

  public function Periksadonor()
  {
    return $this->belongsTo(Periksadonor::class,'brtbdn','id');
  }

}
