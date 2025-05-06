<?php

namespace App\Services;

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
        $folder = "uploads/$folder";
        $publicFolder = storage_path($folder);
        if (!is_dir($publicFolder))
            mkdir($publicFolder, 0777, true);

        $name = $this->createName($file->getClientOriginalName());
        $file->storeAs("public/$folder", $name);

        return "$folder/$name";
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
