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

if (!function_exists('s_title')) {

    /**
     * @param $string
     * @return string
     */
    function s_title($string) {

        return  str_replace("_" , ' ',   str_replace("-" , ' ',  Str::title($string) )  ) ;
    }
}
