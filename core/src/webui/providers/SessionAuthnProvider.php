<?php

namespace App\webui\providers;

use app\application_core\application\useCases\interfaces\AuthnServiceInterface;
use App\application_core\domain\entities\User;
use App\webui\providers\interfaces\AuthnProviderInterface;

class SessionAuthnProvider implements AuthnProviderInterface {
    private AuthnServiceInterface $authnService;
    public function __construct(AuthnServiceInterface $authnService) {
        $this->authnService = $authnService;
    }

    public function getSignedInUser(): ?array {
        if (isset($_SESSION["email"])) {
            $email = $_SESSION["email"];
            return User::where('user_id', '=', $email)->first()->toArray();
        } else {
            return null;
        }
    }

    public function signin($email,$mdp) {
        if($this->authnService->verifyCredentials($email, $mdp)) {
            $_SESSION["email"] = $email;
        }
    }

    public function signout(): void {
        session_unset();
    }
}