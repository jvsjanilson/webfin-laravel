<?php

namespace App\Repositories;

use App\Contracts\IContaPagar;
use App\Exceptions\ExceptionErrorBaixa;
use App\Exceptions\ExceptionErrorEstorno;
use App\Exceptions\ExceptionErrorUpdate;
use App\Exceptions\ExceptionNotFound;
use App\Models\ContaPagar;

class ContaPagarImpl extends AbstractRepos implements IContaPagar
{
    public $model;

    public function __construct(ContaPagar $model)
    {
        $this->model = $model;
    }

    public function baixar($data, $id)
    {
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
