<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'name',
    'building',
    'description',
    'location',
    'capacity',
    'operational_hours',
    'image_path',
])]
class Facility extends Model
{
    //
}
