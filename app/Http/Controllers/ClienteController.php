<?php

namespace App\Http\Controllers;

use App\Contracts\ICliente;
use App\Http\Requests\ClienteFormRequest;
use App\Http\Requests\ClienteUpdateFormRequest;
use App\Http\Resources\ClienteCollection;
use App\Http\Resources\ClienteResource;
use Symfony\Component\HttpFoundation\Response;

class ClienteController extends Controller
{
    private $model;

    public function __construct(ICliente $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return new ClienteCollection($this->model->findAll());
    }

    public function store(ClienteFormRequest $request)
    {
        $this->model->store($request->all());
        return response('', Response::HTTP_CREATED);
    }

    public function show($id)
    {
        return response()->json(new ClienteResource($this->model->findOne($id)));
    }

    public function update(ClienteUpdateFormRequest $request, $id)
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
