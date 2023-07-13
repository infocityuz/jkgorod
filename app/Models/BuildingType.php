<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BuildingType extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'building_type';
    protected $fillable = [
        'name',
    ];

//    public function apartment_sale():HasMany
//    {
//        return $this->hasMany(ApartmentSale::class);
//    }

    public function object_table():BelongsToMany
    {
        return $this->belongsToMany(ObjectTable::class,'bulid_type_has_object');
    }

}
