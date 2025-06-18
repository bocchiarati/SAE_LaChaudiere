<?php

namespace App\webui\actions;


use App\application_core\application\useCases\interfaces\AppServiceInterface;
use App\webui\providers\interfaces\AuthnProviderInterface;
use App\webui\actions\abstract\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;


/**
 * Contrôleur pour obtenir la liste des événement triés par date
 */
class GetEventsAction extends AbstractAction
{
    private AppServiceInterface $appService;
    private AuthnProviderInterface $authnProvider;
    public function __construct(AppServiceInterface $appService, AuthnProviderInterface $authnProvider) {
        $this->authnProvider = $authnProvider;
        $this->appService = $appService;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $twig = Twig::fromRequest($request);
        $redirection = $this->authnProvider->verifyUser();
        if ($redirection !== null) {
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $url = $routeParser->urlFor($redirection);

            return $response
                ->withHeader('Location', $url)
                ->withStatus(302);
        }
        $events = $this->appService->getEventsSortByDate();
        $categories = $this->appService->getCategories();

        return $twig->render($response, 'event/index.html.twig', [
            "eventsByDate" => $events,
            "categories" => $categories
        ]);
    }
}