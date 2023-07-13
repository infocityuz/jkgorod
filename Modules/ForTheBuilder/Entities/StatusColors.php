<?php

namespace Modules\ForTheBuilder\Entities;

use Illuminate\Database\Eloquent\Model;

class StatusColors extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'status_colors';

    protected $fillable = [
    	'color',
    	'status',
    ];
}
