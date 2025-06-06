<?php

namespace App\application_core\application\useCases\interfaces;

interface AppServiceInterface {
    public function getCategories(): array;
    public function getEventsByCategory($category_id): array;
    public function createEvent(String $title, String $description, int $price, String $start_date, String $end_date, String $time, int $category_id, bool $is_published, int $user_id): array;
    public function creerCategory(string $libelle, string $description): array;
}