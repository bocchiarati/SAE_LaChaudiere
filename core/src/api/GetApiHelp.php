<?php

namespace App\api;

use App\api\abstract\AbstractApi;
use App\application_core\application\exceptions\DatabaseException;
use App\application_core\application\exceptions\DatabaseExceptionMiddleware;
use App\application_core\application\useCases\interfaces\AppServiceInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class GetApiHelp extends AbstractApi {
    private AppServiceInterface $appService;
    public function __construct(AppServiceInterface $appService)
    {
        $this->appService = $appService;
    }
    public function __invoke(Request $request, Response $response, array $args) {
        try {
            $categories = $this->appService->getCategories();
        } catch(DatabaseException $e) {
            return DatabaseException::handle($response, $e);
        }

        //--------------------------------------------------------------------------------------------------------------

        foreach($categories as &$category) {
            $category["events"]["url"] =  '/api/category/' . $category["id"] . "/events";
        }

        $command = ["/api/events","/api/event/{id}","/api/categories","/api/categories/{id}/events"];

        $data = [
            'type' => 'help',
            'command' => $command
        ];

        $response->getBody()->write(json_encode($data));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Access-Control-Allow-Origin', '*') // CORS
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET')
            ->withStatus(200);
    }

    private function DatabaseExceptionMiddleware(Response $response, \Exception|DatabaseException $e)
    {
    }

}