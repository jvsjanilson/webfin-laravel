<?php

namespace App\Http\Controllers;

use App\Contracts\IConta;
use App\Http\Requests\ContaFormRequest;
use App\Http\Requests\ContaUpdateFormRequest;
use App\Http\Resources\ContaCollection;
use App\Http\Resources\ContaResource;
use Symfony\Component\HttpFoundation\Response;

class ContaController extends Controller
{
    private $model;

    public function __construct(IConta $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return new ContaCollection($this->model->findAll());
    }

    public function store(ContaFormRequest $request)
    {
        $this->model->store($request->all());
        return response('', Response::HTTP_CREATED);
    }

    public function show($id)
    {
        return response()->json(new ContaResource($this->model->findOne($id)));
    }

    public function update(ContaUpdateFormRequest $request, $id)
    {
        $this->model->update($request->all(), $id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function destroy($id)
    {
        $this->model->destroy($id);
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
