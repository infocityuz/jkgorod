<?php

namespace Modules\ForTheBuilder\Entities;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'USD',
        'SUM'
    ];

    public $connection = 'mysql2';

    public $table = 'currency';
}
