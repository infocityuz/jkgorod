<?php

namespace Modules\ForTheBuilder\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HouseDocument extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'house_document';

    protected $fillable = [
        'house_flat_id',
        'name',
        'guid',
        'ext',
        'size',
        'main_image'

    ];


    public function house(): BelongsTo
    {
        return $this->belongsTo(HouseFlat::class);
    }
}
