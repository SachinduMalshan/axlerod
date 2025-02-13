<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GarageProfile extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function vehicle_types () {
        return $this->belongsToMany(VehicleType::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function posts () {
        return $this->hasMany(Post::class);
    }

    public function getDistance($latitude1, $longtitude1, $latitude2, $longtitude2){
        $earth_radius = 6371;
        $lat_from = deg2rad($latitude1);
        $lon_from = deg2rad($longtitude1);
        
        $lat_to = deg2rad($latitude2);
        $lon_to = deg2rad($longtitude2);

        $lat_delta = $lat_to - $lat_from;
        $lon_delta = $lon_to - $lon_from;

        $angle = 2 * asin(sqrt(pow(sin($lat_delta / 2), 2) + cos($lat_from) * cos($lat_to) * pow(sin($lon_delta / 2), 2)));
        return $angle * $earth_radius;
    } 
}
