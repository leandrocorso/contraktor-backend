<?php

namespace App\Models;

use Illuminate\Validation\Rule;

class ContractsValidator 
{
    const RULES = [
        'title' => 'required | min:5 | max:30 | unique:contracts',
        'effectiveDate' => 'required | date_format: "Y-m-d H:i:s"',
        'expirationDate' => 'required | date_format: "Y-m-d H:i:s"',
        'file' => 'required | file | mimes:pdf',
        'parts' => 'array',
    ];

    static function updateRules($request) {
        return [
            'id' => 'exists:contracts',
            'title' => ['required', 'min:5', 'max:30', Rule::unique('contracts')->ignore($request->id)],
            'effectiveDate' => 'required | date_format: "Y-m-d H:i:s"',
            'expirationDate' => 'required | date_format: "Y-m-d H:i:s"',
            'file' => 'file | mimes:pdf',
            'parts' => 'array',
        ];
    }

    const DELETE_RULES = [
        'id' => 'exists:contracts'
    ];
}