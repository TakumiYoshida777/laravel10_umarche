<?php 

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use InterventionImage;

class ImageService
{
    private Object $imageFile;
    private String $folderName;

    public function __construct($imageFile,$folderName) {
        $this->imageFile = $imageFile;
        $this->folderName = $folderName;
    }

    public function upload(): String {
            // Storage::putFile('public/shops', $imageFile); リサイズ無しの場合
            $fileName = uniqid(rand().'_');
            $extension = $this->imageFile->getClientOriginalExtension();
            $fileNameToStore = $fileName. '.' . $extension;
            $resizedImage = \Intervention\Image\Facades\Image::make($this->imageFile)->resize(1920, 1080)->encode();
            // dd($imageFile,$resizedImage);
            Storage::put('public/' .$this->folderName. '/' . $fileNameToStore, $resizedImage);

        return $fileNameToStore;
    } 
}

?>