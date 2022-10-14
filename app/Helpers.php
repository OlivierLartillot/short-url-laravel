<?php

namespace App;

class Helpers 
{

    /**
     *  Création d'une chaine aléatoire de 5 caractères 
     */    
    public static function createShortened() 
    {
        $x = 0;
        $y = 5;
        $Strings = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomShortened = substr(str_shuffle($Strings), $x, $y);
        return $randomShortened;
    } 

}


