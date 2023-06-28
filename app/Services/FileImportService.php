<?php


namespace App\Services;

class FileImportService
{
    protected $importedRecordRepository;

    public function __construct(\App\Repositories\ImportedRecordRepository $importedRecordRepository)
    {
        $this->importedRecordRepository = $importedRecordRepository;
    }

    public function import()
    {

    }

    /**
     * @param string $pathToFile
     * @param int $fileId
     * @return void
     */
    public function queueImport(string $pathToFile, int $fileId)
    {
        var_dump($fileId);
        var_dump($pathToFile);
    }

    public function parseLine()
    {

    }
}
