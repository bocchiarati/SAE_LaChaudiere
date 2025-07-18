<?php

namespace App\application_core\application\useCases\interfaces;

interface AppServiceInterface {
    public function getCategories(): array;
    public function getPublishedEvents(): array;
    public function createEvent(String $title, String $description, float $price, String $start_date, ?String $end_date, int $category_id, bool $is_published, String $user_id): array;
    public function getPublishedEventsByCategory($category_id): array;
    public function getEventById($id): array;
    public function getUser(string $email): array;
    public function creerCategory(string $libelle, string $description): array;
    public function getEventsSortByDate(): array;
    public function publishEvent(int $event_id): array;
}