<?php

namespace App\api;

use App\api\abstract\AbstractApi;
use App\application_core\application\exceptions\DatabaseException;
use App\application_core\application\useCases\interfaces\AppServiceInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class GetEventByIdApi extends AbstractApi {
    private AppServiceInterface $appService;
    public function __construct(AppServiceInterface $appService) {
        $this->appService = $appService;
    }
    public function __invoke(Request $request, Response $response, array $args) {
        try {
            $data = [
                'type' => 'resource',
                'event' => $this->appService->getEventById($args['id'])
            ];
        } catch(DatabaseException $e) {
            return DatabaseException::handle($response, $e);
        }

        //--------------------------------------------------------------------------------------------------------------

        $response->getBody()->write(json_encode($data));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Access-Control-Allow-Methods', 'GET')
            ->withStatus(200);
    }
}