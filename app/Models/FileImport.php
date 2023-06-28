<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileImport extends Model
{
    use HasFactory;

    protected $fillable = [

    ];

    public function recordData()
    {
        return $this->hasMany(RecordData::class);
    }

}
