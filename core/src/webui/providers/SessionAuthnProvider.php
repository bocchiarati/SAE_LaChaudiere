<?php

namespace App\webui\providers;

use App\application_core\application\auth\interfaces\AuthnServiceInterface;
use App\application_core\domain\entities\User;
use App\webui\providers\interfaces\AuthnProviderInterface;
use Slim\Psr7\Response;
use Slim\Psr7\Request;
use Slim\Routing\RouteContext;


class SessionAuthnProvider implements AuthnProviderInterface {
    private AuthnServiceInterface $authnService;
    public function __construct(AuthnServiceInterface $authnService) {
        $this->authnService = $authnService;
    }

    public function getSignedInUser(): ?array {
        if (isset($_SESSION["email"])) {
            $email = $_SESSION["email"];
            return User::where('email', '=', $email)->first()->toArray();
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

    public function verifyUser(Response $response, Request $request) : ?Response {
        if(!$this->isConnected()) {
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $url = $routeParser->urlFor('signin');
            return $response
                ->withHeader('Location', $url)
                ->withStatus(302);
        } else if(!$this->isAdmin()) {
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $url = $routeParser->urlFor('unvalide_user');
            return $response
                ->withHeader('Location', $url)
                ->withStatus(302);
        } else {
            return null;
        }
    }

    public function isSudo() : bool {
        if($this->isConnected()) {
            $user = $this->getSignedInUser();
            if($user["role"] == 1000) {
                return true;
            }
            return false;
        }
        return false;
    }

    private function isAdmin() : bool {
        if($this->isConnected()) {
            $user = $this->getSignedInUser();
            if($user["role"] == 100 || $user["role"] == 1000) {
                return true;
            }
            return false;
        }
        return false;
    }

    private function isConnected() : bool {
        if($this->getSignedInUser() !== null) {
            return true;    
        }
        return false;
    }
}