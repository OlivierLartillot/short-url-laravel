<?php

namespace App\Models;

use App\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = ["url", "shortened"];

    /**
     * Création du "shortened" unique
     * Vérification que cela n'existe pas déjà dans la bdd
     */
    public static function getUniqueShortUrl()
    {
        // renvoie la chaine de 5 caractères => Wx2cd
        $randomShortened = Helpers::createShortened();
        
        // Si l'url existe
        if (static::where('shortened', $randomShortened)->count()!=0) {
            return static::getUniqueShortUrl();
        }
        return $randomShortened;
    }


}
