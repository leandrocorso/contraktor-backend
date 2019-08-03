<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Repositories\ContractsRepositoryInterface;
use App\Models\Contracts;

class ContractsRepositoryEloquent implements ContractsRepositoryInterface 
{
    private $model;

    public function __construct(Contracts $contracts) {
        $this->model = $contracts;
        $this->filePath = base_path('public/storage/contracts');
    }
    
    // Get all contracts
    public function getAll() {
        return $this->model->all();
    }

    // Get a contract by ID (and the parts if exists)
    public function get($id) {
        return $this->model->where('id', $id)->with('parts')->get();
    }

    // Save a contract to dabase with the file
    public function store(Request $request) {

        if ($request->hasFile('file') && $request->file->isValid() ) {

            if ($filename = $this->uploadFile($request)) {
                $request['filename'] = $filename;

                $contract = $this->model->create($request->all());
                $contract->parts()->attach($request['parts']);
                
                return $contract;
            }

            return false;
        }

        return false;
    }

    // Update the contract
    public function update(Request $request) {

        if ($request->hasFile('file') && $request->file->isValid() ) {
            $this->deleteFile($request);
            $request['filename'] = $this->uploadFile($request);
        }

        $id = $request['id'];

        if ($contract = $this->model->find($id)) {
            $contract->update($request->all());
            $contract->parts()->sync($request['parts']);
            return $this->get($id);
        }

        return false;
    }

    // Delete a contract and file if it has sended
    public function destroy($id) {
        $contract = $this->model->find($id);
        if ($contract && $contract->filename) {
            $this->deleteFile($contract->filename);
            $contract->delete();
            return true;
        }
        return false;
    }

    // Upload file function
    public function uploadFile($request) {
        $name = kebab_case(time() .'_'. $request->title);
        $fName = substr($name, 0, 40);
        $fExt = $request->file->extension();
        $filename = "{$fName}.{$fExt}";

        $upload = $request->file('file')->move($this->filePath, $filename);
        return $upload ? $filename : false;
    }

    // Delete file function
    public function deleteFile($filename) {
        $file = "{$this->filePath}/{$filename}";
        return file_exists($file) ? unlink($file) : false;
    }

}