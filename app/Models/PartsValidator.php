<?php

namespace App\Models;

class PartsValidator 
{
    const RULES = [
        'firstname' => 'required | max:20',
        'lastname' => 'required | max:20',
        'email' => 'required | email | max:100',
        'document' => 'required | size:11',
        'phone' => 'required | min:10 | max:11',
        'contracts' => 'array',
    ];
}