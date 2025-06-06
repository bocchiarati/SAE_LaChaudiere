<?php

namespace App\webui\actions;


use App\application_core\application\useCases\interfaces\AppServiceInterface;
use App\webui\actions\Abstract\AbstractAction;
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

        $title = $data['title'];
        $description = $data['description'];
        $price = isset($data['price']) ? floatval($data['price']) : 0.0;
        $start_date = $data['start_date'];
        $end_date = $data['end_date'];
        $category_id = $data['selector'];
        $is_published = isset($data['is_published']) && $data['is_published'] === 'on';
        $user_id = 'a1b2c3d4-e5f6-7890-1234-56789abcdef0';

        if (!empty($start_date) && !empty($end_date) && strtotime($start_date) > strtotime($end_date)) {
            $response->getBody()->write("La date de début doit être supérieure à la date de fin.");
            return $response->withStatus(400);
        }

        $this->appService->createEvent($title, $description, $price, $start_date, $end_date, $category_id, $is_published, $user_id);

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('homepage');
        
        return $response
            ->withHeader('Location', $url)
            ->withStatus(302);
    }
}