<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ThereIsNearby extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'there_is_nearby';
    protected $fillable = [
        'name',
    ];
    public function apartment_sale():BelongsToMany
    {
        return $this->belongsToMany(ApartmentSale::class,'there_is_nearby_apartment_sale');
    }
}
