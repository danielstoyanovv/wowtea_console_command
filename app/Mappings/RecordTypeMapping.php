<?php

namespace App\Mappings;

use App\Models\RecordMapping;
use App\Models\RecordType;

class RecordTypeMapping
{

    public $mapping;

    public function __construct()
    {
        $this->mapping = $this->initializeMapping();
    }

    private function initializeMapping()
    {
        $recordMappings = RecordMapping::all();

        foreach($recordMappings as $recordMapping)
        {
            $recordType = RecordType::find($recordMapping->record_type_id);
        }

        $mapping = [];

        // logic

        return $mapping;
    }

    public function getMapping()
    {
        return $this->mapping;
    }

}
