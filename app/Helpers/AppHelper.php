<?php

namespace App\Helpers;

use Image;

function uploadImage($path, $image)
{
    $file = $path . time() . '.' . $image->getClientOriginalExtension();
    $isUploaded = Image::make($image)->resize(300, 200)->save($file);

    return ($isUploaded) ? $file : false;
}
