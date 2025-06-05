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

    public function creerCategory(string $libelle, string $description): array{
        try{
            $category = new Category();
            $category->label = $libelle;
            $category->description = $description;

            $category->save();

            return $category->toArray();
        } catch(\Exception $e) {
            throw new DatabaseException("Erreur lors de la création de la box vide: " . $e->getMessage());
        }
    }
}