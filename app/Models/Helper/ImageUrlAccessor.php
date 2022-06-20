<?php

namespace App\Models\Helper;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


trait ImageUrlAccessor {

    // Accessors: get(Name)Attribute
    // $category->image_url

    public function getImageUrlAttribute()
    {
        if(!$this->image) {
            return asset('images/blank.png');
        }

        if(Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        return Storage::disk('public')->url($this->image);
    }
}