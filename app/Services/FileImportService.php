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

        foreach ($content as $lineItemString) {
            $data = explode("    ", $lineItemString);
            ImportFileJob::dispatch($data, $fileId, $this->importedRecordRepository);
        }
    }
}
