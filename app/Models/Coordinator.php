<?php

namespace App\Models;

use App\Scopes\CityScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinator extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::addGlobalScope(new CityScope);
    }
    protected $fillable= ['name','lastName','city_id','phone'];
}
