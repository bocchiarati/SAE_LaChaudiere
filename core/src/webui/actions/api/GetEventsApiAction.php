<?php

namespace App\webui\actions\api;

use App\application_core\application\useCases\interfaces\AppServiceInterface;
use App\webui\actions\Abstract\AbstractAction;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class GetEventsApiAction extends AbstractAction {
    private AppServiceInterface $appService;
    public function __construct(AppServiceInterface $appService) {
        $this->appService = $appService;
    }
    public function __invoke(Request $request, Response $response, array $args) {
        $events = $this->appService->getEvents();
        foreach ($events as &$event) {
            $event['url'] = '/api/event/' . $event['id'];
        }
        $data = [
            'type' => 'resource',
            'events' => $events
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