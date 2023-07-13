<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApartmentSaleImages extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'apartment_sale_images';
    protected $fillable = [
        'apartment_sale_id',
        'name',
        'guid',
        'guid',
        'ext',
        'size',
        'main_image',

    ];
    public function apartment_sale():BelongsTo
    {
        return $this->belongsTo(ApartmentSale::class);
    }
}
