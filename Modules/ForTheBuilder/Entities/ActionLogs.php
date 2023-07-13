<?php

namespace Modules\ForTheBuilder\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class ActionLogs extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table = 'action_logs';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'user_id',
        'status',
        'message',
//        'context',
        'formatted',
        'remote_addr',
        'user_agent',
        'level',
        'level_name',
        'channel',
        'extra',
        'record_datetime',
    ];
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
