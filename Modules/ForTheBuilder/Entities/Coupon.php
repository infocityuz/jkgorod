<?php

namespace Modules\ForTheBuilder\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql2';
    protected $table = 'coupon';
    protected $fillable = [
        'name',
        'percent',
    ];
}