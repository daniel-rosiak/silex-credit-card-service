<?php

namespace App\Utils;


class CheckFormatUtil
{
    /**
     * @param $string
     * @return bool
     */
    public static function isXml($string)
    {
        libxml_use_internal_errors(TRUE);

        $doc = simplexml_load_string($string);

        return !$doc === TRUE ? FALSE : TRUE;
    }

    /**
     * @param $string
     * @return bool
     */
    public static function  isJson($string)
    {
        return json_decode($string) && (json_last_error() == JSON_ERROR_NONE);
    }

}