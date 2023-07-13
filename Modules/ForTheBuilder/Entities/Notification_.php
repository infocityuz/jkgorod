<?php

namespace Modules\ForTheBuilder\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification_ extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'notification';

    protected $fillable = [];
    protected static function newFactory()
    {
        return \Modules\ForTheBuilder\Database\factories\NotificationFactory::new();
    }

}
