<?php

namespace App\webui\providers\interfaces;

interface AuthnProviderInterface {
    public function getSignedInUser(): ?array;
    public function signin($email, $mdp, $id);
    public function signout() : void;
}