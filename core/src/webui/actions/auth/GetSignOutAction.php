<?php

namespace App\webui\actions\auth;

use App\webui\actions\abstract\AbstractAction;
use App\webui\providers\interfaces\AuthnProviderInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

class GetSignOutAction extends AbstractAction {
    private AuthnProviderInterface $authnProvider;
    public function __construct(AuthnProviderInterface $authnProvider) {
        $this->authnProvider = $authnProvider;
    }

    public function __invoke(Request $request, Response $response, array $args) {
        $redirection = $this->authnProvider->verifyUser();
        if ($redirection !== null) {
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $url = $routeParser->urlFor($redirection);

            return $response
                ->withHeader('Location', $url)
                ->withStatus(302);
        }
        
        $this->authnProvider->signOut();

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        // Générer l'URL depuis le nom de route
        $url = $routeParser->urlFor('homepage');
        // Rediriger
        return $response
            ->withHeader('Location', $url)
            ->withStatus(302);
    }
}