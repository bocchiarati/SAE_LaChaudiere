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

    public function getEventsSortByDate(): array {
        try {
            return Event::with('category')
                ->orderBy('start_date', 'asc')
                ->get()
                ->groupBy((function ($event) {
                    return \Carbon\Carbon::parse($event->start_date)->format('Y-m-d');
                }))
                ->toArray();
        } catch (\Throwable $e) {
            throw new DatabaseException("Erreur lors de la récupération des évenements par date croissante");
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
            throw new DatabaseException("Erreur lors de l'insertion de la catégorie " . $e->getMessage());
        }
    }

    public function createEvent(String $title, String $description, float $price, String $start_date, ?String $end_date, int $category_id, bool $is_published, String $user_id): array {
        try {
            $event = new Event();
            $event->title = $title;
            $event->description = empty($description) ? null : $description;
            $event->price = $price;
            $event->start_date = $start_date;
            $event->end_date = empty($end_date) ? null : $end_date;
            $event->time = empty($time) ? null : $time;
            $event->category_id = $category_id;
            $event->is_published = $is_published;
            $event->user_id = $user_id;

            $event->save();

            return $event->toArray();
        } catch (\Exception $e) {
            throw new DatabaseException("Erreur lors de la création de l'événement : " . $e->getMessage());
        }
    }


}