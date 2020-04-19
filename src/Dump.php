<?php
namespace IMDB;

class Dump
{

    /**
     * @param $arrayOrObject
     * @param bool $die
     */
    public static function printR($arrayOrObject, bool $die )
    {
        echo "<pre>"; print_r( $arrayOrObject ); echo "</pre>";
        if ( $die === true ) {
            return die('end of script');
        }
    }

    public static function varDump( $arrayOrObject, bool $die)
    {
        echo "<pre>"; var_dump( $arrayOrObject ); echo "</pre>";
        if ( $die === true ) {
            return die('end of script');
        }
    }
}