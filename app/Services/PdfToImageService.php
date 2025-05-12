<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
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

        // Chuẩn hóa đường dẫn
        $fullPathToPdf = str_replace('/', '\\', $fullPathToPdf);
        $outputDir = str_replace('/', '\\', $outputDir);

        // Log để debug
        Log::info("PDF Path: $fullPathToPdf");
        Log::info("Output Directory: $outputDir");

        $paths = [];
        $gsPath = config('app.ghost-script');
        $timePrefix = date('dmYHis');

        // Đặt tên file output với đường dẫn đầy đủ
        $outputPattern = $outputDir . '\\' . $timePrefix . '-%03d.png';

        // Lệnh GhostScript
        $cmd = '"' . $gsPath . '" -dSAFER -dBATCH -dNOPAUSE -sDEVICE=pngalpha -r150 ' .
            '-dTextAlphaBits=4 -dGraphicsAlphaBits=4 ' .
            '-o "' . $outputPattern . '" "' . $fullPathToPdf . '"';

        // Log lệnh để debug
        Log::info("Command: $cmd");

        // Chạy lệnh và log output
        $output = [];
        $returnCode = 0;
        exec($cmd, $output, $returnCode);

        if ($returnCode !== 0) {
            // Log lỗi chi tiết
            $errorLog = "Command: $cmd\nReturn code: $returnCode\nOutput: " . implode("\n", $output);
            Log::error($errorLog);
            throw new Exception("Lỗi convert PDF: Mã lỗi $returnCode");
        }

        // Tìm các file đã tạo
        $globPattern = $outputDir . '\\' . $timePrefix . '-*.png';
        $files = glob($globPattern);

        foreach ($files as $file)
            $paths[] = basename($file);

        return $paths;
    }

    public function imagesToPdf(array $images, string $relativeFolder, string $fileName)
    {
        $absoluteFolder = storage_path("app/public/$relativeFolder");
        if (!is_dir($absoluteFolder))
            mkdir($absoluteFolder, 0777, true);

        $imagick = new Imagick();
        foreach ($images as $image) {
            $imagick->readImage($image);
        }
        $imagick->setImageFormat('pdf');

        $absolutePath = "{$absoluteFolder}/{$fileName}";
        $imagick->writeImages($absolutePath, true);

        return "{$relativeFolder}/{$fileName}";
    }
}
