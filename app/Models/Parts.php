<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parts extends Model
{
    protected $table = 'parts';

    protected $fillable = [
        'firstname', 
        'lastname', 
        'email', 
        'document',
        'phone',
    ];

    public function contracts() {
        return $this->belongsToMany(Contracts::class);
    }
}