<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tower extends Model
{
    public function scopeFilterByLocationAndDistance($query, $latitude, $longitude, $distance)
    {

        $haversine = "(3959 * acos(cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) + sin(radians($latitude)) * sin(radians(latitude))))";

        return $query->selectRaw("{$haversine} AS distance")->whereRaw("{$haversine} < ?", [$distance]);
    }
}
