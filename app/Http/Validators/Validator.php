<?php

namespace App\Http\Validators;

abstract class Validator
{
    abstract public static function rules();

    public static function parse_query_ids(?string $param)
    {   
        return ( !is_null($param) && !!strlen($param) )
            ? collect(explode(',', $param))->map(fn($item) => (int) $item)->toArray()
            : null;
    }
}