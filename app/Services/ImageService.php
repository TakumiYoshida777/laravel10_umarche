<?php 

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use InterventionImage;

class ImageService
{
    public static function upload($imageFile, $folderName) {
            // Storage::putFile('public/shops', $imageFile); リサイズ無しの場合
            $fileName = uniqid(rand().'_');
            $extension = $imageFile->getClientOriginalExtension();
            $fileNameToStore = $fileName. '.' . $extension;
            $resizedImage = \Intervention\Image\Facades\Image::make($imageFile)->resize(1920, 1080)->encode();
            // dd($imageFile,$resizedImage);
            Storage::put('public/' .$folderName. '/' . $fileNameToStore, $resizedImage);

        return $fileNameToStore;
    } 
}

?>