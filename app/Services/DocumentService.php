<?php

namespace App\Services;

use App\Repositories\DocumentRepository;
use Exception;
use Illuminate\Support\Facades\Storage;

class DocumentService extends BaseService
{
    protected $documentRepository;
    protected $documentImageService;
    public function __construct()
    {
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

            $folder = "app/public/uploads/documents/$id/images";
            $outputDir = storage_path($folder);
            if (!is_dir($outputDir))
                mkdir($outputDir, 0777, true);

            $paths = (new PdfToImageService())->pdfToImage($fullPathToPdf, $outputDir);
            $paths = array_map(function ($item) use ($id, $folder) {
                return [
                    "document_id" => $id,
                    "path" => "$folder/$item",
                ];
            }, $paths);

            (new DocumentImageService())->insert($paths);
        });
    }
}
