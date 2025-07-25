<?php

namespace App\application_core\application\auth\interfaces;

interface AuthnServiceInterface {
    public function register($email, $mdp);
    public function verifyCredentials($email, $mdp): bool;
}