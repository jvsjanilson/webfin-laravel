<?php

namespace App\Http\Controllers;

use App\Exceptions\ExceptionErrorCreate;
use App\Exceptions\ExceptionErrorDestroy;
use App\Exceptions\ExceptionErrorUpdate;
use App\Http\Resources\CidadeCollection;
use App\Models\Cidade;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regs = Cidade::paginate(config('app.paginate'));
        return new CidadeCollection($regs);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('nome', 'estado_id', 'capital', 'ativo');
        try {
            Cidade::create($data);
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
        $reg = Cidade::find($id);
        return response()->json($reg);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reg = Cidade::find($id);
        $data = $request->only('nome', 'estado_id', 'capital', 'ativo');

        if (!isset($reg)) {
            return response()->json(['message' => 'Registro não encontrado.'], Response::HTTP_NOT_FOUND);
        }

        try {
            $reg->update($data);
            return response()->json([]);
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
            Cidade::find($id)->delete();
            return response('');
        } catch (\Throwable $th) {
            throw new ExceptionErrorDestroy();
        }
    }
}
