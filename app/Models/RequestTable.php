<?php

namespace App\Models;

use App\Traits\Observable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\EscapeUniCodeJson;
use App\Traits\TranslateMethods;
use Spatie\Translatable\HasTranslations;

class RequestTable extends Model
{
    use HasFactory, Observable;
//    use HasFactory, HasTranslations, TranslateMethods, EscapeUniCodeJson;

    protected $connection = 'mysql';

    protected $table = 'request_table';
    protected $fillable = [
        'type',
        'title',
        'description',
        'address',
        'region_id',
        'town_id',
        'area_id',
        'landmark',
        'organization',
        'total_area',
        'living_space',
        'kitchen_area',
        'floor',
        'floors_of_house',
        'number_of_rooms',
        'ceiling_height',
        'year_construction',
        'price_from',
        'price_to',
        'currency',
        'is_exchange',
        'is_furnished',
        'is_commission',
        'is_commission_percent',
        'is_commission_number',
        'user_id',
        'repair',
        'layout',
        'bathroom',
        'building_type',
        'housing_type',
        'flat_type',
        'seller_id',
        'distance_to_metro',
        'metro',
    ];

    protected $casts = [
        'type' => 'array',
    ];

    //logs table log yozadi.  Logs Modelga qara,App\Traits Observable qara;
//    public static function logSubject(Model $model): string
//    {
//        return sprintf( "Квартиры [id:%d] %s/%s",
//            $model->id, $model->title, $model->description
//        );
//    }

    public function apartment_has():BelongsToMany
    {
        return $this->belongsToMany(ApartmentHas::class,'apartment_has_apartment_sale', 'apartment_sale_id')->where('is_request', 1);
    }

    public function there_is_nearby():BelongsToMany
    {
        return $this->belongsToMany(ThereIsNearby::class,'there_is_nearby_apartment_sale', 'apartment_sale_id')->where('is_request', 1);
    }

//    public function Flatimages():HasMany
//    {
//        return $this->hasMany(ApartmentSaleImages::class, 'apartment_sale_id', 'id')->orderBy('main_image','desc');
//    }
//
//    public function main_image():HasOne
//    {
//        return $this->hasOne(ApartmentSaleImages::class, 'apartment_sale_id', 'id')->where('main_image',1);
//    }

    public function contacts():HasOne
    {
        return $this->hasOne(ApartmentSaleContacts::class, 'apartment_sale_id', 'id')->where('is_request', 1);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //================================================================

}
