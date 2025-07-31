<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';
    protected $guarded = ['id'];
    
    protected $fillable = [
        'id',
        'bagian',
    
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }
 
    public function getRouteKeyName() {
        return 'id';
    }
   
}
