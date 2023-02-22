<?php

namespace App\Repositories;

use App\Contracts\IContaPagar;
use App\Exceptions\ExceptionErrorBaixa;
use App\Exceptions\ExceptionErrorEstorno;
use App\Exceptions\ExceptionErrorUpdate;
use App\Exceptions\ExceptionNotFound;
use App\Models\Conta;
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
        $conta_id            = isset($data['conta_id']) ? (int)$data['conta_id'] : 0;
        $reg->data_pagamento = $data['data_pagamento'];


        $valor_pago = ($reg->valor + $reg->juros + $reg->multa-$reg->desconto);

        if ($conta_id == 0) {
            if ($reg->conta->saldo < $valor_pago)
                throw new ExceptionErrorBaixa("Saldo Insuficientes");
        } else {
            $conta = Conta::find($conta_id);
            if ($conta->saldo < $valor_pago)
                throw new ExceptionErrorBaixa("Saldo Insuficiente");
        }

        try {
            
             if ($conta_id == 0) {
                $reg->conta->saldo -= $valor_pago;
                $reg->conta->save();
                $reg->save();
            } else {
                 $conta->saldo -= $valor_pago;
                 $conta->save();
                 $reg->conta_id = $conta->id;
                 $reg->save();
            }
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

    public function findAll()
    {
        $search = request()->nome;

        $regs =  $this->model->select('conta_pagars.*', 'fornecedors.nome')
            ->join('fornecedors', 'fornecedors.id', '=', 'conta_pagars.fornecedor_id')
            ->when($search != "", function($q) use ($search) {
                $q->where(function($query) use ($search) {
                    $query->where('conta_pagars.documento', 'like', '%'. $search.'%');
                    $query->orWhere('fornecedors.nome', 'like',  '%'. $search.'%');

                });
            })
            ->orderBy('conta_pagars.id', 'desc')->paginate(config('app.paginate'));
        return $regs;
    }

    public function findByDocumento($documento)
    {
        $id = request()->id;

        $reg = $this->model->select('documento')
            ->when(isset($id), function($q) use ($id) {
                $q->where(function($query) use ($id) {
                    $query->where('id', '<>', $id);
                });
            })
            ->where('documento', $documento)
            ->first();
        return $reg;
    }
}
