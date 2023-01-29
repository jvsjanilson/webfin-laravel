<?php

namespace App\Repositories;

use App\Contracts\IContaReceber;
use App\Exceptions\ExceptionErrorBaixa;
use App\Exceptions\ExceptionErrorEstorno;
use App\Exceptions\ExceptionErrorUpdate;
use App\Exceptions\ExceptionNotFound;
use App\Models\ContaReceber;

class ContaReceberImpl extends AbstractRepos implements IContaReceber
{
    public $model;

    public function __construct(ContaReceber $model)
    {
        $this->model = $model;
    }

    public function baixar($data, $id)
    {

        // $request->validate([
        //     'data_pagamento' => 'required'
        // ]);

        //$data = $request->only('juros', 'multa', 'desconto', 'data_pagamento');

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

        try {
            $reg->save();
            $reg->conta->saldo += $valor_pago;
            $reg->conta->save();
        } catch (\Throwable $th) {
            throw new ExceptionErrorUpdate($th->getMessage());
        }

    }
    public function estornar($id)
    {
        $reg = $this->model->find($id);

        if (!isset($reg))
            throw new ExceptionNotFound();

        if (!isset($reg->data_pagamento))
            throw new ExceptionErrorEstorno("Título já estornado.");

        $valor_pago     = ($reg->valor + $reg->juros + $reg->multa-$reg->desconto);

        if ($reg->conta->saldo < $valor_pago)
            throw new ExceptionErrorEstorno("Saldo Insuficiente");

        try {
            $reg->data_pagamento = null;
            $reg->juros     = 0;
            $reg->multa     = 0;
            $reg->desconto  = 0;
            $reg->save();
            $reg->conta->saldo -= $valor_pago;
            $reg->conta->save();

        } catch (\Throwable $th) {
            throw new ExceptionErrorEstorno();
        }
    }
}
