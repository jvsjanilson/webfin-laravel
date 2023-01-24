<?php

namespace App\Fnc;

abstract class FormatarData
{
    public static function dateToBr($data, $formato = 'd/m/Y')
    {
        return is_null($data) ? '' : date($formato,  strtotime($data));
    }

    public static function brToDate($data)
    {
        return ($data != "") ? date('Y-m-d',  strtotime(str_replace('/', '-', $data))) : date('Y-m-d');

    }

}
