<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ObjectContract extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'object_contract';
    protected $fillable = [
        'object_id',
        'contract_admin_id',
        'start_date',
        'finish_date',
        'contract_number',
        'contract_fee',
    ];

    public $timestamps = false;

    public function object_table():BelongsTo
    {
        return $this->belongsTo(ObjectTable::class,'id','object_id');
    }

    public function users():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
