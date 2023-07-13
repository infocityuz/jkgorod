<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentHasApartmentSale extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'apartment_has_apartment_sale';
    protected $fillable = [
        'apartment_sale_id',
        'apartment_has_id',
        'is_request',
    ];
    public $timestamps = false;

}
