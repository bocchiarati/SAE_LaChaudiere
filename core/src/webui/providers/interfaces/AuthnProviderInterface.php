<?php

namespace App\webui\providers\interfaces;

use Slim\Psr7\Response;
use Slim\Psr7\Request;

interface AuthnProviderInterface {
    public function getSignedInUser(): ?array;
    public function signin($email, $mdp);
    public function signout() : void;
    public function verifyUser(Response $response, Request $request) : ?Response;
    public function isSudo() : bool;
    }