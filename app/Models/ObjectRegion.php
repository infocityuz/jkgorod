<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ObjectRegion extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'object_region';
    protected $fillable = [
        'object_region',
    ];

//    public function object():HasMany
//    {
//        return $this->hasMany(ObjectTable::class,'region_id','id');
//    }
}
