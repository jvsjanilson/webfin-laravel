<?php

namespace App\Http\Controllers;

use App\Contracts\EstadoInterface;
use App\Http\Requests\EstadoFormRequest;
use App\Http\Requests\EstadoUpdateFormRequest;
use App\Http\Resources\EstadoCollection;
use App\Http\Resources\EstadoResource;

use Symfony\Component\HttpFoundation\Response;

class EstadoController extends Controller
{

    private $model;

    public function __construct(EstadoInterface $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $regs = $this->model->findAll();
        return new EstadoCollection($regs);
    }

    public function store(EstadoFormRequest $request)
    {
        $this->model->store($request->all());
        return response('', Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $reg = $this->model->findOne($id);
        return response()->json(new EstadoResource($reg));
    }

    public function update(EstadoUpdateFormRequest $request, $id)
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
