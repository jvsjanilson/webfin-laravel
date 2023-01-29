<?php

namespace App\Http\Controllers;

use App\Contracts\IContaReceber;
use App\Http\Requests\ContaReceberBaixaFormRequest;
use App\Http\Requests\ContaReceberFormRequest;
use App\Http\Requests\ContaReceberUpdateFormRequest;
use App\Http\Resources\ContaReceberCollection;
use App\Http\Resources\ContaReceberResource;
use Symfony\Component\HttpFoundation\Response;

class ContaReceberController extends Controller
{
    private $model;

    public function __construct(IContaReceber $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return new ContaReceberCollection($this->model->findAll());
    }

    public function store(ContaReceberFormRequest $request)
    {
        $this->model->store($request->all());
        return response('', Response::HTTP_CREATED);
    }

    public function show($id)
    {
        return response()->json(new ContaReceberResource($this->model->findOne($id)));
    }

    public function update(ContaReceberUpdateFormRequest $request, $id)
    {
        $this->model->update($request->all(), $id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function destroy($id)
    {
        $this->model->destroy($id);
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function baixar(ContaReceberBaixaFormRequest $request, $id)
    {
        $data = $request->only('juros', 'multa', 'desconto', 'data_pagamento');
        $this->model->baixar($data, $id);
    }

    public function estornar($id)
    {
        $this->model->estornar($id);
    }
}
