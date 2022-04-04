<?php

namespace App\Services;

use App\Services\Service;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;

class PhotoService extends Service
{
    /**
     * Hash the filename of the file uploaded.
     *
     * @param string $fileName
     *
     * @return string
     */
    public function hashFileName(string $fileName): string
    {
        return Hash::make($fileName);
    }

    /**
     * Prepares the file to be uploaded by hashing the filename
     * and retaining the file extension
     *
     * @param UploadedFile $file
     *
     * @return string
     */
    public function prepareFile(UploadedFile $file): string
    {
        $extension = $file->extension();
        $name = self::hashFileName($file->getClientOriginalName());

        return $name . '.' . $extension;
    }
}
