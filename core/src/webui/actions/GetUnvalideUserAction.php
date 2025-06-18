<?php

namespace App\webui\actions;


use App\webui\actions\abstract\AbstractAction;
use App\webui\providers\interfaces\AuthnProviderInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

/**
 * Contrôleur de la page d'accueil de l'application.
 */
class GetUnvalideUserAction extends AbstractAction {
    public function __construct(private AuthnProviderInterface $authnProvider) {}
    public function __invoke(Request $request, Response $response, array $args) {
        $twig = Twig::fromRequest($request);
        $redirection = $this->authnProvider->verifyUser();
        if ($redirection !== null) {
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $url = $routeParser->urlFor($redirection);

            return $response
                ->withHeader('Location', $url)
                ->withStatus(302);
        }
        return $twig->render($response,'unvalide_user/index.html.twig');
    }
}