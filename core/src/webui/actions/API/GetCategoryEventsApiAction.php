<?php

namespace App\webui\actions\API;

use App\application_core\application\useCases\interfaces\AppServiceInterface;
use App\webui\actions\Abstract\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class GetCategoryEventsApiAction extends AbstractAction {
    private AppServiceInterface $appService;
    public function __construct(AppServiceInterface $appService) {
        $this->appService = $appService;
    }
    public function __invoke(Request $request, Response $response, array $args) {
        $data = [
            'type' => 'resource',
            'events' => $this->appService->getEventsByCategory($args["category_id"])
        ];

        $response->getBody()->write(json_encode($data));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Access-Control-Allow-Origin', '*') // CORS
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
            ->withStatus(200);
    }

}