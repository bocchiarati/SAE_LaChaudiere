<?php

namespace App\api;

use App\api\abstract\AbstractApi;
use App\application_core\application\exceptions\DatabaseException;
use App\application_core\application\useCases\interfaces\AppServiceInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class GetCategoriesApi extends AbstractApi {
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

        $data = [
            'type' => 'resource',
            'categories' => $categories
        ];

        $response->getBody()->write(json_encode($data));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Access-Control-Allow-Methods', 'GET')
            ->withStatus(200);
    }

}