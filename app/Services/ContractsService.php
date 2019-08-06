<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

use App\Repositories\ContractsRepositoryInterface;
use App\Models\ContractsValidator;

class ContractsService
{
    private $repo;

    public function __construct(ContractsRepositoryInterface $repo)
    {
        $this->repo = $repo;
        $this->filePath = base_path('public/storage/contracts');
    }

    public function downloadPath() {
      return $this->filePath;
    }

    public function getAll() {

        try {
            $contracts = $this->repo->getAll();
            return (count($contracts) > 0)
                ? response()->json($contracts, Response::HTTP_OK)
                : response()->json([], Response::HTTP_OK);

        } catch (QueryException $exception) {
            $message = ['error' => 'Não foi possível retornar os contratos'];
            return response()->json($message, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function get($id) {

        try {
            $contract = $this->repo->get($id);
            return ($contract)
                ? response()->json($contract, Response::HTTP_OK)
                : response()->json(null, Response::HTTP_OK);

        } catch (QueryException $exception) {
            $message = ['error' => 'Não foi possível retornar o contrato'];
            return response()->json($message, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), ContractsValidator::RULES);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        try {
            $contract = $this->repo->store($request);
            return response()->json($contract, Response::HTTP_CREATED);

        } catch (QueryException $exception) {
            $message = ['error' => 'Não foi possível inserir o contrato'];
            return response()->json($message, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request) {

        $validator = Validator::make($request->all(), ContractsValidator::updateRules($request));

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        try {
            $contract = $this->repo->update($request);
            return response()->json($contract, Response::HTTP_OK);

        } catch (QueryException $exception) {
            $message = ['error' => 'Não foi possível atualizar o contrato'];
            return response()->json($message, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id) {

        $validator = Validator::make(['id' => $id], ContractsValidator::DELETE_RULES);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        try {
            $contract = $this->repo->destroy($id);
            return response()->json(null, Response::HTTP_OK);

        } catch (QueryException $exception) {
            $message = ['error' => 'Não foi possível excluir o contrato'];
            return response()->json($message, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
