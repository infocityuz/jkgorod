<?php

namespace Modules\ForTheBuilder\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeadComment extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'lead_comment';
    protected $fillable = [
        'user_id',
        'lead_id',
        'comment',
    ];

    public function lead():BelongsTo
    {
        return $this->belongsTo(Leads::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
