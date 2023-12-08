<?php

namespace App\Services\Common;

use Illuminate\Support\Facades\Storage;
use Exception;

class ImageService
{
    public function uploadImage(object $image): string
    {
        try {
            $fileName = time() . '.' . $image->extension();
            $imagePath = $image->storeAs(config('blog.storage_path'), $fileName);
            return Storage::url($imagePath);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}
