<?php

namespace App\application_core\application\useCases\interfaces;

interface AppServiceInterface {
    public function getCategories(): array;
    public function getEvents(): array;
    public function createEvent(String $title, String $description, float $price, String $start_date, String $end_date, String $time, int $category_id, bool $is_published, String $user_id): array;
    public function getEventsByCategory($category_id): array;
    public function getEventById($id): array;
    public function creerCategory(string $libelle, string $description): array;
}