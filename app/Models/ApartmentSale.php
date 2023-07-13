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

class ApartmentSale extends Model
{
//    use HasFactory,SoftDeletes,Observable;
    use HasFactory, Observable;
//    use HasFactory, HasTranslations, TranslateMethods, EscapeUniCodeJson;

    protected $connection = 'mysql';

    protected $table = 'apartment_sale';

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
        'price',
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
        'olx_url',
        'images',
        'seller_id',
        'is_parser',
        'distance_to_metro',
        'metro',
        'latitude',
        'longitude',
        'business_private',
    ];

    protected $casts = [
        'type' => 'array',
        'images' => 'array',
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
        return $this->belongsToMany(ApartmentHas::class,'apartment_has_apartment_sale');
    }

    public function there_is_nearby():BelongsToMany
    {
        return $this->belongsToMany(ThereIsNearby::class,'there_is_nearby_apartment_sale');
    }

    public function Flatimages():HasMany
    {
        return $this->hasMany(ApartmentSaleImages::class)->orderBy('main_image','desc');
    }

    public function main_image():HasOne
    {
        return $this->hasOne(ApartmentSaleImages::class)->where('main_image',1);
    }

    public function contacts():HasOne
    {
        return $this->hasOne(ApartmentSaleContacts::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function region():BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function town():BelongsTo
    {
        return $this->belongsTo(Town::class);
    }

    public function area():BelongsTo
    {
        return $this->belongsTo(Area::class);
    }

    //================================================================


    // protected $with = ['images'];
    //protected $appends = [];
    //public function getAppendFuncAttribute()
    //{
        //return 'appendFunc';
    //}


    //public function categoryHasOne():HasOne
    //{
    // return $this->HasOne(Category::class,'category_id','id');
    //}

}

