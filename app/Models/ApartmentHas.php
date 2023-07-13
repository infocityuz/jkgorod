<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ApartmentHas extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'apartment_has';
    protected $fillable = [
        'name',
    ];
    public function apartment_Sale():BelongsToMany
    {
        return $this->belongsToMany(ApartmentSale::class,'apartment_has_apartment_sale');
    }
}
