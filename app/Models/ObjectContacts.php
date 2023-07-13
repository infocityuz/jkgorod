<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ObjectContacts extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'object_contacts';
    protected $fillable = [
        'object_id',
        'admin_id',
        // 'user_info',
        'more_info',
        'user_type',
        'phone_number',
        'email',
        'last_name',
        'first_name',
        'surename',
    ];

    public function object_table(): BelongsTo
    {
        return $this->belongsTo(ObjectTable::class, 'id', 'object_id');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'admin_id');
    }
}