<?php


namespace IMDB;


class Helper
{
    public static function replaceChars( $input ){
        $replaceChars = [' '];
        $cleanedInput = str_replace($replaceChars,'_', $input);
        return $cleanedInput;
    }
}