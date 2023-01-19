<?php

namespace App\Http\Controllers;

use App\Exceptions\ExceptionErrorCreate;
use App\Exceptions\ExceptionErrorDestroy;
use App\Exceptions\ExceptionErrorUpdate;
use App\Exceptions\ExceptionNotFound;
use App\Http\Requests\ContaReceberFormRequest;
use App\Http\Requests\ContaReceberUpdateFormRequest;
use App\Http\Resources\ContaReceberCollection;
use App\Http\Resources\ContaReceberResource;
use App\Models\ContaReceber;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContaReceberController extends Controller
{

    private $model;

    public function __construct(ContaReceber $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $regs = $this->model->paginate(config('app.paginate'));
        return new ContaReceberCollection($regs);
    }

    public function store(ContaReceberFormRequest $request)
    {
        $data = $request->all();
        try {
            $this->model->create($data);
            return response('', Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            throw new ExceptionErrorCreate($th->getMessage());
        }
    }

    public function show($id)
    {
        $reg = $this->model->find($id);

        if (!isset($reg))
            throw new ExceptionNotFound();

        return response()->json(new ContaReceberResource($reg));
    }

    public function update(ContaReceberUpdateFormRequest $request, $id)
    {
        $reg = $this->model->find($id);
        $data = $request->all();

        if (!isset($reg)) {
            throw new ExceptionNotFound();
        }

        if (count($data) == 0) {
            throw new ExceptionErrorUpdate("Formado de dados passado inválido(s).");
        }

        try {
            $reg->update($data);
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Throwable $th) {
            throw new ExceptionErrorUpdate();
        }
    }

    public function destroy($id)
    {
        try {
            $this->model->destroy($id);
            return response(null, Response::HTTP_NO_CONTENT);
        } catch (\Throwable $th) {
            throw new ExceptionErrorDestroy();
        }
    }
}
