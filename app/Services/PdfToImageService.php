<?php

namespace App\Services;

use Exception;
use Imagick;
use ImagickPixel;

class PdfToImageService extends BaseService
{
    public function pdfToImage(string $fullPathToPdf, string $outputDir)
    {
        if (empty($fullPathToPdf))
            throw new Exception("Đường dẫn file pdf rỗng");
        if (!file_exists($fullPathToPdf))
            throw new Exception("File pdf không tồn tại");

        $paths = [];

        // 1) Khởi tạo instance
        $imagick = new Imagick();

        // 2) Ping để lấy metadata, không load toàn bộ PDF vào memory
        $imagick->pingImage($fullPathToPdf);

        // 3) Đếm số trang (số images)
        $totalPages = $imagick->getNumberImages();
        for ($i = 0; $i < $totalPages; $i++) {
            $imagick = new Imagick();
            // 1. set độ phân giải nếu cần
            $imagick->setResolution(150, 150);
            // 2. set nền trắng trước khi load PDF
            $imagick->setBackgroundColor(new ImagickPixel('white'));
            // 3. đọc đúng trang i (zero-based index)
            $imagick->readImage($fullPathToPdf . "[$i]");
            // 4. gộp layer / tắt alpha để loại transparency
            $imagick->setImageAlphaChannel(Imagick::ALPHACHANNEL_REMOVE);
            // 5. set định dạng PNG
            $imagick->setImageFormat('png');
            // 6. ghi file
            $time = date('dmYHis');
            $name = "$time.png";
            $imagick->writeImage("$outputDir/$name");
            $imagick->clear();

            $paths[] = $name;
            sleep(1);
        }

        return $paths;
    }

    public function imagesToPdf(array $images, string $outputDir, string $fileName)
    {
        if (empty($images))
            return null;

        $path = "$outputDir/$fileName";
        if (!is_dir(public_path($outputDir)))
            mkdir($outputDir, 0777, true);

        $imagick = new Imagick();
        foreach ($images as $image)
            $imagick->readImage($image);

        $imagick->setImageFormat('pdf');
        $imagick->writeImages(public_path($path), true);

        return $path;
    }
}
