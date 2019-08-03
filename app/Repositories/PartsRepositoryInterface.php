<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface PartsRepositoryInterface 
{
    public function getAll();
    public function get($id);
    public function store(Request $request);
    public function update(Request $request);
    public function destroy($id);
}