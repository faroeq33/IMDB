<?php
namespace IMDB;

class MovieHelper
{
    public static function replaceSpaces( $input ){
        $replaceChars = [' '];
        return str_replace($replaceChars,'_', $input);
    }
}