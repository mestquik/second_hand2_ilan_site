<?php

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

if (!function_exists('dosyaSil')) {
        function dosyaSil($file)
        {
            if (file_exists($file)) {
                if (!empty($file)) {
                    unlink($file);
                }
            }
        }
    }


    if (!function_exists('sliderYukle')) {
        function sliderYukle($image,$name)
        {

            $file_name = time().'-'.Str::slug($name);
            $image = Image::make($image);
            $image->encode('webp',75)->save(('img/sliders/'.$file_name.'.webp'));

             $image_url =   $file_name.'.webp';

             return $image_url;

        }
    }

if (!function_exists('urunYukle')) {
    function urunYukle($image,$name)
    {

        $file_name = time().'-'.Str::slug($name);
        $image = Image::make($image);
        $image->encode('webp',75)->save('img/products/'.$file_name.'.webp');

        $image_url =  $file_name.'.webp';

        return $image_url;

    }
}

if (!function_exists('kategoriYukle')) {
    function kategoriYukle($image,$name)
    {

        $file_name = time().'-'.Str::slug($name);
        $image = Image::make($image);
        $image->encode('webp',75)->save(('img/category/'.$file_name.'.webp'));

        $image_url =   $file_name.'.webp';

        return $image_url;

    }
}

