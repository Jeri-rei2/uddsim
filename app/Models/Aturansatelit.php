<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Loket;

class Aturansatelit extends Model
{
    use HasFactory;
    protected $table = 'aturansatelit';
    protected $guarded = ['id'];
    protected $fillable = ['nomor','id_donor','namadonor','ruang','tujuan','status','loket_id'];

  public function Periksadokter()
  {
    return $this->belongsTo(Periksadokter::class, 'typektg','id');
  }
  public function Periksadonor()
  {
    return $this->belongsTo(Periksadonor::class, 'typektg','id');
  }
}
