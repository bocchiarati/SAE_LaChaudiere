<?php

namespace App\webui\actions;


use App\webui\providers\interfaces\AuthnProviderInterface;
use App\webui\providers\interfaces\FormBuilderInterface;
use App\webui\actions\abstract\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;


/**
 * Contrôleur pour obtenir le formualire de création d'un événement.
 */
class GetCreateEventAction extends AbstractAction
{
    private FormBuilderInterface $formBuilder;
    private AuthnProviderInterface $authnProvider;
    public function __construct(FormBuilderInterface $formBuilder, AuthnProviderInterface $authnProvider) {
        $this->authnProvider = $authnProvider;
        $this->formBuilder = $formBuilder;
    }
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
        return $twig->render($response, 'form/index.html.twig', [
            "form" => $this->formBuilder->buildCreateEventForm(),
        ]);
    }
}