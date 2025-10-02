<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class imageService 
{
    /** 
    * @param string $base64Image
    * @return string|null
    * @throws \Exception
    */

    public function saveBase64Image(string $base64Image): ?string
    {
        // Проверяем, что строка начинается с "data:image/"
        if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
            $imageData = substr($base64Image, strpos($base64Image, ',') + 1);
            $imageData = base64_decode($imageData);
            if ($imageData === false) {
                throw new \Exception('Base64 decode failed');
            }

            $extension = strtolower($type[1]); // jpg, png, gif и т.д.
            if (!in_array($extension, ['jpg', 'jpeg'])) {
                throw new \Exception('Unsupported image type');
            }

            $fileName = uniqid() . '.' . $extension;
            Storage::disk('public')->put('images/' . $fileName, $imageData);

            return 'storage/images/' . $fileName; // Возвращаем путь для доступа через веб
        } else {
            throw new \Exception('Invalid image data');
        }
    }

    public function saveImageFile($file) : ?string
    {
        if ($file->isValid()) {
            $path = $file->store('images', 'public');
            return 'storage/' . $path; // Возвращаем путь для доступа через веб
        }
        return null;
    }


}