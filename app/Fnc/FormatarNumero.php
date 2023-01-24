<?php

namespace App\Fnc;

abstract class FormatarNumero
{
    public static function floatToBr($valor, $decimais = 2)
    {
        return number_format(isset($valor) ? $valor : 0, $decimais, ',', '.');
    }

    public static function brToFloat($valor, $decimais = 2)
    {
        return ($valor != "") ? (float) str_replace(',', '.', str_replace('.', '', $valor)) : 0;
    }

}
