<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThereIsNearbyApartmentSale extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'there_is_nearby_apartment_sale';
    protected $fillable = [
        'apartment_sale_id',
        'there_is_nearby_id',
        'is_request',
    ];
    public $timestamps = false;
}
