<?php

namespace App\Http\Controllers;

use App\Contracts\IFornecedor;
use App\Http\Requests\FornecedorFormRequest;
use App\Http\Requests\FornecedorUpdateFormRequest;
use App\Http\Resources\FornecedorCollection;
use App\Http\Resources\FornecedorResource;
use Symfony\Component\HttpFoundation\Response;

class FornecedorController extends Controller
{
    private $model;

    public function __construct(IFornecedor $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return new FornecedorCollection($this->model->findAll());
    }

    public function store(FornecedorFormRequest $request)
    {
        $this->model->store($request->all());
        return response('', Response::HTTP_CREATED);
    }

    public function show($id)
    {
        return response()->json(new FornecedorResource($this->model->findOne($id)));
    }

    public function update(FornecedorUpdateFormRequest $request, $id)
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
