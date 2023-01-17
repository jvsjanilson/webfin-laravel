<?php

namespace App\Http\Controllers;

use App\Exceptions\ExceptionErrorCreate;
use App\Exceptions\ExceptionErrorDestroy;
use App\Exceptions\ExceptionErrorUpdate;
use App\Exceptions\ExceptionNotFound;
use App\Http\Requests\FornecedorFormRequest;
use App\Http\Requests\FornecedorUpdateFormRequest;
use App\Http\Resources\FornecedorCollection;
use App\Http\Resources\FornecedorResource;
use App\Models\Fornecedor;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FornecedorController extends Controller
{
    private $model;

    public function __construct(Fornecedor $model)
    {
        $this->model = $model;
    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regs = $this->model->paginate(config('app.paginate'));
        return new FornecedorCollection($regs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FornecedorFormRequest $request)
    {
        $data = $request->all();
        try {
            $this->model->create($data);
            return response('', Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            throw new ExceptionErrorCreate();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reg = $this->model->find($id);
        if (!isset($reg))
            throw new ExceptionNotFound();

        return response()->json(new FornecedorResource($reg));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FornecedorUpdateFormRequest $request, $id)
    {
        $reg = $this->model->find($id);
        $data = $request->all();



        if (!isset($reg)) {
            throw new ExceptionNotFound();
        }

        if (count($data) == 0) {
            throw new ExceptionErrorUpdate("Formado de dados passado invalido(s).");
        }

        try {
            $reg->update($data);
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Throwable $th) {
            throw new ExceptionErrorUpdate();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->model->find($id)->delete();
            return response(null, Response::HTTP_NO_CONTENT);
        } catch (\Throwable $th) {
            throw new ExceptionErrorDestroy();
        }
    }
}
