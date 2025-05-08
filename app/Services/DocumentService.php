<?php

namespace App\Services;

use App\Repositories\DocumentRepository;
use Exception;
use Illuminate\Support\Facades\Storage;

class DocumentService extends BaseService
{
    protected $documentRepository;
    protected $documentImageService;
    protected $packageUserService;
    protected $pdfToImageService;
    public function __construct()
    {
        $this->pdfToImageService = app(PdfToImageService::class);
        $this->packageUserService = app(PackageUserService::class);
        $this->documentImageService = app(DocumentImageService::class);
        $this->documentRepository = app(DocumentRepository::class);
    }

    public function list(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $records = $this->documentRepository->list($request);
            $records = $this->transformRecords($records);
            if ($request["paginate"] == 1)
                $records = $this->paginate($records, $request["per_page"], $request["page"]);
            return $records;
        });
    }

    public function store(array $request)
    {
        return $this->transaction(function () use ($request) {
            $request = $this->prepareData($request)['request'];
            $record = $this->documentRepository->store($request);
            $this->renderImage($record->id);

            $record = $this->findById($record->id);
            return $record;
        });
    }

    public function edit(array $request)
    {
        return $this->transaction(function () use ($request) {
            $record = $this->findById($request['id']);
            return $record;
        });
    }

    public function update(array $request)
    {
        return $this->transaction(function () use ($request) {
            $prepare = $this->prepareData($request);

            if ($prepare['removeOld'] == true) {
                $record = $this->documentRepository->findById($request['id']);
                if (file_exists(public_path($record->path)))
                    unlink(public_path($record->path));

                $record = $this->documentRepository->update($prepare['request']);
                $this->renderImage($record->id);
            } else {
                $record = $this->documentRepository->update($prepare['request']);
            }

            $record = $this->findById($record->id);
            return $record;
        });
    }

    public function destroy(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->documentRepository->destroy($request);
        });
    }

    public function show(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            return $this->renderPdf($request['document_id']);
        });
    }

    public function download(array $request)
    {
        return $this->tryThrow(function () use ($request) {
            $record = $this->documentRepository->findById($request['document_id']);
            $record = $this->transformRecord($record);
            return $record['path'];
        });
    }

    public function findById(int $id)
    {
        $record = $this->documentRepository->findById($id);
        return $this->transformRecord($record);
    }

    private function transformRecord($record)
    {
        if (!empty($record['uploader']))
            $record['uploader']['path'] = $this->getAssetImage($record['uploader']['path']);
        $record['path'] = Storage::disk('public')->url($record['path']);
        return $record;
    }

    private function transformRecords($records)
    {
        return array_map([$this, 'transformRecord'], $records);
    }

    private function prepareData(array $request)
    {
        $removeOld = false;
        if (!empty($request["path"])) {
            $removeOld = true;
            $request["path"] = $this->fileUpload($request["path"]);
        }

        return [
            'request' => $request,
            'removeOld' => $removeOld,
        ];
    }

    private function fileUpload($path)
    {
        return (new FileUploadService())->storeDocument($path, false);
    }

    private function renderImage(int $id)
    {
        return $this->tryThrow(function () use ($id) {
            $document = $this->documentRepository->findById($id);
            $this->documentImageService->deleteByIdDocument($id);

            $fullPathToPdf = storage_path('app/public/' . $document->path);
            if (!file_exists($fullPathToPdf))
                throw new Exception("File gốc không tồn tại");

            $folder = "app/public/uploads/documents/images/$id" . date("dmYHis");
            $outputDir = storage_path($folder);
            if (!is_dir($outputDir))
                mkdir($outputDir, 0777, true);

            $paths = $this->pdfToImageService->pdfToImage($fullPathToPdf, $outputDir);
            $paths = array_map(function ($item) use ($id, $folder) {
                return [
                    "document_id" => $id,
                    "path" => "$folder/$item",
                ];
            }, $paths);

            $this->documentImageService->insert($paths);

            return $paths;
        });
    }

    private function renderPdf(int $id)
    {
        $document = $this->documentRepository->findById($id);

        $res = [
            "path" => null,
            "message" => "Bạn đang bị số hạn số trang được xem, hãy nâng cấp tài khoản",
        ];

        $relativeFolder = "app/public/uploads/documents/temp/$id" . date("dmYHis");
        $fileName = "temp.pdf";

        if (Storage::disk('public')->exists("{$relativeFolder}/{$fileName}")) {
            $res['path'] = Storage::disk('public')->url("{$relativeFolder}/{$fileName}");
            return $res;
        }

        $originImages = $document->images->toArray();
        $totalImages = count($originImages);

        if ($totalImages == 0)
            $totalImages = count($this->renderImage($id));

        if ($totalImages < 5)
            throw new Exception("Tài liệu này chỉ có $totalImages trang nên không thể xem trước");

        if ($totalImages <= 20)
            $limitPage = 3;
        else
            $limitPage = min(round($totalImages * 0.1), 10);

        $limitedImages = array_slice($originImages, 0, $limitPage);
        $images = array_map(fn($item) => storage_path($item['path']), $limitedImages);

        $relativePdfPath = $this->pdfToImageService
            ->imagesToPdf($images, $relativeFolder, $fileName);

        $res['path'] = Storage::disk('public')->url($relativePdfPath);

        return $res;
    }
}
