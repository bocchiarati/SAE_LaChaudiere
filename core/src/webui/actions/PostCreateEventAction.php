<?php

namespace App\webui\actions;


use App\application_core\application\useCases\interfaces\AppServiceInterface;
use App\webui\actions\abstract\AbstractAction;
use App\webui\providers\interfaces\AuthnProviderInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

/**
 * Crée un nouvel événement personnalisé et retourne une réponse JSON
 */
class PostCreateEventAction extends AbstractAction {

    private AppServiceInterface $appService;
    private AuthnProviderInterface $authnProvider;

    public function __construct(AppServiceInterface $appService, AuthnProviderInterface $authnProvider) {
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
