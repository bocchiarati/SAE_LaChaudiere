<?php

namespace App\application_core\application\useCases\interfaces;

interface AppServiceInterface {
    public function getCategory(): array;
    public function creerCategory(string $libelle, string $description): array;
}