<?php

declare(strict_types=1);

namespace App\Facades\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    /**
     * Start to make a functions & enojoy!
     */
    public static function upload(string $folder_name, $file)
    {
        $fileName = time() . rand(10000, 99999) . '.' . $file->getClientOriginalExtension();

        Storage::disk('public')->putFileAs($folder_name, $file, $fileName);

        return $fileName;
    }

    public static function checkFileExist(string $folder_name, ?string $file_name = null)
    {
        if (!$file_name) {
            return false;
        }

        return Storage::disk('public')->exists($folder_name . '/' . $file_name);
    }

    public static function getURL(string $basePath)
    {
        return Storage::disk('public')->url($basePath);
    }

    public static function removeFile(string $file_url): bool
    {
        $parsedUrl = parse_url($file_url);

        $filePath = $parsedUrl['path'];

        // Remove leading slash if present
        $filePath = ltrim($filePath, '/');

        // Construct the full file path
        $fullFilePath = public_path($filePath);

        // Check if the file exists
        if (File::exists($fullFilePath)) {
            // Delete the file
            File::delete($fullFilePath);

            return true;
        }

        return false;
    }
}
