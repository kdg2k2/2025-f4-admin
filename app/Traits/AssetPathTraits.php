<?php

namespace App\Traits;

trait AssetPathTraits
{
    public function getAssetImage($url)
    {
        $path = env('APP_LOGO');
        if (!empty($url))
            $path = $url;
        return $this->getAssetUrl($path);
    }

    public function getAssetUrl($url)
    {
        return asset($url);
    }
}
