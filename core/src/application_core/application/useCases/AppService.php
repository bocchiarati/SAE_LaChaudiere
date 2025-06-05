<?php

namespace App\application_core\application\useCases;

use App\application_core\application\exceptions\DatabaseException;
use App\application_core\application\useCases\interfaces\AppServiceInterface;
use App\application_core\domain\entities\Category;

class AppService implements AppServiceInterface{

    public function getCategory(): array{
        try{
            return Category::all()->toArray();
        } catch(\Throwable $e){
            throw new DatabaseException("Erreur lors de la récupération de la catégorie par son identifiant.");
        }
    }
}