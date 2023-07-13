<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ApartmentSaleContacts extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'apartment_sale_contacts';
    protected $fillable = [
        'first_name',
        'last_name',
        'surname',
        'phone_number',
        'additional_phone_number',
        'email',
    ];

    public function apartment_sale():BelongsTo
    {
        return $this->belongsTo(ApartmentSale::class);
    }

}
