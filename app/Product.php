<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'type', 'category', 'name', 'description', 'operation', 'frame_deepth', 'frame_deepth_2', 'glass_thickness', 'height_of_sill', 'height_off_sill_2', 'feature_image', 'image_1', 'image_2', 'image_3', 'image_4', 'image_5', 'image_6'
    ];
}
