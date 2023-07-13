<?php

namespace Modules\ForTheBuilder\Entities;

use Illuminate\Database\Eloquent\Model;

class BasketHouseDocument extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'basket_house_document';

    protected $fillable = [
        'basket_house_flat_id',
        'name',
        'guid',
        'ext',
        'size',
        'main_image'
    ];
}
