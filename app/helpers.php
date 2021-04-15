<?php

class StringUtilities
{
    public static function get_acronym($string)
    {

        $res = "";

        if(preg_match_all('/\b(\w)/',strtoupper($string),$m)) {
            $res = implode('',$m[1]); // $v is now SOQTU
        }

        return $res;
    }
}

?>