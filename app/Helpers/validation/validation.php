<?php

namespace App\Helpers\Validation;

class validation
{
    public static function errorMessage($validator)
    {
        $flatErrors = collect($validator->errors()->messages())->mapWithKeys(function ($messages, $field) {
            return [$field => $messages[0]];
        })->toArray();
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $flatErrors,
                'status_code' => 422
            ], 422);
        }
    }
}
