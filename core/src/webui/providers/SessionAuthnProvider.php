<?php

namespace App\webui\providers;

use App\application_core\application\auth\interfaces\AuthnServiceInterface;
use App\application_core\domain\entities\User;
use App\webui\providers\interfaces\AuthnProviderInterface;

class SessionAuthnProvider implements AuthnProviderInterface {
    private AuthnServiceInterface $authnService;
    public function __construct(AuthnServiceInterface $authnService) {
        $this->authnService = $authnService;
    }

    public function getSignedInUser(): ?array {
        if (isset($_SESSION["id"])) {
            $id = $_SESSION["id"];
            return User::where('id', '=', $id)->first()->toArray();
        } else {
            return null;
        }
    }

    public function signin($email,$mdp, $id) {
        if($this->authnService->verifyCredentials($email, $mdp)) {
            $_SESSION["id"] = $id;
        }
    }

    public function signout(): void {
        session_unset();
    }
}