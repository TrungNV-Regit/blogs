<?php

namespace App\Services\Common;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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

    public function deleteImage(string $imagePath): void
    {
        try {
            $fileName = Str::after($imagePath, config('blog.image_path_prefix'));
            Storage::delete(config('blog.storage_path') . $fileName);
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage());
        }
    }
}
