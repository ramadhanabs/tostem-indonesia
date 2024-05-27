<?php
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
 
class Url {
    public static function getSlugUrl($urlSlug) {
        $slug = Str::slug($title);
	    $slugCount = count( $model->whereRaw("url REGEXP '^{$slug}(-[0-9]*)?$'")->get() );
	    return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
    }
}