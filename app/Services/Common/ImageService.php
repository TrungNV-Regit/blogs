<?php

namespace App\Services\Common;

use Illuminate\Support\Facades\Storage;
use Exception;

class ImageService
{
    public function uploadImage(array $data): string
    {
        try {
            $file = $data['image'];
            $fileName = time() . '.' . $file->extension();
            $imagePath = $file->storeAs('public/images', $fileName);
            $linkImage = Storage::url($imagePath);
            return $linkImage;;
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}
