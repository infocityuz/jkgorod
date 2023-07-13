<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Logs extends Model
{
    use HasFactory, SoftDeletes;
    protected $connection = 'mysql';
    protected $table = 'logs';

    protected $fillable = [
        'user_id',
        'status',
        'model',
        'action',
        'message',
        'models',
    ];

    protected $guarded = [];

    protected $casts = [
        'models' => 'array',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
