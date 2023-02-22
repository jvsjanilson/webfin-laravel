<?php

namespace App\Http\Controllers;

use App\Contracts\IContaPagar;
use App\Http\Requests\ContaPagarBaixaFormRequest;
use App\Http\Requests\ContaPagarFormRequest;
use App\Http\Requests\ContaPagarUpdateFormRequest;
use App\Http\Resources\ContaPagarCollection;
use App\Http\Resources\ContaPagarResource;
use Symfony\Component\HttpFoundation\Response;

class ContaPagarController extends Controller
{
    private $model;

    public function __construct(IContaPagar $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return new ContaPagarCollection($this->model->findAll());
    }

    public function store(ContaPagarFormRequest $request)
    {
        $this->model->store($request->all());
        return response('', Response::HTTP_CREATED);
    }

    public function show($id)
    {
       return response()->json(new ContaPagarResource($this->model->findOne($id)));
    }

    public function update(ContaPagarUpdateFormRequest $request, $id)
    {
        $this->model->update($request->all(), $id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function destroy($id)
    {
        $this->model->destroy($id);
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function baixar(ContaPagarBaixaFormRequest $request, $id)
    {
        $data = $request->only('juros', 'multa', 'desconto', 'data_pagamento', 'conta_id');
        $this->model->baixar($data, $id);
    }

    public function estornar($id)
    {
        $this->model->estornar($id);
    }

    public function findByDocumento($documento)
    {
        $reg = $this->model->findByDocumento($documento);

        return response()->json($reg);
    }
}
