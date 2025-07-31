<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Loket;

class Antrian extends Model
{
    use HasFactory;
    protected $table = ['antrians'];
    protected $guarded = ['id'];
    protected $fillable = ['nomor','id_donor','namadonor','ruang','tujuan','status','loket_id'];

  public function loket()
  {
    return $this->belongsTo(Loket::class);
  }

   public function Donor()
  {
    return $this->belongsTo(Donor::class, 'nodonor');
  }
}
