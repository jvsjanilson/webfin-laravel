<?php

namespace App\Http\Controllers;

use App\Exceptions\ExceptionErrorBaixa;
use App\Exceptions\ExceptionErrorCreate;
use App\Exceptions\ExceptionErrorDestroy;
use App\Exceptions\ExceptionErrorEstorno;
use App\Exceptions\ExceptionErrorUpdate;
use App\Exceptions\ExceptionNotFound;
use App\Http\Requests\ContaPagarFormRequest;
use App\Http\Requests\ContaPagarUpdateFormRequest;
use App\Http\Resources\ContaPagarCollection;
use App\Http\Resources\ContaPagarResource;
use App\Models\ContaPagar;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContaPagarController extends Controller
{

    private $model;

    public function __construct(ContaPagar $model)
    {
        $this->model = $model;
    }


    public function index()
    {
        $regs = $this->model->paginate(config('app.paginate'));
        return new ContaPagarCollection($regs);
    }

    public function store(ContaPagarFormRequest $request)
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

        return response()->json(new ContaPagarResource($reg));
    }

    public function update(ContaPagarUpdateFormRequest $request, $id)
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

    public function baixar(Request $request, $id)
    {
        $request->validate([
            'data_pagamento' => 'required'
        ]);

        $data = $request->only('juros', 'multa', 'desconto', 'data_pagamento');

        $reg = $this->model->find($id);

        if (!isset($reg))
            throw new ExceptionNotFound();
        else
        {
            if (isset($reg->data_pagamento))
                throw new ExceptionErrorBaixa();
        }

        $reg->juros          = isset($data['juros']) ? $data['juros'] : 0;
        $reg->multa          = isset($data['multa']) ? $data['multa'] : 0;
        $reg->desconto       = isset($data['desconto']) ? $data['desconto'] : 0;
        $reg->data_pagamento = $data['data_pagamento'];

        $valor_pago = ($reg->valor + $reg->juros + $reg->multa-$reg->desconto);

        if ($reg->conta->saldo < $valor_pago)
            throw new ExceptionErrorBaixa("Saldo Insuficiente");

        try {
            $reg->save();
            $reg->conta->saldo -= $valor_pago;
            $reg->conta->save();
        } catch (\Throwable $th) {
            throw new ExceptionErrorUpdate();
        }
    }

    public function estornar($id)
    {
        $reg = $this->model->find($id);

        if (!isset($reg))
            throw new ExceptionNotFound();

        if (!isset($reg->data_pagamento))
            throw new ExceptionErrorEstorno("Título já estornado.");

        try {
            $reg->data_pagamento = null;
            $valor_pago     = ($reg->valor + $reg->juros + $reg->multa-$reg->desconto);
            $reg->juros     = 0;
            $reg->multa     = 0;
            $reg->desconto  = 0;
            $reg->save();
            $reg->conta->saldo += $valor_pago;
            $reg->conta->save();

        } catch (\Throwable $th) {
            throw new ExceptionErrorEstorno();
        }
    }
}
