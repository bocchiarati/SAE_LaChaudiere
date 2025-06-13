<?php

namespace App\webui\providers\interfaces;

interface FormBuilderInterface {
    public function buildSignInForm(): array;
    public function buildRegisterForm(): array;
    public function buildCreateEventForm(): array;
    public function buildCategoriesForm(): array;
}