<?php

namespace App\webui\actions;


use App\webui\actions\abstract\AbstractAction;
use App\webui\providers\interfaces\AuthnProviderInterface;
use App\webui\providers\SessionAuthnProvider;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

/**
 * Contrôleur de la page d'accueil de l'application.
 */
class GetHomeAction extends AbstractAction {

    public function __construct(private AuthnProviderInterface $provider){
    }
    public function __invoke(Request $request, Response $response, array $args) {
        $twig = Twig::fromRequest($request);
        return $twig->render($response,'home/index.html.twig');
    }
}