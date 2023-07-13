<?php

namespace Modules\ForTheBuilder\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'task';

    protected $fillable = [
        'user_id',
        'performer_id',
        'deal_id',
        'title',
        'type',
        'task_date',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function performer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'performer_id', 'id');
    }

    public function deal(): BelongsTo
    {
        return $this->belongsTo(Deal::class, 'deal_id', 'id');
    }
}
