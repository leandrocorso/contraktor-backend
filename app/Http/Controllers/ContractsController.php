<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ContractsService;

class ContractsController extends Controller 
{

    private $service;

    public function __construct(ContractsService $service)
    {
        $this->service = $service;
    }

    public function getAll() {
        return $this->service->getAll();
    }

    public function get($id) {
        return $this->service->get($id);
    }

    public function store(Request $request) {
        return $this->service->store($request);
    }

    public function update(Request $request) {
        return $this->service->update($request);
    }

    public function destroy($id) {
        return $this->service->destroy($id);
    }

}
