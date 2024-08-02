<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class CityScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if(Auth::check() && Auth::user()->city_id){
            if (!Auth::user()->hasRole('SuperUser')){
                $builder->where('city_id', Auth::user()->city_id);
            }
        }
    }
}