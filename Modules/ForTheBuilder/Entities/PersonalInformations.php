<?php

namespace Modules\ForTheBuilder\Entities;

use App\Models\ObjectTable;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonalInformations extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'personal_informations';

    protected $fillable = [
        'client_id',
        'series_number',
        'inn',
        'issued_by',
        'given_date',
        'address',
    ];

    public function deal(): BelongsTo
    {
        return $this->belongsTo(Deal::class, 'id', 'deal_id');
    }
}
