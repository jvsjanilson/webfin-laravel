<?php

namespace App\Http\Controllers;

use App\Contracts\ICidade;
use App\Http\Requests\CidadeFormRequest;
use App\Http\Requests\CidadeUpdateFormRequest;
use App\Http\Resources\CidadeCollection;
use App\Http\Resources\CidadeResource;
use Symfony\Component\HttpFoundation\Response;

class CidadeController extends Controller
{
    private $model;

    public function __construct(ICidade $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $regs = $this->model->findAll();
        return new CidadeCollection($regs);
    }

    public function store(CidadeFormRequest $request)
    {
        $this->model->store($request->all());
        return response('', Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $reg = $this->model->findOne($id);
        return response()->json(new CidadeResource($reg));
    }

    public function update(CidadeUpdateFormRequest $request, $id)
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
