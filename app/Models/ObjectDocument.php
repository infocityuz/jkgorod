<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ObjectDocument extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'object_document';

    protected $fillable = [
        'object_id',
        'name',
        'guid',
        'guid',
        'ext',
        'size',

    ];

    public function object_table():BelongsTo
    {
        return $this->belongsTo(ObjectTable::class);
    }
}
