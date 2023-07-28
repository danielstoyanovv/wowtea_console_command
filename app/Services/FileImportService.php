<?php

namespace App\Services;

use App\Jobs\ImportFileJob;
use Illuminate\Support\Facades\File;

class FileImportService
{
    public function __construct(private \App\Repositories\ImportedRecordRepository $importedRecordRepository)
    {
    }

    /**
     * @param string $pathToFile
     * @param int $fileId
     * @return void
     */
    public function queueImport(string $pathToFile, int $fileId)
    {
        $fileContent = File::get($pathToFile);
        $content = explode("\n", $fileContent);
        $chunks = array_chunk($content, 1000);

        foreach ($chunks as $chunk) {
            foreach ($chunk as $item) {
                $data = explode("    ", $item);
                ImportFileJob::dispatch($data, $fileId, $this->importedRecordRepository);
            }
        }
    }
}
