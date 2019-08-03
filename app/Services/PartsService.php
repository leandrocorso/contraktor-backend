<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

use App\Repositories\PartsRepositoryInterface;
use App\Models\PartsValidator;

class PartsService
{
    private $repo;

    public function __construct(PartsRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getAll() {
        
        try {
            $parts = $this->repo->getAll();
            return (count($parts) > 0) 
                ? response()->json($parts, Response::HTTP_OK)
                : response()->json([], Response::HTTP_OK);

        } catch (QueryException $exception) {
            $message = ['error' => 'Não foi possível retornar os partes'];
            return response()->json($message, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }

    public function get($id) {

        try {
            $part = $this->repo->get($id);
            return ($part) 
                ? response()->json($part, Response::HTTP_OK)
                : response()->json(null, Response::HTTP_OK);

        } catch (QueryException $exception) {
            $message = ['error' => 'Não foi possível retornar a parte'];
            return response()->json($message, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), PartsValidator::RULES);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        try {
            $part = $this->repo->store($request);
            return response()->json($part, Response::HTTP_CREATED);

        } catch (QueryException $exception) {
            $message = ['error' => 'Não foi possível inserir a parte'];
            return response()->json($message, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request) {

        $validator = Validator::make($request->all(), PartsValidator::RULES);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_BAD_REQUEST);
        }

        try {
            $part = $this->repo->update($request);
            return response()->json($part, Response::HTTP_OK);

        } catch (QueryException $exception) {
            $message = ['error' => 'Não foi possível atualizar a parte'];
            return response()->json($message, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id) {

        try {
            $this->repo->destroy($id);
            return response()->json(null, Response::HTTP_OK);

        } catch (QueryException $exception) {
            $message = ['error' => 'Não foi possível excluir a parte'];
            return response()->json($message, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
