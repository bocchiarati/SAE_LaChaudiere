<?php

namespace App\webui\actions;


use App\application_core\application\useCases\interfaces\AppServiceInterface;
use App\webui\actions\abstract\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

/**
 * Crée un nouvel événement personnalisé et retourne une réponse JSON
 */
class PostCreateEventAction extends AbstractAction {

    private AppServiceInterface $appService;

    public function __construct(AppServiceInterface $appService)
    {
        $this->appService = $appService;
    }
    
    public function __invoke(Request $request, Response $response, array $args): \Psr\Http\Message\ResponseInterface
    {
        $data = $request->getParsedBody();
        $category_id = $data['category_id'];
        $events = $this->appService->getEventsByCategory($category_id);
        return $twig->render($response, 'event/index.html.twig', [
            "eventsByDate" => $events,
            "form" => $this->formBuilder->buildSelectCategory(),
            "token" => $this->csrfProvider->generate()
        ]);
    }
}