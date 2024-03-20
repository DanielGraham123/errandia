<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Synonym extends Model
{
    use HasFactory;

    protected $table = 'synonyms';

    protected $fillable = ['name', 'values'];

    public static function get_synonym_values() : array
    {
        $synonyms = Synonym::OrderBy('name', 'desc')->get();
        $values = [];
        foreach ($synonyms as $synonym) {
            $values[] = $synonym->values;
        }
        return $values;
    }
}
