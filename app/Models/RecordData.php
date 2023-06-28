<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RecordData extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_import_id',
        'record_type_id',
        'data'
    ];


    public function fileImport()
    {
        return $this->belongsTo(FileImport::class);
    }

    public function recordType()
    {
        return $this->belongsTo(RecordType::class);
    }

}
