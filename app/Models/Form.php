<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        'json_schema_id',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function jsonSchema()
    {
        return $this->belongsTo(JsonSchema::class);
    }
}
