<?php

namespace App\Repositories;

interface ImportedRecordRepositoryInterface
{
    /**
     * @param array $data
     * @param int $fileId
     * @return void
     */
    public function save(array $data, int $fileId): void;
}
