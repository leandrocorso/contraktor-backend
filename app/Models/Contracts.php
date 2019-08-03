<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
    protected $table = 'contracts';

    protected $fillable = [
        'title', 
        'filename',
        'effectiveDate', 
        'expirationDate', 
    ];

    public function parts() {
        return $this->belongsToMany(Parts::class);
    }
}