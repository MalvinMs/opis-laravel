<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JsonSchema extends Model
{
    protected $fillable = [
        'name',
        'schema',
    ]; 

    protected $casts = [
        'schema' => 'array',
    ];

    public function forms()
    {
        return $this->hasMany(Form::class);
    }
}
