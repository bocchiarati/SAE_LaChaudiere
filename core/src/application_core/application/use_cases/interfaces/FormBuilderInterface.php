<?php

namespace app\application_core\application\useCases\interfaces;

interface FormBuilderInterface {
    public function buildSignInForm(): array;
    public function buildRegisterForm(): array;
}