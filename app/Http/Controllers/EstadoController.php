<?php

namespace App\Http\Controllers;

use App\Exceptions\ExceptionErrorCreate;
use App\Exceptions\ExceptionErrorDestroy;
use App\Exceptions\ExceptionErrorUpdate;
use App\Models\Estado;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regs = Estado::paginate(config('app.paginate'));
        return response()->json($regs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('uf','nome', 'ativo');
        try {
            Estado::create($data);
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
        $reg = Estado::find($id);
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
        $reg = Estado::find($id);
        $data = $request->only('uf', 'nome', 'ativo');

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
            Estado::find($id)->delete();
            return response('');
        } catch (\Throwable $th) {
            throw new ExceptionErrorDestroy();
        }
    }
}
