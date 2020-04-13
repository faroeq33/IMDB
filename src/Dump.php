<?php
namespace IMDB;

class Dump
{
    public static function printR( $arrayOrObject )
    {
        echo "<pre>"; print_r( $arrayOrObject ); echo "</pre>";
    }

    public static function varDump( $arrayOrObject )
    {
        echo "<pre>"; var_dump( $arrayOrObject ); echo "</pre>";
    }
}