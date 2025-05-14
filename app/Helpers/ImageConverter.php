<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageConverter
{
    /**
     * Convert an image file to base64 encoded string.
     *
     * @param string $imagePath The path to the image file.
     * @return string|null The base64 encoded string of the image.
     */
    public static function toBase64Dynamic($imagePath)
    {
        // Adjust the path to use the storage disk
        $imagePath = 'public/' . $imagePath;

        if (!Storage::disk('local')->exists($imagePath)) {
            return null;
        }

        $imageData = Storage::disk('local')->get($imagePath);
        if ($imageData === false) {
            return null;
        }

        $base64 = base64_encode($imageData);
        if ($base64 === false) {
            return null;
        }

        // Determine MIME type
        $mime = mime_content_type(storage_path('app/' . $imagePath));

        return "data:$mime;base64," . $base64;
    }

    public static function toBase64Local($imagePath)
    {
        $imageData = file_get_contents(public_path($imagePath));
       // dd( public_path($imagePath));
        if ($imageData === false) {
            return null;
        }

        $base64 = base64_encode($imageData);

        if ($base64 === false) {
            return null;
        }

        // Determine MIME type if needed
        $mime = mime_content_type(public_path($imagePath));

        return "data:$mime;base64," . $base64;
    }

    public static function urlToBase64($imageUrl)
    {
        $imageData = file_get_contents($imageUrl);

        if ($imageData === false) {
            return null;
        }

        $base64 = base64_encode($imageData);

        if ($base64 === false) {
            return null;
        }

        return $base64;
    }
}
