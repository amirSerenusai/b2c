<?php

use Illuminate\Support\Str;

if (!function_exists('str_contains')) {
    /**
     * Returns a human readable file size
     *
     * @param $string
     * @param $part
     * @return string a string in human readable format
     *
     */
    function str_contains($string , $part)
    {

       return  Str::contains($string, $part);

    }
}
