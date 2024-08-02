<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promoters extends Model
{
    use HasFactory;

    protected $fillable=['name','lastName','city_id','coordinator_id','phone',];
}
