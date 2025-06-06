<?php

namespace App\application_core\application\useCases;

use App\application_core\application\exceptions\DatabaseException;
use App\application_core\application\useCases\interfaces\AppServiceInterface;
use App\application_core\domain\entities\Category;
use App\application_core\domain\entities\Event;

class AppService implements AppServiceInterface{

    public function getCategories(): array{
        try{
            return Category::all()->toArray();
        } catch(\Throwable $e){
            throw new DatabaseException("Erreur lors de la récupération de toutes les Categories.");
        }
    }

    public function getEventsByCategory($category_id): array{
        try {
            return Event::where("category_id", "=", $category_id)->get()->toArray();
        } catch (\Throwable $e) {
            throw new DatabaseException("Erreur lors de la récupération des évenements d'une catégorie");
        }
    }

    public function creerCategory(string $libelle, string $description): array{
        try{
            $category = new Category();
            $category->label = '##' . $libelle;
            $category->description = '**' . $description . '**';

            $category->save();

            return $category->toArray();
        } catch(\Exception $e) {
            throw new DatabaseException("Erreur lors de l'insertion de la Catgory " . $e->getMessage());
        }
    }

    public function createEvent(String $title, String $description, int $price, String $start_date, String $end_date, String $time, int $category_id, bool $is_published, int $user_id): array {
        try {
            $event = new Event();
            $event->id = \Ramsey\Uuid\Uuid::uuid4()->toString();
            $event->title = $title;
            $event->description = $description;
            $event->price = $price;
            $event->start_date = $start_date;
            $event->end_date = $end_date;
            $event->time = $time;
            $event->category_id = $category_id;
            $event->is_published = $is_published;
            $event->user_id = $user_id;

            $event->save();

            return $event->toArray();
        } catch (\Exception $e) {
            throw new DatabaseException("Erreur lors de la création de la box vide: " . $e->getMessage());
        }
    }

}