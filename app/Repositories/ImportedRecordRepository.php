<?php

namespace App\Repositories;
use Database\Factories\FileImportFactory;
use Database\Factories\RecordTypeFactory;
use Database\Factories\RecordDataFactory;
use App\Models\FileImport;
use App\Models\RecordType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Models\RecordData;
use App\Models\RecordMapping;
use Database\Factories\RecordMappingFactory;

class ImportedRecordRepository implements ImportedRecordRepositoryInterface
{
    /**
     * @param array $data
     * @param int $fileId
     * @return void
     */
    public function save(array $data, int $fileId): void
    {
        $jsonRows = $data;
        unset($jsonRows[0]);
        $fileImport = $this->createFileImport($fileId);
        $recordType = $this->createRecordType($data);
        $this->createRecordData($fileImport, $recordType, $jsonRows);
        $this->createRecordMapping($recordType);
    }

    /**
     * @param int $fileId
     * @return FileImport|Collection|Model
     */
    private function createFileImport(int $fileId)
    {
        if ($fileImport = FileImport::find($fileId)) {
            return $fileImport;
        }
        return FileImportFactory::new()->create([
            'id' => $fileId
        ]);
    }

    /**
     * @param array $data
     * @return RecordType|Collection|Model
     */
    private function createRecordType(array $data)
    {
        if ($recordType = RecordType::where('number_row', $data[0])->get()->first()) {
            return $recordType;
        }
        return RecordTypeFactory::new()->create([
            'number_row' => $data[0]
        ]);
    }

    /**
     * @param FileImport $fileImport
     * @param RecordType $recordType
     * @param array $jsonRows
     * @return RecordData|Collection|Model
     */
    private function createRecordData(FileImport $fileImport, RecordType $recordType, array $jsonRows)
    {
        if ($recordData = RecordData::where([
            'file_import_id' => $fileImport->id,
            'record_type_id' => $recordType->id,
        ])->get()->first()) {
            $recordData->update([
                'data' => json_encode($jsonRows, true)
            ]);
            return $recordData;
        }
        return RecordDataFactory::new()->create([
            'file_import_id' => $fileImport->id,
            'record_type_id' => $recordType->id,
            'data' => json_encode($jsonRows, true)
        ]);
    }

    /**
     * @param RecordType $recordType
     * @return RecordMapping|Collection|Model
     */
    private function createRecordMapping(RecordType $recordType)
    {
        if ($recordMapping = RecordMapping::where('record_type_id', $recordType->id)->get()->first()) {
            return $recordMapping;
        }
        return RecordMappingFactory::new()->create([
            'record_type_id' => $recordType->id,
            'start_range' => 0,
            'end_range' => 0,
            'length' => 0
        ]);
    }
}
