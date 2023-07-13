<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait TranslateMethods
{
    public function getTranslatedAttribute($value)
    {
        if ($json = json_decode($value)) {
            return $json->{app()->getLocale()} ?? "uz";
        }
        return $value;
    }
}

