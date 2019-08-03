<?php

namespace App\Repositories;

use Illuminate\Http\Request;

use App\Repositories\PartsRepositoryInterface;
use App\Models\Parts;

class PartsRepositoryEloquent implements PartsRepositoryInterface 
{
    private $model;

    public function __construct(Parts $parts) {
        $this->model = $parts;
    }
    
    public function getAll() {
        return $this->model->all();
    }

    public function get($id) {
        return $this->model->where('id', $id)->with('contracts')->get();
    }

    public function store(Request $request) {
        $part = $this->model->create($request->all());
        $part->contracts()->attach($request['contracts']);
        return $this->get($part->id);
    }

    public function update(Request $request) {
        $id = $request['id'];
        $this->model->find($id)->update($request->all());
        $this->model->find($id)->contracts()->sync($request['contracts']);
        return $this->get($id);
    }

    public function destroy($id) {
        return $this->model->find($id)->delete();
    }

}