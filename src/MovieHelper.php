<?php
namespace IMDB;

class MovieHelper
{
    public static function replaceSpaces( $input )
    {
        $replaceChars = [' '];
        return str_replace($replaceChars,'_', $input);
    }

    public static function isImdbId( $input )
    {
        if ( preg_match("/^tt/", $input ) )
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}