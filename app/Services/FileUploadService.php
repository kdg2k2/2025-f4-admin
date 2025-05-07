<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileUploadService extends BaseService
{
    protected function storeInPublic($file, string $folder)
    {
        $folder = "uploads/$folder";
        $publicFolder = public_path($folder);
        if (!is_dir($publicFolder))
            mkdir($publicFolder, 0777, true);

        $name = $this->createName($file->getClientOriginalName());
        $file->move($folder, $name);

        return "$folder/$name";
    }

    protected function storeInStorage($file, string $folder)
    {
        $name = $this->createName($file->getClientOriginalName());

        $path = Storage::disk('public')->putFileAs(
            "uploads/{$folder}",
            $file,
            $name
        );
    
        // $path = "uploads/{$folder}/{$name}"
        return $path;
    }

    protected function createName($name)
    {
        return date('dmYHis') . "_" . $name;
    }

    public function storeImage($image, bool $isFullUrl = true)
    {
        return $this->catchWeb(function () use ($image, $isFullUrl) {
            $imagePath = $this->storeInPublic($image, "images");
            return $isFullUrl ? url($imagePath) : $imagePath;
        });
    }

    public function storeDocument($document, bool $isFullUrl = true)
    {
        return $this->catchWeb(function () use ($document, $isFullUrl) {
            $documentPath = $this->storeInStorage($document, "documents");
            return $isFullUrl ? url($documentPath) : $documentPath;
        });
    }
}
