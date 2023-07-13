<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Testing\Fluent\Concerns\Has;

class ObjectTable extends Model
{
  use HasFactory;
  protected $connection = 'mysql';
  protected $table = 'object';

  protected $fillable = [
    'category_id',  # done
    'object_parent_element', #1 relation
    'title', #1
    'currency', #1
    'price', #1
    'service_fee', #
    'site', #
    'description', #+1
    'address', #+1
    'region_id', #relation done
    'town_id', #relation done
    'area_id', #relation done
    'street', #relation done
    'house_number', #1
    'village_name', #1
    'village_lastname', #1
    'build_year', #1
    'build_area', #1
    'yard_count', #1
    'house_count', #1
    'house_area_min',
    'house_area_max',
    'yard_area_min',
    'yard_area_max',
    'external_infrastructure',
    'internal_infrastructure',
    'object_security', #relation  done
    'repair', #1 relation done
    'building_name',
    'building_section',
    'building_state',
    'ready_quarter',
    'floor', #1
    'floor_count',
    'material', #relation done
    'building_class', #relation done
    'legal_address',
    'access', #relation done
    'parking',
    'parking_price',
    'internet',
    'internet_type',
    'work_plan',
    'lift',
    'lift_person_count',
    'work_type',
    'ceiling_height',
    'cost_of_legal_address',
    'user_id',
    'ads',
    'body'
  ];

  // public function street(): BelongsTo
  // {
  //   return $this->belongsTo(Street::class);
  // }

  // public function district(): BelongsTo
  // {
  //   return $this->belongsTo(District::class);
  // }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function contract(): HasOne
  {
    return $this->hasOne(ObjectContract::class, 'object_id', 'id');
  }

  public function category(): BelongsTo
  {
    return $this->belongsTo(Category::class);
  }

  public function region(): BelongsTo
  {
    return $this->belongsTo(Region::class);
  }

  public function town(): BelongsTo
  {
    return $this->belongsTo(Town::class);
  }

  public function area(): BelongsTo
  {
    return $this->belongsTo(Area::class);
  }

  public function notArea(): BelongsTo
  {
    return $this->belongsTo(Town::class, 'area_id', 'id');
  }

  public function contacts(): HasOne
  {
    return $this->hasOne(ObjectContacts::class, 'object_id', 'id');
  }

  public function building_type(): BelongsToMany
  {
    return $this->belongsToMany(BuildingType::class, 'build_type_has_object');
  }

  public function parent()
  {
    return $this->hasOne(self::class, 'id', 'object_parent_element');
  }

  public function images(): HasMany
  {
    return $this->hasMany(ObjectImages::class, 'object_id', 'id');
  }

  public function files(): HasMany
  {
    return $this->hasMany(ObjectDocument::class, 'object_id', 'id');
  }

  public function main_image(): HasMany
  {
    return $this->hasMany(ObjectImages::class, 'object_id', 'id');
  }
  public function mainImage(): HasOne
  {
    return $this->hasOne(ObjectImages::class, 'object_id', 'id');
  }
}