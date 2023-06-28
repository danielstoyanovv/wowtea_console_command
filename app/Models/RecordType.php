<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type'
    ];

    public function recordData()
    {
        return $this->hasMany(RecordData::class);
    }

}
