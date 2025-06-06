<?php

namespace App\application_core\application\useCases\interfaces;

interface FormBuilderInterface {
    public function buildSignInForm(): array;
    public function buildRegisterForm(): array;
    public function buildCreateEventForm(): array;
    public function buildCategoriesForm(): array;
}