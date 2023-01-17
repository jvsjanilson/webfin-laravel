<?php

namespace App\Fnc;

abstract class Validador
{
    public static function cpfcnpj($documento) {
        $validador = new ValidadorCPFCNPJ($documento);
        return $validador->valida();
    }

}
