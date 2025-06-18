<?php

namespace App\webui\actions;


use App\application_core\application\useCases\interfaces\AppServiceInterface;
use App\webui\providers\interfaces\AuthnProviderInterface;
use App\webui\actions\abstract\AbstractAction;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

/**
 * Crée un nouvel événement personnalisé et retourne une réponse JSON
 */
class PostPublishEventAction extends AbstractAction {

    private AppServiceInterface $appService;
    private AuthnProviderInterface $authnProvider;
    public function __construct(AppServiceInterface $appService, AuthnProviderInterface $authnProvider)
    {
        $this->appService = $appService;
        $this->authnProvider = $authnProvider;
    }

    public function __invoke(Request $request, Response $response, array $args): ResponseInterface
    {
        $redirection = $this->authnProvider->verifyUser();
        if ($redirection !== null) {
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $url = $routeParser->urlFor($redirection);

            return $response
                ->withHeader('Location', $url)
                ->withStatus(302);
        }

        $data = $request->getParsedBody();
        $id_event = $data['event_id'];

        $this->appService->publishEvent($id_event);

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('events');

        return $response
            ->withHeader('Location', $url)
            ->withStatus(302);
    }
}
