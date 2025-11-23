<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Opis\JsonSchema\Errors\ErrorFormatter;
use Opis\JsonSchema\Validator;

    class JsonSchemaValid implements ValidationRule
    {

    protected $schema;

    public function __construct($schema)
    {
        $this->schema = is_string($schema) ? json_decode($schema) : $schema;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $data = json_decode(json_encode($value));
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            $fail("Format pada $attribute tidak valid: " . json_last_error_msg());
            return;
        }

        $validator = new Validator();
        $result = $validator->validate($data, $this->schema);

        if (!$result->isValid()) {
            $formatter = new ErrorFormatter();
            $errors = $formatter->format($result->error());
            
            foreach ($errors as $path => $message) {
                $cleanPath = ltrim(str_replace('/', '.', $path), '.');
                
                // Extract actual error message from array or use as-is if string
                if (is_array($message)) {
                    $errorMsg = implode(', ', $message);
                } else {
                    $errorMsg = $message;
                }
                
                $fail("Validasi gagal pada {$cleanPath}: {$errorMsg}");
            }
        }
    }
}
